<template>
    <div class="mt-3">
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="card">
                    <div class="card-header">Propriedades</div>

                    <div class="card-body table-responsive">
                        <button class="btn btn-success btn-sm mb-2" @click.prevent="novaPropriedadeModal = true"><i class="el-icon-circle-plus"></i> Adicionar Propriedade</button>
                        <table class="table table-hover" v-loading="preloader">
                            <thead>
                            <tr>
                                <th @click="orderByChange('email_proprietario')" style="cursor: pointer" scope="col">
                                    <direcao-order-component title="Email do Proprietário" :direcao="direcao" :order-by="orderBy" coluna="email_proprietario"/>
                                </th>
                                <th @click="orderByChange('rua')" style="cursor: pointer" scope="col">
                                    <direcao-order-component title="Endereço" :direcao="direcao" :order-by="orderBy" coluna="rua"/>
                                </th>
                                <th @click="orderByChange('id_status')" style="cursor: pointer" scope="col">
                                    <direcao-order-component title="Status" :direcao="direcao" :order-by="orderBy" coluna="id_status"/>
                                </th>
                                <th scope="col">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="row in dataSet.data" :key="row.id">
                                <td>{{ row.email_proprietario }}</td>
                                <td>
                                    {{ row.rua }}, {{ row.numero }}, {{ row.cidade }}, {{ row.estado }}
                                </td>
                                <td>
                                    <span v-if="row.id_status === 1" class="badge badge-info"> {{ row.status.name }} </span>
                                    <span v-if="row.id_status === 2" class="badge badge-success"> {{ row.status.name }} </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger" @click.prevent="deleteItem(row)"><i class="el-icon-delete"></i> Remover</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <paginate-component
            class="mt-2"
            :pagination="dataSet"
            :offset="offset"
            @paginate="getData"
        />

        <nova-propriedade-component
            :visible="novaPropriedadeModal"
            :handleClose="() => { this.novaPropriedadeModal = false }"
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
