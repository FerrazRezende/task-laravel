<script setup>
import {useAuthStore} from "../../js/stores/authStore.js";
import router from '../../js/routes/router.js';

// ----------------
// - Propriedades -
// ----------------
const authStore = useAuthStore();
</script>

<template>
    <main>

        <div class="logo-container">
            <img src="https://www.exata.it/wp-content/uploads/2023/03/exata-icone-cloud-intelligence-min.png">
        </div>

        <div>
            <el-button text @click="router.push('/dashboard')">Home</el-button>
            <el-divider direction="vertical" />
            <el-button text @click="router.push('/perfil')">Perfil</el-button>
            <el-divider direction="vertical" />

            <el-tooltip
                class="box-item"
                effect="dark"
                content="Efetuar logout"
                placement="bottom"
            >
                <a @click="authStore.logout()"><v-icon class="logout-icon" name="md-logout" /></a>
            </el-tooltip>

        </div>
    </main>
</template>


<style scoped>
main {
    overflow: hidden;
    width: calc(100% - 52px);
    height: 64px;
    background-color: var(--color-secondary);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 32px;
}

.logo-container > img {
    width: 48px;
    height: 48px;
}

.el-button{
    color: var(--el-color-white)!important;
}

.el-button:hover {
    background-color: var(--el-color-white)!important;
    color: var(--el-color-primary)!important;
}



.logout-icon {
    width: 32px;
    color: var(--el-color-white)!important;
    cursor: pointer;
}

</style>
