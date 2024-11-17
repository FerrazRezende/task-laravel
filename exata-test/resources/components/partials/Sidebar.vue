<script setup>
import { ref } from 'vue';
import { useAuthStore } from "../../js/stores/authStore.js";
import router from '../../js/routes/router.js';

const active = ref(2);
const profilePicture = ref("https://static.thenounproject.com/png/354384-200.png");

const authStore = useAuthStore();

const subAtual = window.location.href;

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
<!--                <el-skeleton :loading="loading" animated>-->
<!--                    <template #template>-->
<!--                        <el-skeleton-item variant="circle" />-->
<!--                    </template>-->
<!--                </el-skeleton>-->

            </el-avatar>
            <div class="nome-container">
                <p>Matheus</p>
                <el-tag
                    v-if="authStore.isAdmin"
                    type="primary"
                    effect="dark"
                    round
                >
                    Admin
                </el-tag>
            </div>

<!--            <el-skeleton style="width: 150px" :loading="loading" animated>-->
<!--                <template #template>-->
<!--                    <el-skeleton-item variant="p" style="width: 120px;"/>-->
<!--                </template>-->

<!--            </el-skeleton>-->

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
