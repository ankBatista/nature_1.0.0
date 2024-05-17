<template>

    <section class="about-section padding">
        <br> <br> <br> <br> <br>
        <ServicesComponent :dados='dados' />
        <ToastComponent ref="toastComponent" :dadosToast="dadosToast" />

        <!-- início do card de listagem -->
        <card-component titulo="Teste">
            <template v-slot:conteudo>
                <table-component :dados='dados'
                    :visualizar="{ visivel: true, dataToggle: 'modal', dataTarget: '#modalVisualizar' }"
                    :atualizar="{ visivel: true, dataToggle: 'modal', dataTarget: '#modalAtualizar' }"
                    :remover="{ visivel: true, dataToggle: 'modal', dataTarget: '#modalRemover' }" :titulos="{
            id: { titulo: 'ID', tipo: 'texto' },
            icon: { titulo: 'Icon', tipo: 'imagem' },
            title: { titulo: 'Titulo', tipo: 'texto' },
            content: { titulo: 'Content', tipo: 'texto' },
            active: { titulo: 'Active', tipo: 'texto' },
        }"></table-component>
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

                <h3>{{ this.$store.state.item.title }}</h3>
                <img :src="'storage/' + $store.state.item.icon" v-if="$store.state.item.icon">

                <p>{{ this.$store.state.item.content }}</p>

                <hr>
                <div v-if="this.$store.state.item.active == 1">
                    <h5>Active Item</h5>
                </div>
                <div v-if="this.$store.state.item.active !== 1">
                    <h5>Inactive Item</h5>
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

                <h3>{{ this.$store.state.item.title }}</h3>
                <img :src="'storage/' + $store.state.item.icon" v-if="$store.state.item.icon">

                <p>{{ this.$store.state.item.content }}</p>

                <hr>
                <div v-if="this.$store.state.item.active == 1">
                    <h5>Active Item</h5>
                </div>
                <div v-if="this.$store.state.item.active !== 1">
                    <h5>Inactive Item</h5>
                </div>

            </template>


            <template v-slot:rodape>
                <button ref="closeDelete" type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Fechar</button>
                <button v-if="$store.state.transacao.status != 'sucesso'" type="button" class="btn btn-danger"
                    @click="remover()">Delete</button>
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

            <template v-slot:conteudo>
                <div class="form-group">
                    <input-container-component titulo="Question" id="title" id-help="QuestiontHelp"
                        texto-ajuda="Question max 250 caracters">
                        <textarea class="form-control" id="title" rows="3" placeholder="QuestionHelp"
                            v-model="$store.state.item.title"></textarea>
                    </input-container-component>
                </div>

                <div class="form-group">
                    <input-container-component titulo="Response" id="content" id-help="ResponseHelp"
                        texto-ajuda="Response max 250 caracters">
                        <textarea class="form-control" id="content" rows="3" placeholder="ResponseHelp"
                            v-model="$store.state.item.content"></textarea>
                    </input-container-component>
                </div>

                <div class="form-group">
                    <input-container-component titulo="Active" id="active" id-help="ActiveHelp"
                        texto-ajuda="0 = inative / 1 = active">
                        <input type="text" class="form-control" id="active" aria-describedby="ActiveHelp"
                            placeholder="Active" v-model="$store.state.item.active">
                    </input-container-component>
                </div>



                <div class="card-body">
                    <h4 class="card-title">Icon</h4>
                    <p class="card-title-desc">For a better experience, choose a standard image (45 x 45)</p>

                    <!-- Exibir banner -->
                    <div class="col-md-6">
                        <!-- Primeira imagem (se bannerImage estiver definido) -->
                        <img class="rounded mr-2" alt="Icon" width="350" v-if="bannerImage" :src="bannerImage" />

                        <!-- Segunda imagem (se bannerImage não estiver definido, mas houver um arquivo selecionado) -->
                        <img class="rounded mr-2" alt="Icon" width="350"
                            v-else-if="urlimg + this.$store.state.item.icon"
                            :src="urlimg + this.$store.state.item.icon" />

                        <!-- Terceira imagem (se nenhum bannerImage nem arquivo selecionado estiver definido) -->
                        <img class="rounded mr-2" alt="Icon" width="350" v-else
                            :src="urlimg + 'services/defaultbanner.jpg'" />
                    </div>
                    <br>

                    <!-- Input de arquivo para upload de banner -->
                    <div class="custom-file">

                        <input-container-component titulo="Icon" id="icon" id-help="AttIconHelp"
                            texto-ajuda="0 = inative / 1 = active">
                            <input id="icon" type="file" class="custom-file-input" @change="handleBannerUpload" />
                        </input-container-component>

                    </div>
                </div>

            </template>

            <template v-slot:rodape>
                <button ref="closeAtt" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click="atualizar()">Save</button>
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

            <template v-slot:conteudo>
                <div class="form-group">
                    <input-container-component titulo="Title" id="newTitle" id-help="TitleHelp"
                        texto-ajuda="Background title">
                        <input type="text" class="form-control" id="newTitle" aria-describedby="TitleHelp"
                            placeholder="Title background" v-model="title">
                    </input-container-component>
                </div>

                <div class="form-group">
                    <input-container-component titulo="Content" id="newContent" id-help="ContentHelp"
                        texto-ajuda="Content max 250 caracters">
                        <textarea class="form-control" id="newContent" rows="3" placeholder="ContentHelp"
                            v-model="content"></textarea>
                    </input-container-component>
                </div>

                <div class="form-group">
                    <input-container-component titulo="Active" id="newActive" id-help="ActiveHelp"
                        texto-ajuda="0 = inative / 1 = active">
                        <input type="text" class="form-control" id="newActive" aria-describedby="ActiveHelp"
                            placeholder="Active" v-model="active">
                    </input-container-component>
                </div>



                <div class="card-body">
                    <h4 class="card-title">Icon</h4>
                    <p class="card-title-desc">For a better experience, choose a standard image (45 x 45)</p>

                    <!-- Exibir banner -->
                    <div class="col-md-6">
                        <!-- Primeira imagem (se bannerImage estiver definido) -->
                        <img class="rounded mr-2" alt="Icon" width="350" v-if="bannerImage" :src="bannerImage" />

                        <!-- Segunda imagem (se bannerImage não estiver definido, mas houver um arquivo selecionado) -->
                        <img class="rounded mr-2" alt="Icon" width="350"
                            v-else-if="urlimg + this.$store.state.item.icon"
                            :src="urlimg + this.$store.state.item.icon" />

                        <!-- Terceira imagem (se nenhum bannerImage nem arquivo selecionado estiver definido) -->
                        <img class="rounded mr-2" alt="Icon" width="350" v-else
                            :src="urlimg + 'services/defaultbanner.jpg'" />
                    </div>
                    <br>

                    <!-- Input de arquivo para upload de banner -->
                    <div class="custom-file">

                        <input-container-component titulo="Icon" id="newIcon" id-help="AttIconHelp"
                            texto-ajuda="0 = inative / 1 = active">
                            <input id="newIcon" type="file" class="custom-file-input" @change="handleBannerUpload" />
                        </input-container-component>

                    </div>
                </div>

            </template>

            <template v-slot:rodape>
                <button ref="closeCreat" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click="salvar()">Save</button>
            </template>
        </modal-component>
        <!-- fim do modal de atualização -->



    </section>

