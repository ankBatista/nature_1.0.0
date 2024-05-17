<template>
    <header id="masthead" class="site-header top-header site-header-transparent mt-3">
        <div class="bottom-header">
            <div class="container">
                <div class="hgroup-wrap d-flex justify-content-between align-items-center">
                    <div class="site-identity">
                        <h1 class="site-title">
                            <a href="index.html">
                                <img src="assets/images/site-logo.png" alt="logo">
                            </a>
                        </h1>
                    </div>
                    <div class="main-navigation">
                        <nav id="navigation" class="navigation d-none d-lg-inline-block">
                            <ul>
                                <li class="current-menu-item">
                                    <a href="/">Home</a>
                                </li>
                                <li>
                                    <a href="#volunteer">Voluntario</a>
                                </li>
                                <li>
                                    <a href="#about">Sobre</a>
                                </li>
                                <li>
                                    <a href="#faq">FAQ</a>
                                </li>
                                <!-- Authentication Links -->
                                <li v-if="!loggedIn">
                                    <a href="/login">Login</a>
                                </li>
                                <li v-if="loggedIn" class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Config
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/banner">Banner</a></li>
                                        <li><a class="dropdown-item" href="/curiosity">Curiosity</a></li>
                                        <li><a class="dropdown-item" href="/services">Services</a></li>
                                        <li><a class="dropdown-item" href="/voluntary">Voluntary</a></li>
                                        <li><a class="dropdown-item" href="/about">About Us</a></li>
                                        <li><a class="dropdown-item" href="/faq">Faq</a></li>
                                        <li><a class="dropdown-item" href="/cards">Cards</a></li>
                                    </ul>
                                </li>
                                <li v-if="loggedIn" class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ userName }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#" @click="logout">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <div class="header-btn d-inline-block">
                            <a href="#" class="button-round-primary">Compre Créditos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-menu-container"></div>
    </header>
</template>

<script>
export default {
    data() {
        return {
            loggedIn: false,
            userName: ''
        };
    },
    created() {
        this.checkAuthentication();
    },
    methods: {
        checkAuthentication() {
            // Verifique se há um token de autenticação nos cookies
            const token = this.getCookie('token');
            if (token) {
                this.loggedIn = true;
                // Se o usuário estiver autenticado, faça uma solicitação para a rota 'me' para obter os detalhes do usuário
                axios.post('/api/v1/me')
                    .then(response => {
                        // Se a solicitação for bem-sucedida, atualize o nome do usuário
                        this.userName = response.data.name;
                    })
                    .catch(error => {
                        // Se houver um erro ao obter os detalhes do usuário, limpe o token dos cookies e redirecione para a página de login
                        document.cookie = 'token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                        window.location.href = '/login';
                    });
            }
        },
        logout() {
            // Chame a rota ou API para fazer logout e invalidar o token de autenticação
            axios.post('/logout')
                .then(response => {
                    // Limpe o token de autenticação dos cookies
                    document.cookie = 'token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                    // Redirecionar para a página inicial
                    window.location.href = '/';
                })
                .catch(error => {
                    // Se houver um erro ao fazer logout, limpe o token dos cookies de qualquer maneira
                    document.cookie = 'token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                    // Redirecionar para a página inicial
                    window.location.href = '/';
                })
        },
        getCookie(name) {
            const cookies = document.cookie.split(';');
            for (let cookie of cookies) {
                const [cookieName, cookieValue] = cookie.split('=').map(c => c.trim());
                if (cookieName === name) {
                    return cookieValue;
                }
            }
            return null;
        }
    }
};
</script>