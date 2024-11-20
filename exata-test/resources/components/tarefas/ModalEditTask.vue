<script setup>
import { defineEmits, onMounted, ref } from 'vue';
import tarefasService from "../../js/services/tarefasService.js";
import { ElNotification } from "element-plus";


// ----------------
// - Propriedades -
// ----------------
const { id } = defineProps({
    id: {
        type: Number,
        required: true
    }
});

const emit = defineEmits();
const isDialogOpen = ref(true);
const formRef = ref(null);

const form = ref({
    titulo: null,
    descricao: null
});

const rules = {
    titulo: [
        { required: true, message: 'O título é obrigatório', trigger: 'blur' }
    ],
    descricao: [
        { required: true, message: 'A descrição é obrigatória', trigger: 'blur' }
    ]
};
// -----------
// - Funções -
// -----------
const handleClose = () => {
    emit('close-modal');
    isDialogOpen.value = false;
}

// Função para recuperar os dados que são exibidos no input
const fetchTaskData = async () => {
    try {
        const response = await tarefasService.getTaskById(id);
        form.value.titulo = response.data.titulo;
        form.value.descricao = response.data.descricao;
    } catch (err) {
        ElNotification({
            title: "Erro",
            message: "Falha ao carregar dados da tarefa",
            type: "error"
        });
    }
};

const fetchNewData = async () => {
    await formRef.value.validate(async (valid) => {
        if (valid) {

            const payload = {
                titulo: form.value.titulo,
                descricao: form.value.descricao
            };

            try {
                const response = await tarefasService.editTask(payload, id);

                if (response) {
                    handleClose();

                    ElNotification({
                        title: "Sucesso",
                        message: "Tarefa editada com sucesso",
                        type: "success"
                    });
                }
            } catch (err) {
                ElNotification({
                    title: "Erro",
                    message: "Falha ao editar tarefa",
                    type: "error"
                });
            }
        } else {
            ElNotification({
                title: "Erro",
                message: "Por favor, preencha todos os campos obrigatórios.",
                type: "warning"
            });
        }
    });
}

// -----------
// - Eventos -
// -----------
onMounted(() => {
    fetchTaskData();
})
</script>

<template>
    <main>
        <el-dialog @click.stop :close-on-click-modal="false" v-model="isDialogOpen" :show-close="false" title="Editar tarefa" width="500">
            <template #header>
                <div class="my-header">
                    <h1>Editar tarefa {{ form.titulo }}</h1>
                    <a @click="handleClose">
                        <v-icon name="io-close-circle-outline" />
                    </a>
                </div>
            </template>

            <el-form :model="form" :rules="rules" ref="formRef" label-position="left" label-width="150px">
                <el-form-item label="Título" prop="titulo">
                    <el-input v-model="form.titulo" />
                </el-form-item>
                <el-form-item label="Descrição" prop="descricao">
                    <el-input v-model="form.descricao" type="textarea" :rows="5" />
                </el-form-item>
            </el-form>

            <template #footer>
                <div class="dialog-footer">
                    <el-button type="primary" @click="fetchNewData">Editar tarefa</el-button>
                    <el-button @click="handleClose">Cancelar</el-button>
                </div>
            </template>
        </el-dialog>
    </main>
</template>

<style scoped>
.my-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 16px;
    cursor: pointer;
}
</style>
