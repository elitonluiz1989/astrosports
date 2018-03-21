<template>
    <div id="logout-modal" class="modal fade" tabindex="-1" role="dialog" @click.stop="hideLogoutModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-sm">
                <div class="modal-body">
                    <p>Deseja sair?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click.stop="hideLogoutModal">Não</button>
                    <a href="/logout" type="button" class="btn btn-primary">Sim</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "dashboard-logout",

        props: {
            show: {
                type: Boolean,
                required: true,
                default: false
            }
        },

        watch: {
            show(value) {
                if (value) {
                    $('#logout-modal').modal('show')
                } else {
                    $('#logout-modal').modal('hide')
                }
            }
        },

        methods: {
            hideLogoutModal() {
                this.$emit('onHideLogoutModal');
            }
        }
    }
</script>

<style lang="scss" scoped>
    .modal {
        .modal-body {
            padding-top: 0.7rem;
            padding-bottom: 0.7rem;

            p {
                margin-bottom: 0;
            }
        }

        .modal-footer {
            padding-top: 0.3rem;
            padding-bottom: 0.3rem;
        }
    }
</style>