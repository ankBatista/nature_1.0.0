<template>
    <div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" v-for="t, key in titulos" :key="key">{{ t.titulo }}</th>
                    <th v-if="visualizar.visivel || atualizar.visivel || remover.visivel"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="obj, chave in dadosFiltrados" :key="chave">
                    <td v-for="valor, chaveValor in obj" :key="chaveValor">
                        <span v-if="titulos[chaveValor].tipo == 'texto'">{{limit(valor) }}</span>
                        <span v-if="titulos[chaveValor].tipo == 'data'">
                            <!-- {{ valor | formataDataTempoGlobal }} -->
                        </span>
                        <span v-if="titulos[chaveValor].tipo == 'imagem'">
                            <img :src="'/storage/' + valor" width="150">
                        </span>
                    </td>


                    <td v-if="visualizar.visivel || atualizar.visivel || remover.visivel">
                        <button v-if="visualizar.visivel" class="btn btn-outline-primary btn-sm"
                            :data-bs-toggle="visualizar.dataToggle" :data-bs-target="visualizar.dataTarget"
                            @click="setStore(obj)">View</button>

                        <button v-if="atualizar.visivel" class="btn btn-outline-primary btn-sm"
                            :data-bs-toggle="atualizar.dataToggle" :data-bs-target="atualizar.dataTarget"
                            @click="setStore(obj)">Edit</button>

                        <button v-if="remover.visivel" class="btn btn-outline-danger btn-sm"
                            :data-bs-toggle="remover.dataToggle" :data-bs-target="remover.dataTarget"
                            @click="setStore(obj)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- {{ dados }} -->
    </div>
</template>

<script>
export default {
    components: {

    },
    props: ['dados', 'titulos', 'atualizar', 'visualizar', 'remover'],
    methods: {
        setStore(obj) {
            this.$store.state.item = obj
            this.$store.state.transacao.status = ''
            this.$store.state.transacao.mensagem = ''
            this.$store.state.transacao.dados = ''
            this.$store.state.item = obj
            //console.log(obj)
        },
        limit(conteudo) {
            if (conteudo.length > 50) {
                return conteudo.slice(0, 30) + '...'; // Limita o conteúdo a 30 caracteres e adiciona reticências
            }
            return conteudo; // Retorna o conteúdo sem alterações se for menor ou igual a 50 caracteres
        }
    },
    computed: {
        dadosFiltrados() {
            if (!this.dados) return []; // Verifica se dados é nulo ou indefinido

            let campos = Object.keys(this.titulos)
            let dadosFiltrados = []

            this.dados.map((item, chave) => {

                let itemFiltrado = {}
                campos.forEach(campo => {

                    itemFiltrado[campo] = item[campo] //utilizar a sintaxe de array para atribuir valores a objetos
                })
                dadosFiltrados.push(itemFiltrado)
            })

            return dadosFiltrados //retorne um array de objetos 
        }
    }
}
</script>
