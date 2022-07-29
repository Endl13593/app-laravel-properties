<template>
    <el-dialog
        title="Gerar Contrato"
        :visible.sync="visible"
        :before-close="handleClose"
        width="800px"
        top="10px"
        :close-on-click-modal="false"
    >
        <el-form :model="form" :rules="rules" ref="ruleForm" label-width="250px" class="demo-ruleForm" v-loading="preloader">

            <el-form-item label="Propriedade" prop="id_propriedade">
                <el-select
                    placeholder="Selecione a propriedade"
                    value-key="id"
                    v-model="propriedadeSelected"
                    filterable
                    @change="selectPropriedade"
                    style="width: 100%"
                >
                    <el-option
                        v-for="row in propriedades"
                        :key="row.id"
                        :label="`${row.rua}, ${row.numero ? row.numero + ', ': ''} ${row.complemento ? row.complemento + ', ' : ''} ${row.bairro}`"
                        :value="row"
                    >
                    </el-option>
                </el-select>

                <div v-if="propriedadeSelected.rua" style="font-weight: bold">
                    {{ propriedadeSelected.rua }},
                    {{ propriedadeSelected.numero ? propriedadeSelected.numero + ', ' : '' }}
                    {{ propriedadeSelected.complemento ? propriedadeSelected.complemento + ', ' : '' }}
                    {{ propriedadeSelected.bairro }}
                </div>

                <div class="el-form-item__error" v-if="errors.id_propriedade">{{ errors.id_propriedade[0] }}</div>

            </el-form-item>

            <el-form-item label="Tipo de Pessoa:" prop="id_tipo_de_pessoa">
                <el-radio-group v-model="form.id_tipo_de_pessoa">
                    <el-radio v-for="row in tipoDePessoa" :label="row.id" :key="row.id" border>{{ row.name }}</el-radio>
                </el-radio-group>

                <div class="el-form-item__error" v-if="errors.id_tipo_de_pessoa">{{ errors.id_tipo_de_pessoa[0] }}</div>
            </el-form-item>



            <el-form-item label="Nº Documento Contratante" prop="documento_contratante">

                <el-input :placeholder="placeholderDocumento" v-model="form.documento_contratante" v-mask="maskDocumento"></el-input>
                <div class="el-form-item__error" v-if="errors.documento_contratante">{{ errors.documento_contratante[0] }}</div>

            </el-form-item>

            <el-form-item label="E-mail do Contratante" prop="email_contratante">
                <el-input v-model="form.email_contratante" @blur="form.email_contratante = form.email_contratante.toLowerCase()"></el-input>
                <div class="el-form-item__error" v-if="errors.email_contratante">{{ errors.email_contratante[0] }}</div>
            </el-form-item>

            <el-form-item label="Nome Completo Contratante:" prop="nome_contratante">
                <el-input v-model="form.nome_contratante"></el-input>
                <div class="el-form-item__error" v-if="errors.nome_contratante">{{ errors.nome_contratante[0] }}</div>
            </el-form-item>
        </el-form>

        <span slot="footer" class="dialog-footer">
            <el-button
                type="primary"
                size="small"
                icon="el-icon-success"
                :loading="btnActive"
                @click="submit"
            >
            Salvar
            </el-button>
        </span>
    </el-dialog>
</template>

<script>
export default {
    name: 'NovoContratoComponent',
    data() {
        return {
            maskDocumento: '',
            placeholderDocumento: '',
            preloader: false,
            btnActive: false,
            errors : {},
            propriedades : [],
            propriedadeSelected: {},
            tipoDePessoa: [],
            form: {
                nome_contratante: '',
                email_contratante: '',
                documento_contratante: '',
                id_tipo_de_pessoa: '',
                id_propriedade: ''
            },
            rules    : {
                email_contratante: [
                    { required: true, message: 'Por favor informe o e-mail', trigger: 'blur' },
                    { type: 'email', required: true, message: 'Por favor informe um e-mail válido', trigger: 'blur' }
                ],
                nome_contratante: [
                    { required: true, message: 'Por favor informe o nome do contratante', trigger: 'blur' },
                ],
                id_tipo_de_pessoa: [
                    { required: true, message: 'Por favor informe o tipo de pessoa', trigger: 'change' },
                ],
                id_propriedade: [
                    { required: true, message: 'Por favor informe a propriedade', trigger: 'change' },
                ],
                documento_contratante: [
                    { required: true, message: 'Por favor informe o documento do contratante', trigger: 'blur' },
                    { pattern:/(^\d{3}\.\d{3}\.\d{3}\-\d{2}$)|(^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$)/,
                        message: 'Por favor informe o documento do contratante corretamente',
                        trigger: 'blur'
                    }
                ],
            }
        }
    },

    props: {
        visible: {
            type: Boolean,
            required: true
        },
        handleClose: {
            type: Function,
            required: true
        }
    },

    methods: {
        async submit() {
            await this.$refs.ruleForm.validate(async (valid) => {

                if (!valid) return;

                this.btnActive = true;

                await axios.post('contratos', this.form)
                    .then(() => {
                            this.handleClose();
                            this.$message.success('Contrato gerado com sucesso!')
                            this.$emit('REFRESH');
                        }
                    ).catch((error) => {
                        this.errors = error.response.data.errors;
                    }).finally(() => {
                        this.btnActive = false;
                    })
            });
        },

        async getPropriedades() {
            this.preloader = true;

            await axios
                .get(`contratos/propriedades`)
                .then(response => {
                    this.propriedades = response.data;
                }).finally(() => this.preloader = false);
        },

        async getTipoDePessoa() {
            this.preloader = true;

            await axios
                .get(`contratos/tipo-de-pessoa`)
                .then(response => {
                    this.tipoDePessoa = response.data;
                }).finally(() => this.preloader = false);
        },

        resetFormValidation() {
            if (this.$refs.ruleForm) {
                this.$refs.ruleForm.resetFields();
            }
        },

        clearFields() {
            this.form.nome_contratante = '';
            this.form.email_contratante = '';
            this.form.documento_contratante = '';
            this.form.id_tipo_de_pessoa = '';
            this.form.id_propriedade = '';
            this.propriedadeSelected = {};
            this.errors = {};
        },

        selectPropriedade(param) {
            this.form.id_propriedade = param.id;
        }
    },
    watch: {
        visible(newValue) {
            if (newValue) {
                this.clearFields();
                this.getPropriedades();
                this.getTipoDePessoa();
                this.resetFormValidation();
            }
        },
        'form.id_tipo_de_pessoa'(newValue){
            if (newValue === 1) {
                this.maskDocumento = '###.###.###-##';
                this.placeholderDocumento = '000.000.000-00'
            }
            if (newValue === 2) {
                this.maskDocumento = '##.###.###/####-##';
                this.placeholderDocumento = '00.000.000/0000-00'
            }
        }
    }
}
</script>

