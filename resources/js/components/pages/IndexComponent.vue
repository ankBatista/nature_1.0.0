<template>

    <section class="about-section padding">
        <BannerComponent :dados="dadosBanner" />

        <!-- Curiosity section -->
        <CuriosityComponent :dados='dadosCuriosity' />

        <!-- home service section-->
        <ServicesComponent :dados='dadosServices' />

        <!-- Cards -->
        <CardsComponent :dados="dadosCards" />

        <!-- charity section -->
        <CharityComponent />

        <!-- about section  start -->
        <AboutComponent />

        <!-- contact section html start -->
        <!-- <ContactComponent /> -->

        <!-- FAQ section html start -->
        <FaqComponentVue :dados="dadosFaq" />

    </section><!--/.about-section-->

</template>

<script>
import BannerComponent from '@/components/parts/BannerComponent.vue';
import CardsComponent from '@/components/parts/CardsComponent.vue';

import AboutComponent from '@/components/parts/AboutComponent.vue';
import ContactComponent from '@/components/parts/ContactComponent.vue';
import CharityComponent from '@/components/parts/CharityComponent.vue';
import ServicesComponent from '@/components/parts/ServicesComponent.vue';
import PreloaderComponent from '@/components/parts/PreloaderComponent.vue';
import FaqComponentVue from '@/components/parts/FaqComponent.vue';
import CuriosityComponent from '../parts/CuriosityComponent.vue';


export default {
    data() {
        return {
            urlBase: import.meta.env.VITE_APP_API_URL + '/api/',
            dadosFaq: [], // Inicialize dados como um array vazio
            dadosServices: [],
            dadosCuriosity: [],
            dadosBanner: [],
            dadosCards: [],
            //falta fazer:
            dadosAbout: [],
            dadosVoluntary: [],




        }
    },
    components: {
        AboutComponent,
        BannerComponent,
        CardsComponent,
        ContactComponent,
        CharityComponent,
        ServicesComponent,
        PreloaderComponent,
        FaqComponentVue,
        CuriosityComponent,

    },
    methods: {

        carregarLista() {

            axios.get(this.urlBase + 'banner') //Recupera dados Curiosity
                .then(res => {
                    this.dadosBanner = res.data
                })
                .catch(errors => {
                    console.log(errors)
                })

            axios.get(this.urlBase + 'curiosity') //Recupera dados Curiosity
                .then(res => {
                    this.dadosCuriosity = res.data
                })
                .catch(errors => {
                    console.log(errors)
                })

            axios.get(this.urlBase + 'services') //Recupera dados Services
                .then(res => {
                    this.dadosServices = res.data
                })
                .catch(errors => {
                    console.log(errors)
                })

            axios.get(this.urlBase + 'cards') //Recupera dados Curiosity
                .then(res => {
                    this.dadosCards = res.data
                })
                .catch(errors => {
                    console.log(errors)
                })



            axios.get(this.urlBase + 'faq') //Recupera dados Faq
                .then(res => {
                    this.dadosFaq = res.data
                })
                .catch(errors => {
                    console.log(errors)
                })
        }
    },
    mounted() {
        this.carregarLista()

    }

};
</script>
