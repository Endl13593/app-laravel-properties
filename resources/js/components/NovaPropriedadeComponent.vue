<template>
    <el-dialog
        title="Adicionar Propriedade"
        :visible.sync="visible"
        :before-close="handleClose"
        width="600px"
        top="10px"
        :close-on-click-modal="false"
    >
        <el-form :model="form" :rules="rules" ref="ruleForm" label-width="170px" class="demo-ruleForm">

            <el-form-item label="E-mail do Proprietário" prop="email_proprietario">
                <el-input v-model="form.email_proprietario"></el-input>
                <div class="el-form-item__error" v-if="errors.email_proprietario">{{ errors.email_proprietario[0] }}</div>
            </el-form-item>

            <el-form-item label="Rua" prop="rua">
                <el-input v-model="form.rua"></el-input>
                <div class="el-form-item__error" v-if="errors.rua">{{ errors.rua[0] }}</div>
            </el-form-item>

            <el-form-item label="Número" prop="numero">
                <el-input v-model="form.numero"></el-input>
            </el-form-item>

            <el-form-item label="Bairro" prop="bairro">
                <el-input v-model="form.bairro"></el-input>
                <div class="el-form-item__error" v-if="errors.bairro">{{ errors.bairro[0] }}</div>
            </el-form-item>

            <el-form-item label="Complemento" prop="complemento">
                <el-input v-model="form.complemento"></el-input>
            </el-form-item>

            <el-form-item label="Cidade" prop="cidade">
                <el-input v-model="form.cidade"></el-input>
                <div class="el-form-item__error" v-if="errors.cidade">{{ errors.cidade[0] }}</div>
            </el-form-item>

            <el-form-item label="Estado" prop="estado">
                <el-input v-model="form.estado"></el-input>
                <div class="el-form-item__error" v-if="errors.estado">{{ errors.estado[0] }}</div>
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
    name: 'NovaPropriedadeComponent',
    data() {
        return {
            btnActive: false,
            errors : {},
            form: {
                email_proprietario: '',
                rua: '',
                numero: '',
                complemento: '',
                bairro: '',
                cidade: '',
                estado: ''
            },
            rules    : {
                email_proprietario: [
                    {  type: 'email', required: true, message: 'Por favor informe um e-mail válido', trigger: 'blur' },
                ],
                rua: [
                    {  required: true, message: 'Por favor informe a rua', trigger: 'blur' }
                ],
                bairro: [
                    {  required: true, message: 'Por favor informe o bairro', trigger: 'blur' }
                ],
                cidade: [
                    { required: true, message: 'Por favor informe a cidade', trigger: 'blur' }
                ],
                estado: [
                    { required: true, message: 'Por favor informe o estado', trigger: 'blur' }
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

                await axios.post('propriedades', this.form)
                    .then(() => {
                            this.handleClose();
                            this.$message.success('Propriedade cadastrada com sucesso!')
                            this.$emit('REFRESH');
                        }
                    ).catch((error) => {
                        this.errors = error.response.data.errors;
                    }).finally(() => {
                        this.btnActive = false;
                    })
            });
        },

        resetFormValidation() {
            this.$refs.ruleForm.resetFields();
        },

        clearFields() {
            this.form.email_proprietario = '';
            this.form.rua = '';
            this.form.numero = '';
            this.form.complemento = '';
            this.form.bairro = '';
            this.form.cidade = '';
            this.form.estado = '';
            this.errors = {};
        }
    },
    watch: {
        visible(newValue) {
            if (newValue) {
                this.clearFields();
            } else {
                this.resetFormValidation();
            }
        }
    }
}
</script>

