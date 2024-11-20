<script setup>
import {onMounted, ref} from 'vue';
import { useAuthStore } from "../../js/stores/authStore.js";
import router from '../../js/routes/router.js';
import userService from "../../js/services/userService.js";
import {ElNotification} from "element-plus";

// ----------------
// - Propriedades -
// ----------------
const active = ref(2);
const profilePicture = ref("https://static.thenounproject.com/png/354384-200.png");
const userData = ref({});
const loading = ref(true);
const authStore = useAuthStore();
const subAtual = window.location.href;

// -----------
// - Funções -
// -----------
const fetchUser = async () => {
    const response = await userService.getUserById(authStore.userId);

    if (response.data) {
        userData.value = response.data;
        loading.value = false;
    } else {
        ElNotification({
            title: "Erro",
            message: "Erro ao recuperar dados",
            type: "error"
        });
    }
};

// -----------
// - Eventos -
// -----------
onMounted(() => {{
    authStore.checkSession();
    setTimeout(() => {
        fetchUser();
    },1000);
}});

if (subAtual.includes('/tarefas')) {
    active.value = 3;
}

if (subAtual.includes('/dashboard')) {
    active.value = 2;
}
</script>

<template>
    <aside>

        <div class="avatar-container">
            <el-avatar :size="48" :src="profilePicture" >

            </el-avatar>

            <el-skeleton style="width: 40%; padding: 0 8px"  :loading="loading" animated>
                <template #template>
                    <el-skeleton-item variant="p" />
                </template>
            </el-skeleton>

            <div class="nome-container">
                <p v-if="!loading">{{ userData.nome }}</p>
                <el-tag
                    v-if="authStore.isAdmin"
                    type="primary"
                    effect="dark"
                    round
                >
                    Admin
                </el-tag>
            </div>

        </div>

        <div class="divider-container">
            <el-divider />
        </div>

        <el-menu
            :default-active="active"
            background-color="#051020"
            class="el-menu-vertical-demo"
        >

            <el-menu-item class="menu-item" index="2" @click="router.push('/dashboard')">
                <v-icon scale="1.1" name="co-home" />
                <span>Dashboard</span>
            </el-menu-item>

            <el-menu-item class="menu-item" index="3" @click="router.push('/tarefas')">
                <v-icon scale="1.1" name="fa-tasks" />
                <span>Tarefas</span>
            </el-menu-item>

            <el-menu-item v-if="authStore.isAdmin" class="menu-item" index="4" @click="router.push('/usuarios')">
                <v-icon scale="1.1" name="hi-user-group" />
                <span>Usuários</span>
            </el-menu-item>
        </el-menu>
    </aside>
</template>

<style scoped>

aside {
    background-color: #051020;
    min-width: 256px;
    height: 100vh;
}

aside > .el-menu {
    max-width: 248px!important;
}

.avatar-container {
    width: 100%;
    display: flex;
    align-items: center;
    padding: 16px;

}

.avatar-container > p {
    margin-left: 8px;
}


.divider-container {
    width: 60%;
    margin: 0 auto;
}

.nome-container {
    display: flex;
    align-items: center;
    margin: 0 8px;
}

.nome-container > p {
    margin: 0 4px;
}

.menu-item {
    display: flex;
    color: var(--el-color-white) !important;
    align-items: center;
}

.menu-item > svg {
    margin: 0 4px;
}

.menu-item.is-active{
    color: var(--el-color-primary)!important;
}


</style>
