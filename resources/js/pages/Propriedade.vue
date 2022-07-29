<template>
    <div>
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">Propriedades</h1>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button type="button"
                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none sm:w-auto"
                        @click.prevent="novaPropriedadeModal = true"
                    >
                        Nova Propriedade
                    </button>
                </div>
            </div>
            <div class="mt-4 flex flex-col">
                <div class="sm:overflow-hidden overflow-x-auto shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300" v-loading="preloader">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" @click="orderByChange('email_proprietario')" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                <direcao-order-component title="Email do Proprietário" :direcao="direcao" :order-by="orderBy" coluna="email_proprietario"/>
                            </th>
                            <th scope="col" @click="orderByChange('rua')" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                <direcao-order-component title="Endereço" :direcao="direcao" :order-by="orderBy" coluna="rua"/>
                            </th>
                            <th scope="col" @click="orderByChange('id_status')" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                <direcao-order-component title="Status" :direcao="direcao" :order-by="orderBy" coluna="id_status"/>
                            </th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6"></th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        <tr v-for="row in dataSet.data" :key="row.id">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ row.email_proprietario }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ row.rua }}, {{ row.numero }}, {{ row.cidade }}, {{ row.estado }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <span v-if="row.id_status === 1" class="inline-flex rounded-full bg-red-100 px-2 text-xs font-semibold leading-5 text-red-800">{{ row.status.name }}</span>
                                <span v-if="row.id_status === 2" class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">{{ row.status.name }}</span>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <button
                                    type="button"
                                    @click.prevent="deleteItem(row)"
                                    class="inline-flex items-center rounded-md bg-red-700 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-red-500 focus:outline-none"
                                >
                                    Remover
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <paginate-component
            class="mt-2 w-fit"
            :pagination="dataSet"
            :offset="offset"
            @paginate="getData"
        />

        <nova-propriedade-component
            :visible="novaPropriedadeModal"
            :handleClose="() => { novaPropriedadeModal = false }"
            @REFRESH="getData"/>
    </div>
</template>

<script>
import NovaPropriedadeComponent from "../components/NovaPropriedadeComponent";
import PaginateComponent from "../components/PaginateComponent";
import DirecaoOrderComponent from "../components/DirecaoOrderComponent";
export default {
    name: "Propriedade",

    components: { NovaPropriedadeComponent, PaginateComponent, DirecaoOrderComponent },

    data() {
        return {
            dataSet: {
                current_page: 1,
                last_page: 1,
                total: 0,
                per_page: 10,
                from: 0,
                to: 0,
                data: [],
            },
            offset: 4,
            orderBy: 'id',
            direcao: 'desc',
            preloader: false,
            novaPropriedadeModal: false,
        }
    },

    created() {
        this.getData();
    },

    methods: {
        async getData(page = 1) {
            this.preloader = true;
            await axios
                .get(`propriedades?page=${page}&direcao=${this.direcao}&orderBy=${this.orderBy}`)
                .then(response => {
                    this.dataSet = response.data.paginate;
                    this.direcao = response.data.direcao;
                    this.orderBy = response.data.orderBy;
                }).finally(() => this.preloader = false);
        },

        async deleteItem(obj) {
            this.$confirm(`Deseja realmente excluir o imóvel <strong>${obj.rua}, ${obj.numero}, ${obj.cidade}, ${obj.estado}</strong>?`,
                'Excluir', {
                    dangerouslyUseHTMLString: true,
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                    type: 'warning'})
                .then(async () => {
                    await axios.delete(`propriedades/${obj.id}`)
                        .then(() => {
                            this.$message.success('Excluído com sucesso!')
                            this.getData();
                        })
                        .catch(() => {
                            this.$message.info('Não foi possível Excluir, Tente novamente')
                        });
                }).catch(() => {});
        },

        orderByChange(campo)
        {
            this.orderBy = campo;
            if(this.direcao === 'desc'){
                this.direcao = 'asc';
            }else{
                this.direcao = 'desc';
            }
            this.getData();
        },
    }
}
</script>

<style scoped>

</style>
