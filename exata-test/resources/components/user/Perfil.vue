<script setup>
import Header from "../partials/Header.vue";
import Sidebar from "../partials/Sidebar.vue";
import {onMounted, ref} from "vue";
import Info from "./Info.vue";
import Estatisticas from "./Estatisticas.vue";
import userService from "../../js/services/userService.js";
import {useAuthStore} from "../../js/stores/authStore.js";
import tarefasService from "../../js/services/tarefasService.js";
import ModalEdit from "./ModalEdit.vue";
import {ElNotification} from "element-plus";

// ----------------
// - Propriedades -
// ----------------
const profilePicture = ref("https://static.thenounproject.com/png/354384-200.png");
const authStore = useAuthStore();
const userData = ref({});
const statisticData = ref({});
const modalOpen = ref(false);
const loading = ref(true);

// -----------
// - Funções -
// -----------
const fetchUser = async () => {
    const response = await userService.getUserById(authStore.userId);

    if (response.data) {
        userData.value = response.data;

        loading.value = false;
    }
};

const getData = async () => {
    try {
        const response = await tarefasService.getTaskCountsByUserId(authStore.userId);

        statisticData.value = response.data;
    } catch(err) {
    }
};

const openModal = () => {
    modalOpen.value = true;
};

const closeModal = () => {
    modalOpen.value = false;
};

// -----------
// - Eventos -
// -----------
onMounted(() => {{
    authStore.checkSession();
    setTimeout(() => {
        fetchUser();
        getData();
    },1000);
}});
</script>

<template>
    <main>
        <Header />
        <section>
            <Sidebar />

            <div v-if="modalOpen">
                <ModalEdit :id="authStore.userId" @close-modal="closeModal" />
            </div>

            <article>
                <div class="header-container">

                    <h1>Perfil de
                        <span v-if="!loading">{{ userData.nome }}</span>
                    </h1>

                    <el-skeleton style="width: 10%; padding: 0 8px" :loading="loading" animated>
                        <template #template>
                            <el-skeleton-item variant="h3" />
                        </template>
                    </el-skeleton>

                    <el-tooltip
                        class="box-item"
                        effect="dark"
                        content="Editar usuário"
                        placement="right"
                    >
                        <a @click="openModal"><v-icon class="edit-user" name="fa-edit" /></a>
                    </el-tooltip>

                </div>

                <div class="perfil-container">

                    <div class="avatar-container">
                        <el-avatar :size="100" :src="profilePicture" />
                    </div>

                    <div class="info-container">
                        <Info :nome="userData.nome" :data_criacao="userData.data_criacao" :is_admin="userData.admin" />

                        <div class="divider-container">
                            <el-divider />
                        </div>

                        <Estatisticas :pendente="statisticData.pendentes" :em-andamento="statisticData.emAndamento" :concluidas="statisticData.concluidas" />
                    </div>

                </div>
            </article>
        </section>
    </main>
</template>

<style scoped>


article {
    display: flex;
    flex-direction: column;
}

h1 {
    font-size: 1.5rem;

}

.perfil-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

}

.avatar-container{
    margin: 64px 0;
}

.divider-container {
    margin: 32px 0;
}

.header-container {
    display: flex;
    align-items: center;

}

.edit-user {
    margin: 0 4px;
    background-color: var(--el-color-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 4px;
    border-radius: 4px;
    cursor: pointer;
}

</style>
