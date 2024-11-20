<script setup>
import router from '../../js/routes/router.js';
import { defineEmits } from 'vue';


// ----------------
// - Propriedades -
// ----------------
const emit = defineEmits(['openModal']);


// -----------
// - Funções -
// -----------
const openModal = () => {
    emit('openModal');
}
const goToLogin = () => {
    router.push('/login');
}
</script>

<template>
    <header>

        <div>
            <img src="https://www.exata.it/wp-content/uploads/2023/02/logo-Exata-white1-1.png">
        </div>

        <div>
            <el-button @click="goToLogin" class="login" type="primary">Login </el-button>
            <el-button @click="openModal" class="cadastro" type="success">Cadastro </el-button>
        </div>

    </header>
</template>

<style scoped>
header {
    padding: 0 32px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 84px;
    width: calc(100% - 52px);
    background-color: var(--color-secondary);
}

div > .el-button {
    margin: 0 4px;
}

.login:hover {
    background-color: var(--el-color-primary)!important;
    border: solid 1px var(--el-color-primary)!important;
}

.cadastro:hover {
    background-color: var(--el-color-success)!important;
    border: solid 1px var(--el-color-success)!important;
}



</style>
