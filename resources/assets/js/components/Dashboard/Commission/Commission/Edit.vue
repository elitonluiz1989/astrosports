<template>
  <div :id="modalId" class="dashboard__users-form modal fade" tabindex="-1" role="dialog">
    <app-mask :show-mask="showMask" mask-style="dark"></app-mask>

    <div class="modal-dialog" role="document">
      <div class="modal-content modal-sm">
        <form :id="formId" @submit.prevent="submitForm">
          <div :class="styles.formHeader">
            <h5 class="modal-title">Adicionar usuário</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-times"></i>
            </button>
          </div>

          <div class="modal-body">
            <form-message :show="formMessageShow" :text="formMessageText" :type="formMessageType"></form-message>

            <upload-file
              :class="'form-group row'"
              :delete-uploaded="deleteUploaded"
              delete-url="/storage/images/delete"
              :modal-id="modalId"
              formats="image/*"
              :limit="1"
              :list-uploaded="false"
              message-default="Click or arraste para enviar a imagem."
              message-error="Ocorreu um erro no envio da imagem. Tente novamente."
              message-limit="Foi enviado o limite de imagens."
              :show-progress="true"
              server-file-name="images"
              url="/storage/images/upload"
              v-model="fields.avatar"
            />

            <div class="form-group row">
              <div class="dashboard__user-avatar">
                <img :src="avatarSrc" class="img">
              </div>
            </div>

            <div class="form-group row">
              <label :for="setFieldId('name')" :class="commissionStyles.label">Nome</label>

              <div :class="commissionStyles.inputGroup">
                <input
                    type="text"
                    :id="setFieldId('name')"
                    class="form-control"
                    v-model="fields.name"
                >
              </div>
            </div>

            <div class="form-group row">
              <label :for="setFieldId('role')" :class="commissionStyles.label">Cargo</label>

              <div :class="commissionStyles.selectGroup" v-if="roles.length > 0">
                <select :id="setFieldId('role')" class="form-control" v-model="fields.role">
                  <option value="0">...</option>
                  <option :value="role.id"
                          v-for="(role, key) in roles"
                          v-text="role.name"
                          :key="key"
                  ></option>
                </select>
              </div>

              <div class="col" v-else>
                <div class="alert alert-danger">Erro ao carregar cargo.</div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <input
              type="reset"
              class="btn btn-light"
              value="Limpar"
              @click.prevent="manageFormData"
            >
            <input type="submit" :class="styles.btnSubmit" value="Salvar">
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import DashboardFormEditMixin from "@Dashboard/Mixins/DashboardFormEditMixin";
import CommissionFormMixin from "../Mixins/CommissionFormMixin";

export default {
  name: "commission-edit-form",

  mixins: [DashboardFormEditMixin, CommissionFormMixin],

  data() {
    return {
      formId: "commission-edit-form",
      modalId: "commission-edit-modal",
      formTitle: "Editar membro da comissão",
      formType: "edit",
      submitMessages: {
        error: "Houve um erro ao editar o membro da comissão.",
        success: "Alterações salvas com sucesso."
      }
    };
  },

  computed: {
    editStatus() {
      return this.$store.getters["commission/getStatus"]("edit");
    },

    loadStatus() {
      return this.$store.getters["commission/getStatus"]("edit");
    },

    record() {
      console.log(this.recordKey)
      return this.$store.state.commission.records[this.recordKey];
    },

    roles() {
      return this.$store.state.commissionRoles.records;
    }
  },

  watch: {
    editStatus(value) {
      this.watchSubmitStatus(value);

      // When save user data is successful,
      // set to doesn't remove the uploaded images
      this.deleteUploaded = !(value.code === 2);

      if (value.code === 3) {
        this.disableForm(false);
      }
    }
  },

  methods: {
    submitForm() {
      if (this.validateForm()) {
        if (this.setUpdateData()) {
          this.formData.id = this.record.id;

          this.showMask = true;
          this.formMessageShow = false;

          this.disableForm();

          this.$store.dispatch("commission/edit", this.formData);
        }
      }
    }
  }
};
</script>