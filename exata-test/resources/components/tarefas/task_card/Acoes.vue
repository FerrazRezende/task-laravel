<script setup>
import ModalEditTask from "../ModalEditTask.vue";
import {ref} from 'vue';
import ModalUpdateStatus from "../ModalUpdateStatus.vue";
import tarefasService from "../../../js/services/tarefasService.js";
import {ElNotification} from "element-plus";

// ----------------
// - Propriedades -
// ----------------
const { id } = defineProps({
    id: {
        type: Number,
        required: true
    }
});

const modalOpen = ref(false);
const statusOpen = ref(false);

// -----------
// - Funções -
// -----------
const openModalEdit = () => {
    modalOpen.value = true;
};

const openStatusModal = () => {
    statusOpen.value = true;
};

const deleteTask = async () => {
    try {
        const response = await tarefasService.deleteTask(id);

        if(response) {

            ElNotification({
                title: "Ok",
                message: "Tarefa excluída com sucesso",
                type: "success"
            });

            setTimeout(() => {
                location.reload();
            }, 1000);
        }
    } catch (err) {
        ElNotification({
            title: "erro",
            message: "Erro ao excluir a tarefa",
            type: "error"
        });
    }
};
</script>

<template>
    <main>

        <div v-if="modalOpen">
            <ModalEditTask :id="id" />
        </div>

        <div v-if="statusOpen">
            <ModalUpdateStatus :id="id" />
        </div>


        <h1>Ações</h1>

        <div>
            <el-tooltip
                effect="dark"
                content="Editar tarefa"
                placement="top"
            >
                <a @click.stop="openModalEdit"><v-icon name="fa-edit" scale="1.5" /></a>
            </el-tooltip>

            <el-tooltip
                effect="dark"
                content="Atualizar status"
                placement="top"
            >
                <a @click.stop="openStatusModal"><v-icon name="hi-plus-circle" scale="1.5" /></a>
            </el-tooltip>

            <el-tooltip
                effect="dark"
                content="Excluir tarefa"
                placement="top"
            >
                <el-popconfirm title="Deseja realmente excluir essa tarefa?">
                    <template #reference>
                        <a @click.stop><v-icon name="md-deleteforever" scale="1.5" /></a>
                    </template>

                    <template #actions="{ confirm, cancel }">
                        <el-button size="small" @click="cancel">Não</el-button>
                        <el-button
                            type="primary"
                            size="small"
                            :disabled="false"
                            @click="deleteTask"
                        >
                            Sim
                        </el-button>
                    </template>
                </el-popconfirm>
            </el-tooltip>
        </div>

    </main>
</template>

<style scoped>
div {
    margin: 18px 0;
}

a {
    margin: 0 16px;
    cursor: pointer;
}

h1 {
    margin: 8px 0;
}
</style>
