<script setup>
import {ref} from 'vue';
import {useAuthStore} from "../../js/stores/authStore.js";
import {ElNotification} from "element-plus";
import router from '../../js/routes/router.js'


const isDialogOpen = ref(true);

const authStore = useAuthStore();

const form = ref({
    nomePessoa: "",
    nomeUsuario: "",
    isAdmin: false,
    senha:"",
    confirmarSenha: ""
});


const submitForm = async () => {
    try {
        const payload = {
            nome: form.value.nomePessoa,
            nome_usuario: form.value.nomeUsuario,
            password: form.value.senha,
            password_confirmation: form.value.confirmarSenha,
            admin: form.value.isAdmin
        };

        await authStore.register(payload);
        await router.push("/login");
    } catch (err) {
        console.error(err);
    }
};


</script>

<template>
    <main>
        <el-dialog v-model="isDialogOpen" title="Formulario de cadastro" width="500">
            <el-form :model="form" label-position="left" label-width="150px">
                <el-form-item label="Nome">
                    <el-input v-model="form.nomePessoa" />
                </el-form-item>
                <el-form-item label="Nome de usuário">
                    <el-input v-model="form.nomeUsuario" />
                </el-form-item>
                <el-form-item label="Admin?">
                    <el-switch v-model="form.isAdmin" />
                </el-form-item>
                <el-form-item>
                    <template #label>
                        Crie uma senha
                        <v-icon name="bi-info-circle" />
                    </template>
                    <el-input
                        v-model="form.senha"
                        type="password"
                        show-password
                    />
                </el-form-item>
                <el-form-item label="Confirmar Senha">
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

</style>
