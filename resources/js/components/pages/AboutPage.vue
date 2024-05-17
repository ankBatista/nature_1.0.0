<template>

    <section class="about-section padding">
        <br> <br> <br> <br>
        <AboutComponent :dados="dados" /><br><br><br><br>

        <ToastComponent ref="toastComponent" :dadosToast="dadosToast" />

        <!-- início do card de listagem de Faqs -->
        <card-component titulo="FAQ">
            <template v-slot:conteudo>
                <table-component :dados="dados"
                    :visualizar="{ visivel: true, dataToggle: 'modal', dataTarget: '#modalVisualizar' }"
                    :atualizar="{ visivel: true, dataToggle: 'modal', dataTarget: '#modalAtualizar' }"
                    :remover="{ visivel: true, dataToggle: 'modal', dataTarget: '#modalRemover' }" :titulos="{
            id: { titulo: 'ID', tipo: 'texto' },
            title: { titulo: 'Title', tipo: 'texto' },
            description: { titulo: 'Description', tipo: 'texto' },

        }">
                </table-component>
            </template>

            <template v-slot:rodape>
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal"
                            data-bs-target="#modalSalvar">Adicionar</button>
                    </div>
                </div>

            </template>
        </card-component>


        <!-- início do modal de visualização -->
        <modal-component id="modalVisualizar" titulo="Visualizar">

            <template v-slot:conteudo>

                <div class="form-group">
                    <input-container-component titulo="Title" id="title" id-help="TitleHelp"
                        texto-ajuda="Title max 50 caracters">
                        <textarea class="form-control" id="title" rows="3" placeholder="TitleHelp"
                            v-model="$store.state.item.title" disabled></textarea>
                    </input-container-component>
                </div>

                <div class="form-group">
                    <input-container-component titulo="Description" id="description" id-help="DescriptionHelp"
                        texto-ajuda="Description max 500 caracters">
                        <textarea class="form-control" id="description" rows="3" placeholder="DescriptionHelp"
                            v-model="$store.state.item.description" disabled></textarea>
                    </input-container-component>
                </div>
            </template>


            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </template>
        </modal-component>
        <!-- fim do modal de visualização -->



        <!-- início do modal de remoção -->
        <modal-component id="modalRemover" titulo="Deletar">

            <template v-slot:alertas>
                <alert-component tipo="success" titulo="Transação realizada com sucesso"
                    :detalhes="$store.state.transacao"
                    v-if="$store.state.transacao.status == 'sucesso'"></alert-component>
                <alert-component tipo="danger" titulo="Erro na transação" :detalhes="$store.state.transacao"
                    v-if="$store.state.transacao.status == 'erro'"></alert-component>
            </template>


            <template v-slot:conteudo v-if="$store.state.transacao.status != 'sucesso'">

                <div class="form-group">
                    <input-container-component titulo="Title" id="title" id-help="TitleHelp"
                        texto-ajuda="Title max 50 caracters">
                        <textarea class="form-control" id="title" rows="3" placeholder="TitleHelp"
                            v-model="$store.state.item.title" disabled></textarea>
                    </input-container-component>
                </div>

                <div class="form-group">
                    <input-container-component titulo="Description" id="description" id-help="DescriptionHelp"
                        texto-ajuda="Description max 500 caracters">
                        <textarea class="form-control" id="description" rows="3" placeholder="DescriptionHelp"
                            v-model="$store.state.item.description" disabled></textarea>
                    </input-container-component>
                </div>

            </template>


            <template v-slot:rodape>
                <button ref="closeDelete" type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Fechar</button>
                <button v-if="$store.state.transacao.status != 'sucesso'" type="button" class="btn btn-danger"
                    @click="remover()">Remover</button>
            </template>
        </modal-component>
        <!-- fim do modal remoção -->






        <!-- início do modal de atualização -->
        <modal-component id="modalAtualizar" titulo="Atualizar">

            <template v-slot:alertas>
                <alert-component tipo="success" titulo="Transação realizada com sucesso"
                    :detalhes="$store.state.transacao"
                    v-if="$store.state.transacao.status == 'sucesso'"></alert-component>
                <alert-component tipo="danger" titulo="Erro na transação" :detalhes="$store.state.transacao"
                    v-if="$store.state.transacao.status == 'erro'"></alert-component>
            </template>

            <template v-slot:conteudo v-if="$store.state.transacao.status != 'sucesso'">

                <div class="form-group">
                    <input-container-component titulo="Title" id="title" id-help="TitleHelp"
                        texto-ajuda="Title max 50 caracters">
                        <textarea class="form-control" id="title" rows="3" placeholder="TitleHelp"
                            v-model="$store.state.item.title"></textarea>
                    </input-container-component>
                </div>

                <div class="form-group">
                    <input-container-component titulo="Description" id="description" id-help="DescriptionHelp"
                        texto-ajuda="Description max 500 caracters">
                        <textarea class="form-control" id="description" rows="3" placeholder="DescriptionHelp"
                            v-model="$store.state.item.description"></textarea>
                    </input-container-component>
                </div>


            </template>

            <template v-slot:rodape>
                <button ref="closeAtt" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="atualizar()">Atualizar</button>
            </template>
        </modal-component>
        <!-- fim do modal de atualização -->



        <!-- início do modal creat -->
        <modal-component id="modalSalvar" titulo="Novo">

            <template v-slot:alertas>
                <alert-component tipo="success" titulo="Transação realizada com sucesso"
                    :detalhes="$store.state.transacao"
                    v-if="$store.state.transacao.status == 'sucesso'"></alert-component>
                <alert-component tipo="danger" titulo="Erro na transação" :detalhes="$store.state.transacao"
                    v-if="$store.state.transacao.status == 'erro'"></alert-component>
            </template>

            <template v-slot:conteudo v-if="$store.state.transacao.status != 'sucesso'">


                <div class="form-group">
                    <input-container-component titulo="Title" id="title" id-help="TitleHelp"
                        texto-ajuda="Title max 50 caracters">
                        <textarea class="form-control" id="title" rows="3" placeholder="TitleHelp"
                            v-model="title"></textarea>
                    </input-container-component>
                </div>

                <div class="form-group">
                    <input-container-component titulo="Description" id="description" id-help="DescriptionHelp"
                        texto-ajuda="Description max 500 caracters">
                        <textarea class="form-control" id="description" rows="3" placeholder="DescriptionHelp"
                            v-model="description"></textarea>
                    </input-container-component>
                </div>

            </template>

            <template v-slot:rodape>
                <button ref="closeCreat" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click="salvar()">Save</button>
            </template>
        </modal-component>
        <!-- fim do modal de atualização de marca -->




    </section>

