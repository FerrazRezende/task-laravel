<script setup>
import {ref} from "vue";
import Titulo from "./task_card/Titulo.vue";
import LinhaVertical from "./task_card/LinhaVertical.vue";
import DataDescricao from "./task_card/DataDescricao.vue";
import UserTask from "./task_card/UserTask.vue";
import Status from "./task_card/Status.vue";
import TituloCollapse from "./task_card/collapse/TituloCollapse.vue";
import DescricaoDataCollapse from "./task_card/collapse/DescricaoDataCollapse.vue";
import LinhaVerticalCollapse from "./task_card/collapse/LinhaVerticalCollapse.vue";
import StatusCollapse from "./task_card/collapse/StatusCollapse.vue";
import Acoes from "./task_card/Acoes.vue";

// ----------------
// - Propriedades -
// ----------------
const { task, status } = defineProps({
    task: {
        type: Object,
        required: true
    },
    status: {
        type: String,
        required: true
    }
})

const collapsedCards = ref([]);

// -----------
// - Funções -
// -----------
const formatDate = (dateString) => {
    if(!dateString) return null;

    return new Date(dateString).toLocaleDateString('pt-BR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    });
}

const getStatusType = (status) => {
    switch (status) {
        case 'Pendente':
            return 'primary';
        case 'Em andamento':
            return 'info';
        case 'Concluido':
            return 'danger';
        default:
            return 'default';
    }
};

const getStatusId = (status) => {
    switch (status) {
        case 'Pendente':
            return 1;

        case 'Em andamento':
            return 2;

        case 'Concluido':
            return 3;

        default:
            return 0;
    }
};

const toggleCollapse = (index) => {

    if (collapsedCards.value.includes(index)) {
        collapsedCards.value = collapsedCards.value.filter(i => i !== index);

    } else {
        collapsedCards.value.push(index);
    }
};
</script>

<template>
    <main>
        <div
            :class="['task-card', status, { collapse: collapsedCards.includes(task.id) }]"
            @click="toggleCollapse(task.id)"
        >
            <template v-if="!collapsedCards.includes(task.id)">

                <div style="width: 15%">
                    <Titulo :titulo="task.titulo" />
                </div>

                <LinhaVertical />

                <div style="width: 37%">
                    <DataDescricao :descricao="task.descricao" :data="formatDate(task.data_criacao)" />
                </div>

                <LinhaVertical />

                <div class="status-container">
                    <Status :status="task.status" :type="getStatusType(task.status)" :background="status" />
                </div>

                <LinhaVertical />

                <div class="user-container">
                    <UserTask :userId="task.user_id" />
                </div>

                <LinhaVertical />
            </template>

            <template v-else>
                <div class="cardc-container" style="width: 100%; text-align: center;">

                    <div class="titulo-descricao">
                        <TituloCollapse :titulo="task.titulo" />
                        <DescricaoDataCollapse
                            :data-modificacao="formatDate(task.data_modificacao)"
                            :data-criacao="formatDate(task.data_criacao)"
                            :descricao="task.descricao"
                        />
                    </div>

                    <LinhaVerticalCollapse />

                    <div class="statusc-container">
                        <StatusCollapse :status="getStatusId(task.status)" />
                    </div>

                    <LinhaVerticalCollapse />

                    <div class="acoes-container">
                        <Acoes :id="task.id" />
                    </div>

                </div>
            </template>
        </div>
    </main>
</template>

<style scoped>

.task-card.collapse {
    height: 255px !important;
}

.status-container{
    width: 16%;
}

.user-container {
    display: flex;
    align-items: center;
}

.task-card {
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    width: 80%;
    height: 88px;
    border-radius: 8px;
    margin: 24px 0;
    transition: height 0.2s ease;
    padding: 0 32px;
    display: flex;
}

.andamento {
    background-color: rgb(0, 0, 139, 0.5)!important;
}

.pendente {
    background-color: rgb(255, 69, 0, 0.5)!important;
}

.finalizada {
    background-color: rgba(0, 100, 0, 0.5)!important;
}

.user-container > p {
    margin: 0 8px ;
}

h2 {
    padding: 16px 0;
}

.cardc-container{
    display: flex;
}

.titulo-descricao {
    width: 35%;
    margin: auto 0;
}

.statusc-container {
    margin: auto 0;
}

.acoes-container {
    margin: auto 0;
}
</style>
