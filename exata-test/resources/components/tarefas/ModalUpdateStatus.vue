<script setup>
import {defineEmits, onMounted, ref} from 'vue'
import tarefasService from "../../js/services/tarefasService.js";
import {ElNotification} from "element-plus";


// ----------------
// - Propriedades -
// ----------------
const {id} = defineProps({
    id: {
        type: Number,
        required: true
    }
});

const emit = defineEmits();
const centerDialogVisible = ref(true);
const value = ref('');

const options = [
    {
        value: 'Pendente',
        label: 'Pendente',
    },
    {
        value: 'Em andamento',
        label: 'Em andamento'
    },
    {
        value: 'Concluido',
        label: 'Concluido'
    }
];

// -----------
// - Funções -
// -----------
const fetchNewData = async () => {
    try {
        const payload = {
            status: value.value,
        };

        const response = await tarefasService.editTask(payload, id);

        if(response) {
            handleClose();

            ElNotification({
                title: "Ok",
                message: "Status atualizado com sucesso",
                type: "success"
            });

            setTimeout(() => {
                location.reload();
            }, 1000);
        }
    } catch(err) {
        ElNotification({
            title: "Erro",
            message: "Falha ao enviar dados",
            type: "error"
        });
    }
};

const fetchTaskStatus = async () => {
    try {
        const response = await tarefasService.getTaskById(id);

        if(response) {
            value.value = response.data.status;
        }

    } catch(err) {
        ElNotification({
            title: "Erro",
            message: "Falha ao recuperar status",
            type: "error"
        });
    }
};

const handleClose = () => {
    emit('close-modal');
};

// -----------
// - Eventos -
// -----------
onMounted(() => {
    fetchTaskStatus();
});
</script>

<template>
    <el-dialog
        v-model="centerDialogVisible"
        width="500"
        align-center
        :show-close="false"
    >

        <template #header>
            <div class="my-header">
                <h1>Atualizar status</h1>
                <a @click="handleClose">
                    <v-icon name="io-close-circle-outline" />
                </a>
            </div>
        </template>

        <el-select @click.stop v-model="value" placeholder="Selecione o status" style="width: 240px">

            <el-option
                v-for="item in options"
                :key="item.value"
                :label="item.label"
                :value="item.value"
                :disabled="item.disabled"
            />

        </el-select>

        <template #footer>

            <div class="dialog-footer">
                <el-button @click="centerDialogVisible = false">Cancel</el-button>
                <el-button type="primary" @click.stop="fetchNewData">
                    Confirm
                </el-button>
            </div>

        </template>
    </el-dialog>
</template>

<style scoped>
.my-header{
    display: flex;
    justify-content: space-between;
    padding: 0 16px;
    cursor: pointer;
}
</style>
