<script setup>
import { defineEmits, ref } from 'vue';
import tarefasService from "../../js/services/tarefasService.js";
import { useAuthStore } from "../../js/stores/authStore.js";
import { ElNotification } from "element-plus";

// ----------------
// - Propriedades -
// ----------------
const emit = defineEmits();
const isDialogOpen = ref(true);
const authStore = useAuthStore();
const formRef = ref(null);
const value = ref('');

const form = ref({
    titulo: '',
    descricao: '',
    status: ''
});

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

const rules = {
    titulo: [
        { required: true, message: 'O título é obrigatório', trigger: 'blur' }
    ],
    descricao: [
        { required: true, message: 'A descrição é obrigatória', trigger: 'blur' }
    ],
};

// -----------
// - Funções -
// -----------
const handleClose = () => {
    emit('close-modal');
}
const fetchTask = async () => {
    await formRef.value.validate(async (valid) => {
        if (valid) {

            const payload = {
                titulo: form.value.titulo,
                descricao: form.value.descricao,
                status: value.value,
                user_id: authStore.userId
            };

            try {
                const response = await tarefasService.createTask(payload);

                if (response.status) {
                    handleClose();

                    ElNotification({
                        title: "Ok",
                        message: "Tarefa criada com sucesso",
                        type: "success"
                    });

                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }

            } catch (err) {
                ElNotification({
                    title: "Erro",
                    message: "Falha ao criar tarefa",
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
};
</script>

<template>
    <main>
        <el-dialog
            :close-on-click-modal="false"
            v-model="isDialogOpen"
            :show-close="false"
            title="Nova tarefa"
            width="500"
        >

            <template #header>
                <div class="my-header">
                    <h1>Criar nova tarefa</h1>
                    <a @click="handleClose">
                        <v-icon name="io-close-circle-outline"/>
                    </a>
                </div>
            </template>

            <el-form :model="form" :rules="rules" ref="formRef" label-position="left" label-width="150px">

                <el-form-item label="Titulo" prop="titulo">
                    <el-input v-model="form.titulo"/>
                </el-form-item>

                <el-form-item label="Descrição" prop="descricao">
                    <el-input
                        v-model="form.descricao"
                        type="textarea"
                        :rows="5"
                    />
                </el-form-item>

                <el-form-item label="Status" prop="status">
                    <el-select v-model="value" placeholder="Selecione" style="width: 240px">
                        <el-option
                            v-for="item in options"
                            :key="item.value"
                            :label="item.label"
                            :value="item.value"
                        />
                    </el-select>
                </el-form-item>

            </el-form>

            <template #footer>
                <div class="dialog-footer">
                    <el-button type="primary" @click="fetchTask">
                        Cadastrar tarefa
                    </el-button>
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
    color: black;
}
</style>
