<script setup>
import {defineEmits, reactive, ref} from 'vue';
import {useAuthStore} from "../../js/stores/authStore.js";
import router from '../../js/routes/router.js'
import {ElNotification} from "element-plus";

// ----------------
// - Propriedades -
// ----------------
const emit = defineEmits();
const isDialogOpen = ref(true);
const authStore = useAuthStore();
const formSize = ref('default');
const formRef = ref(null);

const form = reactive({
    nomePessoa: "",
    nomeUsuario: "",
    isAdmin: false,
    senha: "",
    confirmarSenha: ""
});

const rules = reactive({
    nomePessoa: [
        { required: true, message: 'Por favor, insira o nome', trigger: 'blur' }
    ],
    nomeUsuario: [
        { required: true, message: 'Por favor, insira o nome de usuário', trigger: 'blur' }
    ],
    senha: [
        {
            required: true,
            message: 'Por favor, insira a senha',
            trigger: 'blur'
        },
        {
            min: 8,
            message: 'A senha deve ter pelo menos 8 caracteres',
            trigger: 'blur'
        },
        {
            pattern: /[A-Z]/,
            message: 'A senha deve conter pelo menos uma letra maiúscula',
            trigger: 'blur'
        }
    ],
    confirmarSenha: [
        {
            required: true,
            message: 'Por favor, confirme a senha',
            trigger: 'blur'
        },
        {
            validator: (rule, value, callback) => {
                if (value !== form.senha) {
                    callback(new Error('As senhas não coincidem'));
                } else {
                    callback();
                }
            },
            trigger: 'blur'
        }
    ]
});

// -----------
// - Funções -
// -----------
const submitForm = async () => {
    if (!formRef.value) return;

    await formRef.value.validate((valid) => {
        if (valid) {
            const payload = {
                nome: form.nomePessoa,
                nome_usuario: form.nomeUsuario,
                password: form.senha,
                password_confirmation: form.confirmarSenha,
                admin: form.isAdmin
            };
            const authStore = useAuthStore();
            authStore.register(payload);

            router.push("/login");
        } else {
            ElNotification({
                title: "Erro",
                message: "Erro ao enviar",
                type: "error"
            });
        }
    });
};

const handleClose = () => {
    emit('close-modal');
};
</script>

<template>
    <main>
        <el-dialog v-model="isDialogOpen" :show-close="false" width="500">

            <template #header>
                <div class="my-header">
                    <h1>Formulário de cadastro</h1>
                    <a @click="handleClose">
                        <v-icon name="io-close-circle-outline" />
                    </a>
                </div>
            </template>

            <el-form
                ref="formRef"
                style="max-width: 600px"
                :model="form"
                :rules="rules"
                label-width="auto"
                class="demo-ruleForm"
                :size="formSize"
                status-icon
            >

                <el-form-item label="Nome" prop="nomePessoa">
                    <el-input v-model="form.nomePessoa" />
                </el-form-item>

                <el-form-item label="Nome de usuário" prop="nomeUsuario">
                    <el-input v-model="form.nomeUsuario" />
                </el-form-item>

                <el-form-item label="Admin?" prop="isAdmin">
                    <el-switch v-model="form.isAdmin" />
                </el-form-item>

                <el-form-item class="senha-form" label="Crie uma senha" prop="senha">
                    <div class="senha-input">
                        <el-tooltip
                            effect="dark"
                            content="Sua senha deve conter mais de 8 dígitos e pelo menos uma letra maiúscula"
                            placement="right"
                        >
                            <v-icon name="bi-info-circle" />
                        </el-tooltip>
                        <el-input
                            v-model="form.senha"
                            type="password"
                            show-password
                        />
                    </div>
                </el-form-item>

                <el-form-item label="Confirmar Senha" prop="confirmarSenha">
                    <el-input
                        v-model="form.confirmarSenha"
                        type="password"
                        show-password
                    />
                </el-form-item>

            </el-form>

            <template #footer>
                <div class="dialog-footer">
                    <el-button type="primary" @click="submitForm">
                        Cadastrar
                    </el-button>
                </div>
            </template>

        </el-dialog>
    </main>
</template>

<style>

.el-button:hover {
    background-color: #956403FF!important;
}

.my-header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 16px;
    cursor: pointer;
}

.senha-input{
    margin-left: -12px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.senha-form {
    margin: 0 -10px;
}

</style>
