import { createApp } from 'vue';
import Vuex from 'vuex';
import './bootstrap';

const store = new Vuex.Store({
    state: {
        item: {},
        transacao: { status: '', mensagem: '' }
    }
});

const app = createApp({});
app.use(store);

// Registra automaticamente todos os componentes Vue encontrados nos arquivos .vue dentro do diretório 'components' e seus subdiretórios
const requireComponent = import.meta.globEager('./components/**/*.vue');
Object.entries(requireComponent).forEach(([path, component]) => {
    const componentName = path
        .split('/')
        .pop() // Pega o nome do arquivo
        .replace(/\.\w+$/, ''); // Remove a extensão do arquivo
    app.component(componentName, component.default || component);
});

app.mount('#app');
