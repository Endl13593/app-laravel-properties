<template>
    <div class="mt-3">
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="card">
                    <div class="card-header">Contratos</div>

                    <div class="card-body table-responsive">
                        <button class="btn btn-success btn-sm mb-2" @click.prevent="novoContratoModal = true"><i class="el-icon-circle-plus"></i> Gerar Novo Contrato</button>
                        <table class="table table-hover" v-loading="preloader">
                            <thead>
                            <tr>
                                <th scope="col">
                                    Propriedade
                                </th>
                                <th @click="orderByChange('id_tipo_de_pessoa')" style="cursor: pointer" scope="col">
                                    <direcao-order-component title="Tipo de Pessoa" :direcao="direcao" :order-by="orderBy" coluna="id_tipo_de_pessoa"/>
                                </th>
                                <th @click="orderByChange('documento_contratante')" style="cursor: pointer" scope="col">
                                    <direcao-order-component title="Documento Contratante" :direcao="direcao" :order-by="orderBy" coluna="documento_contratante"/>
                                </th>
                                <th @click="orderByChange('nome_contratante')" style="cursor: pointer" scope="col">
                                    <direcao-order-component title="Nome Contratante" :direcao="direcao" :order-by="orderBy" coluna="nome_contratante"/>
                                </th>
                                <th @click="orderByChange('email_contratante')" style="cursor: pointer" scope="col">
                                    <direcao-order-component title="Email Contratante" :direcao="direcao" :order-by="orderBy" coluna="email_contratante"/>
                                </th>
                                <th @click="orderByChange('created_at')" style="cursor: pointer" scope="col">
                                    <direcao-order-component title="Criado Em" :direcao="direcao" :order-by="orderBy" coluna="created_at"/>
                                </th>
                                <th scope="col">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="row in dataSet.data" :key="row.id">
                                <td>{{ row.propriedade.rua }}, {{ row.propriedade.numero }}, {{ row.propriedade.complemento }}, {{ row.propriedade.bairro }}</td>
                                <td>{{ row.tipoDePessoa.name }}</td>
                                <td>{{ row.documento_contratante }}</td>
                                <td>{{ row.nome_contratante }}</td>
                                <td>{{ row.email_contratante }}</td>
                                <td>{{ row.created_at }}</td>
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

        <novo-contrato-component
            :visible="novoContratoModal"
            :handleClose="() => { this.novoContratoModal = false }"
            @REFRESH="getData"/>

    </div>
</template>

<script>
import NovoContratoComponent from "../components/NovoContratoComponent";
import PaginateComponent from "../components/PaginateComponent";
import DirecaoOrderComponent from "../components/DirecaoOrderComponent";
export default {
    name: "Contrato",

    components: { NovoContratoComponent, PaginateComponent, DirecaoOrderComponent },

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
            novoContratoModal: false,
        }
    },

    created() {
        this.getData();
    },

    methods: {
        async getData(page = 1) {
            this.preloader = true;
            await axios
                .get(`contratos?page=${page}&direcao=${this.direcao}&orderBy=${this.orderBy}`)
                .then(response => {
                    this.dataSet = response.data.paginate;
                    this.direcao = response.data.direcao;
                    this.orderBy = response.data.orderBy;
                }).finally(() => this.preloader = false);
        },

        async deleteItem(obj) {
            this.$confirm(`Deseja realmente excluir o contrato pertencente a <strong>${obj.nome_contratante}</strong>?`,
                'Excluir', {
                    dangerouslyUseHTMLString: true,
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                    type: 'warning'})
                .then(async () => {
                    await axios.delete(`contratos/${obj.id}`)
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
