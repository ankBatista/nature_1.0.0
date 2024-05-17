import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
/* Interceptar os requests da aplicação */
axios.interceptors.request.use(
    config => {
        // Definir para todas as requisições os parâmetros de accept e autorização
        config.headers['Accept'] = 'application/json'

        // Recuperar o token de autorização dos cookies
        const token = getCookie('token')

        if (token) {
            config.headers.Authorization = `Bearer ${token}`
        }

        //console.log('Interceptando o request antes do envio', config)
        return config
    },
    error => {
        //console.log('Erro na requisição: ', error)
        return Promise.reject(error)
    }
)

// Função para obter o valor de um cookie pelo nome
function getCookie(name) {
    const cookies = document.cookie.split(';')
    for (let cookie of cookies) {
        const [cookieName, cookieValue] = cookie.split('=').map(c => c.trim())
        if (cookieName === name) {
            return cookieValue
        }
    }
    return null
}

/* Interceptar as responses da aplicação */
axios.interceptors.response.use(
    response => {
        //console.log('Interceptando a resposta antes da aplicação', response)
        return response
    },
    error => {
        //console.log('Erro na resposta: ', error.response)

        // Verificar se há uma resposta de erro
        if (error.response && error.response.status === 401 && error.response.data.message === 'Token has expired') {
            //console.log('Fazer uma nova requisição para rota refresh')

            // Retornar a promessa para encadear ações após a atualização do token
            return axios.post('http://localhost:8000/api/refresh')
                .then(response => {
                    console.log('Refresh com sucesso: ', response)

                    document.cookie = 'token=' + response.data.token
                    //console.log('Token atualizado: ', response.data.token)
                    window.location.reload()

                    // Retornar a resposta original para encadear outras ações após a atualização do token
                    return error.response
                })
                .catch(refreshError => {
                    //console.log('Erro ao atualizar token: ', refreshError)
                    // Lidar com erro de atualização do token
                    return Promise.reject(error)
                })
        }

        // Tratamento genérico de outros erros
        return Promise.reject(error)
    }
)
