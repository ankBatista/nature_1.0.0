<template>
    <section class="about-section padding">
        <modal-component id="modalSalvar" titulo="Novo">
            <template v-slot:conteudo>
                <div class="form-group">
                    <h1>TESTE MODAL</h1>
                </div>
            </template>
            <template v-slot:rodape>
                <!-- Botão que fecha a modal -->
                <button ref="fecharModalButton" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button @click="fecharModalAutomaticamente()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">aut</button>
            </template>
        </modal-component>

        <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal" data-bs-target="#modalSalvar">Abrir modal</button>
    </section>
</template>

<script>
export default {
    name: 'TestPage',
    mounted() {
        // Chamando o método para fechar a modal automaticamente quando ela é exibida
        this.fecharModalAutomaticamente();
    },
    methods: {
        fecharModalAutomaticamente() {
            // Obtém a referência para o botão de fechar a modal
            const btnFecharModal = this.$refs.fecharModalButton;
            // Dispara o evento de clique no botão
            btnFecharModal.click();
        }
    }
};
</script>