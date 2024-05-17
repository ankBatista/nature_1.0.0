<template>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card col-lg-6 col-sm-10">
            <div class="card-header">
                {{ pageEdit }}
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3 row">
                                <label for="question" class="col-sm-2 col-form-label">Question</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control-plaintext" id="question" v-model="question">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="question" class="col-sm-2 col-form-label">Response</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control-plaintext" id="question" v-model="resposta">
                                </div>
                            </div>

                            <!-- Mudar para options talvez -->
                            <div class="form-check form-switch form-check-reverse">
                                <input class="form-check-input" type="checkbox" :checked="checked">
                                <label class="form-check-label" for="active">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary" @click="saveData">Submit</button>
            </div>
        </div>
    </div>
</template>


<script>

export default {
    name: 'FormComponent',
    components: {
    },
    data() {
        return {

            pageEdit: 'Faq', //Componente a ser editado
            question: 'Question',
            resposta: 'Response',
            checked: "false",
            urlBase: 'http://localhost:8000/api/v1/', //Este endereço está em config/custom.php

            id: '',
        };
    },
    methods: {
        updateInputs(value) {
            // Método chamado quando o valor do campo de entrada de email é atualizado
            this.email = value;
            this.question = question;
            this.resposta = resposta;

        },
        saveData() {
            // Crie um novo objeto FormData
            const formData = new FormData();

            // Adicione os campos de texto e outros campos de formulário ao objeto FormData
            formData.append('id', this.id);
            formData.append('question', this.question);
            formData.append('response', this.resposta);
            formData.append('active', this.checked ? 1 : 0);

            //Usando o axios para realizar as requisições http:
            axios.post(this.urlBase + 'faq', formData)

                .then(() => {  // ou >> .then(response => {console.log(response.data);
                    // Atualizando os dados na página
                    this.getdados();
                })
                .catch(error => {
                    console.error('Erro ao salvar dados:', error);
                });
        },
        getdados() {
            axios.get(this.urlBase + 'faq')
                .then(res => {
                    this.response = res.data;
                    this.currentItem = this.response; // Ajuste isso conforme necessário para pegar o item no indice desejado

                    this.id = this.currentItem[0].id;
                    this.question = this.currentItem[0].question;
                    this.resposta = this.currentItem[0].response;
                    this.checked = this.currentItem[0].active === 1 ? true : false;

                    console.log('Dados:', this.currentItem);
                })
                .catch(error => {
                    console.error('Erro ao carregar dados:', error);
                });
        }
    },

    mounted() {
        this.getdados();
    }
};
</script>