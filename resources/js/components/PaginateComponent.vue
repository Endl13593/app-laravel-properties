<template>
    <ul class="flex items-center justify-between mx-auto">
        <li v-if="pagination.current_page > 1">
            <span @click.prevent="changePage(1)" class="cursor-pointer relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-md hover:bg-gray-100">
                <span aria-hidden="true"><i class="el-icon-d-arrow-left"></i></span>
            </span>
        </li>
        <li v-if="pagination.current_page > 1">
            <span @click.prevent="changePage(pagination.current_page - 1)" class="cursor-pointer relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-md hover:bg-gray-100">
                <span aria-hidden="true"><i class="el-icon-arrow-left"></i></span>
            </span>
        </li>

        <li v-if="pagination.last_page > 1" v-for="(page, index) in pagesNumber" :key="index">
            <span @click.prevent="changePage(page)"
                :class="[
                    'cursor-pointer relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-md hover:bg-gray-100',
                    {'border border-gray-400 bg-gray-300 text-gray-700 font-bold': page === pagination.current_page}
                ]">
                {{ page }}
            </span>
        </li>

        <li v-if="pagination.current_page < pagination.last_page">
            <span @click.prevent="changePage(pagination.current_page + 1)" class="cursor-pointer relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-md hover:bg-gray-100">
                <span aria-hidden="true"><i class="el-icon-arrow-right"></i></span>
            </span>
        </li>

        <li v-if="pagination.current_page < pagination.last_page">
            <span @click.prevent="changePage(pagination.last_page)" class="cursor-pointer relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-md hover:bg-gray-100">
                <span aria-hidden="true"><i class="el-icon-d-arrow-right"></i></span>
            </span>
        </li>

        <li class="ml-2 text-sm text-gray-600">
            <span>Total:</span> <span class="font-bold">{{pagination.total}}</span>
        </li>
    </ul>
</template>

<script>
export default {
    name: 'PaginateComponent',

    props: {
        pagination: {
            type: Object,
            required: true
        },
        offset: {
            type: Number,
            default: 4
        }
    },
    computed: {
        pagesNumber() {
            // Verifica se tem itens para paginar, se não tiver retorna o Array vazio
            if (!this.pagination.to) {
                return [];
            }
            // Define a próxima página
            let from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            // Define a última opção páginação
            let to = from + this.offset;
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            // Cria as opções de paginação
            let pagesArray = [];
            for (let page = from; page <= to; page++) {
                pagesArray.push(page);
            }
            // Array montado com as opções de paginação (Número de opções de paginação === offset)
            return pagesArray;
        }
    },
    methods : {
        changePage(page) {
            // Atualiza a pagina atual
            this.pagination.current_page = page
            // Dispara o evento @paginate do Component Pai
            this.$emit('paginate', page);
        }
    }
};
</script>

<style scoped>

</style>
