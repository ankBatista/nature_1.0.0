/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import Vuex from 'vuex';

const store = new Vuex.Store({
    state: {
        item: {},
        transacao: {status: '', mensagem: ''}

    }
})
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

// import ExampleComponent from '@/components/ExampleComponent.vue';
// app.component('example-component', ExampleComponent);

import indexComponent from '@/components/pages/indexComponent.vue';
app.component('index-component', indexComponent);

import EditComponent from '@/components/pages/EditComponent.vue';
app.component('edit-component', EditComponent);

import BannerComponent from '@/components/parts/BannerComponent.vue';
app.component('banner-component', BannerComponent);

import BannerPage from '@/components/pages/BannerPage.vue';
app.component('banner-page', BannerPage);

import FaqPage from '@/components/pages/FaqPage.vue';
app.component('faq-page', FaqPage);

import ServicesPage from '@/components/pages/ServicesPage.vue';
app.component('services-page', ServicesPage);

import CuriosityPage from '@/components/pages/CuriosityPage.vue';
app.component('curiosity-page', CuriosityPage);

import TestePage from '@/components/pages/TestePage.vue';
app.component('teste-page', TestePage);

import CardsPage from '@/components/pages/CardsPage.vue';
app.component('cards-page', CardsPage);

import AboutPage from '@/components/pages/AboutPage.vue';
app.component('about-page', AboutPage);



import NavComponent from '@/components/parts/NavComponent.vue';
app.component('nav-component', NavComponent);

import AboutComponent from '@/components/parts/AboutComponent.vue';
app.component('about-component', AboutComponent);

import CardsComponent from '@/components/parts/CardsComponent.vue';
app.component('cards-component', CardsComponent);

import CharityComponent from '@/components/parts/CharityComponent.vue';
app.component('charity-component', CharityComponent);

import ContactComponent from '@/components/parts/ContactComponent.vue';
app.component('contact-component', ContactComponent);

import FaqComponent from '@/components/parts/FaqComponent.vue';
app.component('faq-component', FaqComponent);

import CuriosityComponent from '@/components/parts/CuriosityComponent.vue';
app.component('curiosity-component', CuriosityComponent);


import PreloaderComponent from '@/components/parts/PreloaderComponent.vue';
app.component('preload-component', PreloaderComponent);

import FormComponent from '@/components/parts/FormComponent.vue';
app.component('form-component', FormComponent);


import ModalComponent from '@/components/parts/ModalComponent.vue';
app.component('modal-component', ModalComponent);

import InputContainer from '@/components/partials/InputContainer.vue';
app.component('input-container-component', InputContainer);

import TableComponent from '@/components/partials/Table.vue';
app.component('table-component', TableComponent);

import CardComponent from '@/components/partials/Card.vue';
app.component('card-component', CardComponent);

import AlertComponent from '@/components/partials/Alert.vue';
app.component('alert-component', AlertComponent);

import PaginateComponent from '@/components/partials/Paginate.vue';
app.component('paginate-component', PaginateComponent);

import ToastComponent from '@/components/partials/ToastComponent.vue';
app.component('toast-component', ToastComponent);

import LoginComponent from '@/components/partials/Login.vue';
app.component('login-component', LoginComponent);

import NotFondComponent from '@/components/pages/NotFondComponent.vue';
app.component('not-fond-component', NotFondComponent);

import EmailComponent from '@/components/parts/EmailComponent.vue';
app.component('email-component', EmailComponent);

import HeaderComponent from '@/components/parts/HeaderComponent.vue';
app.component('header-component', HeaderComponent);





/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.use(store)
app.mount('#app');
