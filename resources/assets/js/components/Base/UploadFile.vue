<template>
    <div class="dashboard__upload" :class="status.style">
        <input type="file"
               class="dashboard__upload-field"
               :disabled="status.uploading"
               @change="onSelectFile"
               ref="inputFile"
               v-if="formats === '*'">

        <input type="file"
               class="dashboard__upload-field"
               :disabled="status.uploading"
               @change="onSelectFile"
               :accept="formats"
               ref="inputFile"
               v-if="formats !== '*'">

        <div class="dashboard__upload-message">
            <div v-text="uploadMessage"></div>

            <div class="dashboard__upload-progress" :class="styles.progressBar" ref="progressBar"></div>
        </div>

        <div class="container-fluid" v-if="files.length > 0 && listUploaded">
            <div class="row">
                <div :class="styles.uploadedItem" v-for="(file, key) in files">
                    <div :class="uploadedItemStyle">
                        <img :src="file" class="img">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {messageErrorHandler} from "@js/helpers/messageErrorHandler";

    export default {
        name: "upload-file",

        props: {
            deleteUploaded: {
                type: Boolean,
                default: true,
            },

            deleteUrl: {
                type: String,
                required: true
            },

            formats: {
                type: String,
                default: "*"
            },

            limit: {
                type: Number,
                default: 0
            },

            listUploaded: {
                type: Boolean,
                default: true
            },

            messageDefault: {
                type: String,
                default: "Click or arraste para enviar o arquivo."
            },

            messageError: {
                type: String,
                default: "Ocorreu um erro no envio do arquivo. Tente novamente."
            },

            messageLimit: {
                type: String,
                default: "Foi enviado o limite de arquivos."
            },

            messageSending: {
                type: String,
                default: "Enviando..."
            },

            modalId: {
                type: String
            },

            serverFileName: {
                type: String,
                default: "files"
            },

            showProgress: {
                type: Boolean,
                default: false
            },

            uploadedItemStyle: {
                type: String,
                default: "dashboard__upload-item"
            },

            url: {
                type: String,
                required: true
            }
        },

        data() {
            return {
                files: [],
                filesKeys: [], // Used when manage stored files
                toRemove: [], // List of files to remove
                configs: {
                    headers: { 'content-type': 'multipart/form-data' }
                },
                data: new FormData(),
                uploaded: 0,
                messageType: "default",
                status: {
                    style: "", // css style to upload message box
                    uploading: false,
                    saved: false,
                    error: false
                },
                progressBar: {
                    enable: false,
                    show: false
                }
            }
        },

        computed: {
            getUploadedFiles() {
                return this.uploaded;
            },

            styles() {
                return {
                    progressBar: {
                        "dashboard__upload-progress--show": this.status.uploading
                    },

                    uploadedItem: {
                        "col-12": this.limit === 1,
                        "col-12 col-sm-2 col-md-3 col-lg-4": this.limit !== 1
                    }
                }
            },

            uploadMessage() {
                if (this.messageType === "error") {
                    return this.messageError;
                } else if (this.messageType === "limit") {
                    return this.messageLimit;
                } else if (this.messageType === "sending") {
                    return this.messageSending;
                } else {
                    return this.messageDefault;
                }
            },
        },

        watch: {
            getUploadedFiles(value) {
                if (this.limit > 1 && this.limit === value) {
                    this.status.uploading = true;
                    this.messagesType = "limit";
                }
            }
        },

        mounted() {
            if (this.modalId !== null) {
                $("#" + this.modalId).on('hidden.bs.modal', () => {
                    this.uploadCloseForm();
                });
            }
        },

        methods: {
            addFile(filePath) {
                if (this.limit === 1) {
                    this.addSingleFile(filePath);
                    this.$emit("input", this.files[0]); // 'INPUT' is the vue function to set value to a v-model var in parent
                } else {
                    this.addMultipleFiles(filePath);
                    this.$emit("input", this.files);
                }
            },

            addMultipleFiles(filePath) {
                let length = this.filesKeys.length;

                if (length > 0) {
                    //It's used to update the files reference on database
                    // Used in record update
                    length -= 1;
                    this.files[this.filesKeys[length]].path = filePath;

                    if (length === 0) {
                        this.filesKeys = [];
                    } else {
                        this.filesKeys.splice(length, 1);
                    }
                } else {
                    this.files.push(filePath);
                }
            },

            addSingleFile(filePath) {
                if (this.files.length > 0 && !this.isEmptyString(this.files[0])) {
                    this.toRemove.push(this.files[0]);
                }

                this.files[0] = filePath;
            },

            onSelectFile(evt) {
                let file = evt.target.files[0];
                this.status.uploading = true;
                this.messageType = "sending";

                this.sendFile(file)
                    .then(response => {
                        if (response.data.errors) {
                            messageErrorHandler(response);

                            this.uploadStatusError();
                        } else {
                            this.addFile(response.data);
                            this.uploaded += 1;
                            this.uploadStatusReset();
                        }
                    })
                    .catch(err => {
                        messageErrorHandler(err);
                        this.uploadStatusError();
                    });
            },

            sendFile(file) {
                if (this.showProgress) {
                    this.configs.onUploadProgress = e => {
                        if (e.lengthComputable) {
                            let perc = (e.loaded * 100) / e.total;

                            this.$refs.progressBar.width = perc + "%";
                        }
                    }
                }

                this.data.append(this.serverFileName, file);

                return axios.post(this.url, this.data, this.configs);
            },

            uploadCloseForm() {
                let data = { params: {} };

                if (this.files.length > 0) {
                    data.params[this.serverFileName] = this.status.saved ?
                                                       this.toRemove :
                                                       this.toRemove.concat(this.files);
                }

                if (this.deleteUploaded &&
                    !this.isNullOrUndefined(data.params[this.serverFileName]) &&
                    data.params[this.serverFileName].length > 0) {
                    axios.delete(this.deleteUrl, data)
                        .then(response => {
                            if (response.data === 1) {
                                console.log("Os arquivos enviados foram removidos.");
                            } else {
                                console.error("Os arquivos enviados não foram removidos.");
                            }
                        });
                }

                this.uploadStatusReset();
                this.files = [];
            },

            uploadStatusReset() {
                this.uploaded = 0;
                this.status.style = "";
                this.status.error = false;
                this.status.uploading = false;
                this.messageType = "default";
                this.uploadInputFileReset();
            },

            uploadStatusError() {
                this.status.style = "alert-danger";
                this.status.error = true;
                this.status.uploading = false;
                this.messagesType = "error";
                this.uploadInputFileReset();
            },

            uploadInputFileReset() {
                if (!this.isEmptyString(this.$refs.inputFile.value)) {
                    this.$refs.inputFile.value = "";
                }
            },
        }
    }
</script>