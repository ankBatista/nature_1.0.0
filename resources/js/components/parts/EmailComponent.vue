<template>
    <div class="col-lg-4 text-right">
        <div class="footer-menu">
            <div class="footer-newsletter">
                <h5>Subscribe us for more update & news !!</h5>
                <!-- Adicione o evento @submit.prevent para evitar o envio convencional do formulário -->
                <form class="newsletter" @submit.prevent="salvar">
                    <input type="email" v-model="email" name="email" placeholder="Enter Your Email">
                    <button type="submit" class="button-round-primary">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'EmailComponent',
    data() {
        return {
            urlBase: 'http://localhost:8000/api/subscribe',
            email: '',
        }
    },
    methods: {
        salvar() {
            let formData = new FormData();
            formData.append('email', this.email);
            let url = this.urlBase + '/'

            let config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            axios.post(url, formData)
                .then(response => {
                    // Manipular a resposta aqui
                    console.log(response.data)
                    // Limpar o campo de e-mail após o envio bem-sucedido
                    this.email = '';
                })
                .catch(errors => {
                    // Manipular os erros aqui
                    console.log(errors.response.data)
                })
        },
    }
}
</script>