</template>

<script>
import ServicesComponent from '@/components/parts/ServicesComponent.vue';
import TableComponent from '@/components/partials/Table.vue';
import CardComponent from '@/components/partials/Card.vue';
import ToastComponent from '../partials/ToastComponent.vue';




export default {
    data() {
        return {
            urlBase: 'http://localhost:8000/api/v1/services',
            urlimg: 'http://localhost:8000/storage/',

            dados: [],
            dadosToast: [],
            bannerImage: "",
            active: '',
            title: '',
            content: '',


        }
    },
    components: {
        ServicesComponent,
        TableComponent,
        CardComponent,
        ToastComponent

    },
    methods: {
        handleBannerUpload(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            // Evento de carregamento do arquivo
            reader.onload = (e) => {
                this.bannerImage = e.target.result; // Atualiza o URL da imagem do banner
                this.banner = file; // Define this.banner como o arquivo selecionado
            };

            // Carrega o arquivo como uma URL de dados
            reader.readAsDataURL(file);
        },
        salvar() {
            let formData = new FormData();
            //formData.append('_method', 'post')

            formData.append('title', this.title);
            formData.append('content', this.content);
            formData.append('active', this.active);

            if (this.banner) { // Verifica se uma imagem foi selecionada
                formData.append('icon', this.banner); // Adiciona a imagem ao FormData
            }
            let url = this.urlBase + '/'

            let config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            axios.post(url, formData)
                .then(response => {

                    this.$store.state.transacao.status = 'sucesso'
                    this.$store.state.transacao.mensagem = 'Registro atualizado com sucesso!'
                    newIcon.value = '' //resetando o campo de imagem
                    this.bannerImage = '' //resetando o campo de imagem selecionada após salvar

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
                        //this.closeCreat();
                        this.carregarLista();

                    }, 2500);
                })
        },
        atualizar() {
            let formData = new FormData();
            formData.append('_method', 'patch')
            formData.append('title', this.$store.state.item.title);
            formData.append('content', this.$store.state.item.content);
            formData.append('active', this.$store.state.item.active);


            if (this.banner) { // Verifica se uma imagem foi selecionada
                formData.append('icon', this.banner); // Adiciona a imagem ao FormData
            }
            let url = this.urlBase + '/' + this.$store.state.item.id

            let config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            axios.post(url, formData)
                .then(response => {

                    this.$store.state.transacao.status = 'sucesso'
                    this.$store.state.transacao.mensagem = 'Registro atualizado com sucesso!'
                    icon.value = '' //resetando o campo de imagem
                    this.bannerImage = '' //resetando o campo de imagem selecionada após salvar

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
                .then(response => {
                    this.dados = response.data

                    this.$store.state.transacao.status = '';
                    this.$store.state.transacao.status = '';
                    this.$store.state.transacao.mensagem = '';
                })
                .catch(errors => {
                    console.log('Erros:', this.errors)
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
