<script setup>
import {ref} from "vue";
import {useAuthStore} from "../../js/stores/authStore.js";
import {ElNotification} from "element-plus";
import router from "../../js/routes/router.js"

const username = ref("");
const password = ref("");

const handleLogin = async () => {
    const authStore = useAuthStore();

    const success = await authStore.login(username.value, password.value);

    if(success) {
        router.push('/dashboard')

    } else {
        ElNotification({
            title: 'Erro',
            message: 'O Login falhou',
            type: 'error',
        });
    }

}



</script>

<template>
    <el-form
        ref=""
        style="max-width: 600px"
        status-icon
        label-width="auto"
        class="demo-ruleForm"
    >
        <el-form-item label="Usuário" prop="username">
            <el-input v-model="username" type="text" autocomplete="off" />
        </el-form-item>
        <el-form-item label="Senha" prop="password">
            <el-input
                v-model="password"
                type="password"
                autocomplete="off"
            />
        </el-form-item>
        <el-form-item>
            <div class="btn-container">
                <el-button @click="handleLogin" class="login-btn" type="primary">
                    Entrar
                </el-button>
                <el-button link>Esqueci a senha</el-button>
            </div>
        </el-form-item>
    </el-form>
</template>

<style scoped>

.btn-container{
    width: 100%;
    display: flex;
    flex-direction: row-reverse;
    justify-content: space-between;
}

.login-btn:hover {
    background-color: var(--el-color-primary);
}
</style>