</template>

<script>
import TableComponent from '@/components/partials/Table.vue';
import CardComponent from '@/components/partials/Card.vue';
import ToastComponent from '@/components/partials/ToastComponent.vue';
import AboutComponent from '@/components/parts/AboutComponent.vue';




export default {
    data() {
        return {
            urlBase: import.meta.env.VITE_APP_API_URL + '/api/v1/cards',
            dados: [], // Inicialize dados como um array vazio

            title: "",
            description: "",

            //toast dados:
            dadosToast: [],

        }
    },
    components: {
        AboutComponent,
        TableComponent,
        CardComponent,
        ToastComponent

    },

    methods: {

        salvar() {
            let formData = new FormData();
            formData.append('_method', 'post')
            formData.append('title', this.title)
            formData.append('description', this.description)


            let url = this.urlBase

            let config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            axios.post(url, formData, config)
                .then(response => {
                    this.$store.state.transacao.status = 'sucesso';
                    this.$store.state.transacao.mensagem = 'Registro atualizado com sucesso!';

                    this.dadosToast = [
                        { title: 'Tudo certo' },
                        { status: 'success' },
                        { content: 'Dados salvos com Sucesso!' }
                    ];
                    this.showToast()

                    // Espera 3 segundos antes de chamar this.closeModal()
                    setTimeout(() => {
                        this.closeCreat();
                        this.carregarLista();
                    }, 1500);
                })
                .catch(errors => {
                    this.$store.state.transacao.status = 'erro';
                    this.$store.state.transacao.mensagem = errors.response.data.message;
                    this.$store.state.transacao.dados = errors.response.data.errors;

                    this.dadosToast = [
                        { title: 'Algo deu errado!' },
                        { status: 'danger' },
                        { content: 'Algo deu errado, verifique e tente novamente!' }
                    ];
                    this.showToast()

                    // Espera 3 segundos antes de chamar this.closeModal()
                    setTimeout(() => {
                        //this.closeCreat();
                        this.carregarLista();

                    }, 2500);

                });

        },
        atualizar() {
            let formData = new FormData();
            formData.append('_method', 'patch')
            formData.append('title', this.$store.state.item.title)
            formData.append('description', this.$store.state.item.description)


            let url = this.urlBase + '/' + this.$store.state.item.id

            let config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            axios.post(url, formData, config)
                .then(response => {

                    this.$store.state.transacao.status = 'sucesso'
                    this.$store.state.transacao.mensagem = 'Registro atualizado com sucesso!'

                    this.dadosToast = [
                        { title: 'Tudo certo' },
                        { status: 'success' },
                        { content: 'Dados atualizado com Sucesso!' }
                    ];
                    this.showToast()

                    // Espera 3 segundos antes de chamar this.closeModal()
                    setTimeout(() => {
                        this.closeAtualizar();
                        this.carregarLista();
                    }, 1500);


                })
                .catch(errors => {
                    this.$store.state.transacao.status = 'erro'
                    this.$store.state.transacao.mensagem = errors.response.data.message
                    this.$store.state.transacao.dados = errors.response.data.errors

                    this.dadosToast = [
                        { title: 'Algo deu errado!' },
                        { status: 'danger' },
                        { content: 'Algo deu errado, verifique e tente novamente!' }
                    ];
                    this.showToast()

                    // Espera 3 segundos antes de chamar this.closeModal()
                    setTimeout(() => {
                        this.closeAtualizar();
                        this.carregarLista();
                    }, 1500);

                })
        },

        remover() {
            let confirmacao = confirm('Tem certeza que deseja remover esse registro?')

            if (!confirmacao) {
                return false;
            }

            let formData = new FormData();
            formData.append('_method', 'delete')

            let url = this.urlBase + '/' + this.$store.state.item.id

            axios.post(url, formData)
                .then(response => {
                    this.$store.state.transacao.status = 'sucesso'
                    this.$store.state.transacao.mensagem = response.data.msg

                    this.dadosToast = [
                        { title: 'Tudo certo' },
                        { status: 'success' },
                        { content: 'Dados removidos com Sucesso!' }
                    ];
                    this.showToast()

                    // Espera 3 segundos antes de chamar this.closeModal()
                    setTimeout(() => {
                        this.closeDelete();
                        this.carregarLista();
                    }, 1500);
                })
                .catch(errors => {
                    this.$store.state.transacao.status = 'erro'
                    this.$store.state.transacao.mensagem = errors.response.data.erro

                    this.dadosToast = [
                        { title: 'Algo deu errado!' },
                        { status: 'danger' },
                        { content: 'Algo deu errado, verifique e tente novamente!' }
                    ];
                    this.showToast()

                    // Espera 3 segundos antes de chamar this.closeModal()
                    setTimeout(() => {
                        this.closeDelete();
                        this.carregarLista();
                    }, 1500);

                })
        },
        carregarLista() {

            //let url = this.urlBase + '?' + this.urlPaginacao + this.urlFiltro

            let url = this.urlBase
            axios.get(this.urlBase)
                .then(res => {
                    this.dados = res.data

                    this.$store.state.transacao.status = '';
                    this.$store.state.transacao.status = '';
                    this.$store.state.transacao.mensagem = '';

                })
                .catch(errors => {
                    console.log(errors)
                })
        },
        showToast() {
            // Chame o método showToast do componente ToastComponent usando a referência
            this.$refs.toastComponent.showToast();
        },
        closeAtualizar() {
            // Obtém a referência para o botão de fechar a modal Atualizar
            const btncloseAtt = this.$refs.closeAtt;
            // Dispara o evento de clique no botão
            btncloseAtt.click();
        },
        closeCreat() {
            // Obtém a referência para o botão de fechar a modal Creat
            const btncloseCreat = this.$refs.closeCreat;
            // Dispara o evento de clique no botão
            btncloseCreat.click();
        },
        closeDelete() {
            // Obtém a referência para o botão de fechar a modal Delete
            const btncloseDelete = this.$refs.closeDelete;
            // Dispara o evento de clique no botão
            btncloseDelete.click();
        }
    },
    mounted() {
        this.carregarLista()

    }

};
</script>
