<template>
    <div class="d-flex justify-content-center align-items-center ">
        {{ $store.state.teste }}
        <div class="card col-lg-10 col-sm-10">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col" v-for="(header, index) in tableHeaders" :key="index">{{ header }}</th>
                        <th scope="col">Actions</th> <!-- Nova coluna para os botões -->
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, rowIndex) in tableData" :key="rowIndex">
                        <td v-for="(value, colIndex) in item" :key="colIndex">{{ value }}</td>
                        <td>
                            <!-- Botões de ação -->
                            <button class="btn btn-outline-primary btn-sm"
                                @click="$store.state.teste = 'Modificado'">Show
                            </button>

                            <button class="btn btn-outline-primary btn-sm" @click="editItem(item)"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">Edit
                            </button>
                            
                            <button class="btn btn-outline-danger btn-sm" @click="deleteItem(item)"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <ModalComponent />
    </div>
</template>

<script>
import ModalComponent from '@/components/parts/ModalComponent.vue';

export default {
    components: {
        ModalComponent,

    },
    props: {
        tableHeaders: {
            type: Array,
            required: true
        },
        tableData: {
            type: Array,
            required: true
        }
    },
    methods: {
        editItem(item) {
            // Lógica para editar o item
            console.log('Edit item:', item);
        },
        deleteItem(item) {
            // Lógica para deletar o item
            console.log('Delete item:', item);
        }
    },

};
</script>
