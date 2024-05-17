<template>

    <section class="about-section padding">
        <!-- contact section html start -->
        <br><br><br>
        <br><br><br>

        <TableComponent :table-headers="tableHeaders" :table-data="tableData" />

        <FormComponent />

    </section><!--/.about-section-->

</template>

<script>
import FormComponent from '@/components/parts/FormComponent.vue';
import TableComponent from '@/components/parts/TableComponent.vue';



export default {
    name: 'EditComponent',
    components: {
        FormComponent,
        TableComponent,
    },
    data() {
        return {
            urlBase: import.meta.env.VITE_APP_API_URL + '/api/v1/',
            tableHeaders: ['ID', 'Question', 'Response', 'Active'],
            tableData: []
        };
    },
    methods: {
        getdados() {
            axios.get(this.urlBase + 'faq')
                .then(res => {
                    const responseData = res.data;
                    this.response = res.data;
                    // Verificar se há dados
                    if (responseData.length > 0) {
                        //>> this.tableHeaders = Object.keys(responseData[0]); //define os cabeçalhos igual esta no banco
                        this.tableData = responseData; // Definir os dados da tabela
                    }
                    //console.log('Dados:', this.currentItem);
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
