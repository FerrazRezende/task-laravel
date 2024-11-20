<script setup>
import Header from "../partials/Header.vue";
import Sidebar from "../partials/Sidebar.vue";

import {onMounted, ref} from 'vue';
import Filtros from "./Filtros.vue";
import TaskCard from "./TaskCard.vue";
import tarefasService from "../../js/services/tarefasService.js";
import {useAuthStore} from "../../js/stores/authStore.js";
import ModalCreateTask from "./ModalCreateTask.vue";

// ----------------
// - Propriedades -
// ----------------
const value = ref('');
const loading = ref(true);
const authStore = useAuthStore();
const tarefas = ref([]);
const modalCreateOpen = ref(false);

const filters = ref({
    status: null,
    orderField: null,
    orderDirection: 'asc',
    selectedUserId: null
});

// -----------
// - Funções -
// -----------
const loadTasks = async () => {

    if(authStore.isAdmin) {
        try {
            const response = await tarefasService.getAllTasks();

            tarefas.value = response.data;
            loading.value = false;

            return;
        } catch(err) {

        }
    }
    try {
        const response = await tarefasService.getTaskByUserId(authStore.userId);

        tarefas.value = response.data;
        loading.value = false;
    } catch (err) {

    }
}

const loadFilterTasks = async () => {
    try {
        const params = {};

        if (filters.value.status !== null) {
            params.status = filters.value.status;
        }

        if (filters.value.orderField) {
            params.orderField = filters.value.orderField;
        }
        if (filters.value.orderDirection) {
            params.orderDirection = filters.value.orderDirection;
        }

        if (filters.value.selectedUserId) {
            const response = await tarefasService.getTaskByUserId(filters.value.selectedUserId);
            tarefas.value = response.data
            return;
        }

        if (authStore.isAdmin) {
            const response = await tarefasService.filterTasksAdmin(params);
            tarefas.value = response.data
            return;
        }

        const response = await tarefasService.filterTasks(authStore.userId, params);

        tarefas.value = response.data;
    } catch (err) {

    }
};

const getTaskStatus = (status) => {
    switch (status) {
        case 'Pendente':
            return 'pendente';

        case 'Em andamento':
            return 'andamento';

        case 'Concluido':
            return 'finalizada';

        default:
            return 'pendente';
    }
};

const closeCreateModal = () => {
    modalCreateOpen.value = false;
}

const openCreateModal = () => {
    modalCreateOpen.value = true;
}

// -----------
// - Eventos -
// -----------
onMounted(() => {
    authStore.checkSession();
    setTimeout(() => {
        loadTasks();
    }, 1000);
});
</script>

<template>
    <main>
        <Header />

        <section>
            <Sidebar />

            <div v-if="modalCreateOpen">
                <ModalCreateTask @close-modal="closeCreateModal" />
            </div>

            <article>
                <div class="title-container">
                    <h1>Tarefas</h1>
                    <el-button type="primary" @click="openCreateModal">
                        <v-icon name="md-playlistadd-sharp" />
                        Nova tarefa
                    </el-button>
                </div>

                <div class="task-container">

                    <div class="filter-container">
                        <Filtros @update-filters="filters = $event; loadFilterTasks()" />
                    </div>

                    <div
                    v-for="(task, index) in tarefas"
                    :key="task.id"
                    >
                        <TaskCard :status="getTaskStatus(task.status)" :task="task" />
                    </div>

                    <div class="skeleton-container" v-if="loading">
                        <el-skeleton animated :loading="loading" :rows="2" />
                    </div>

                    <h1 v-if="!tarefas">Nenhuma tarefa ainda!</h1>

                </div>
            </article>
        </section>
    </main>
</template>

<style scoped>
.task-container {
    height: 75%;
    overflow: auto !important;
    margin: 16px 0;
    padding: 0 32px;
    border-radius: 16px;
    outline: 1px solid var(--el-color-primary);
}
.skeleton-container {
    width: 80%;
    height: 88px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    border-radius: 8px;
    margin: 24px 0;
    padding: 16px 32px;
}

.el-skeleton {
    --el-skeleton-color: var(--color-secondary)!important;
}

.filter-container {
    margin: 16px 0;
}

.title-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-right: 16px;
}
</style>
