<template>
    <div :id="modalId" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-sm">
                <div class="modal-body">
                    <p>Deseja sair?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                    <a href="/logout" type="button" class="btn btn-primary">Sim</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ModalMixin from '@components/Base/Mixins/ModalMixin';

    export default {
        name: "dashboard-logout",

        mixins: [
            ModalMixin
        ],

        data() {
            return {
                modalId: "logout-modal"
            };
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