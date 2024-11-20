<script setup>
import {onMounted, ref, defineEmits} from 'vue';
import {useAuthStore} from "../../js/stores/authStore.js";
import {ElNotification} from "element-plus";
import userService from "../../js/services/userService.js";


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
const userData = ref({})
const isDialogOpen = ref(true);
const authStore = useAuthStore();

// -----------
// - Funções -
// -----------
const fetchUser = async () => {
    const response = await userService.getUserById(id);

    if (response.data) {
        userData.value = response.data;
    }
};

const fetchEdit = async () => {
    try {
        const response = await userService.editUser(id, userData.value);

        if(response) {
            ElNotification({
                title: 'ok',
                message: 'Usuário editado com sucesso',
                type: 'success',
            });

            emit('close-modal');

            setTimeout(() => {
                location.reload();
            }, 1000);
        }
    } catch (err) {
        ElNotification({
            title: "Erro",
            message: "Erro ao atualizar o usuário",
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
onMounted(() => {{
    fetchUser();
}});
</script>


<template>
    <main>
        <el-dialog v-model="isDialogOpen" :show-close="false" title="Editar informações" width="500">

            <template #header>
                <div class="my-header">
                    <a @click="handleClose">
                        <v-icon name="io-close-circle-outline" />
                    </a>
                </div>
            </template>

            <el-form :model="userData" label-position="left" label-width="150px">

                <el-form-item label="Nome">
                    <el-input v-model="userData.nome"/>
                </el-form-item>

                <el-form-item label="Nome de usuário">
                    <el-input v-model="userData.nome_usuario"/>
                </el-form-item>

                <el-form-item label="Admin?" v-if="authStore.isAdmin">
                    <el-switch v-model="userData.admin"/>
                </el-form-item>

            </el-form>

            <template #footer>
                <div class="dialog-footer">
                    <el-button type="primary" @click="fetchEdit">
                        Editar
                    </el-button>
                </div>
            </template>

        </el-dialog>
    </main>
</template>

<style scoped>
.my-header{
    display: flex;
    justify-content: flex-end;
    padding: 0 16px;
}

a {
    cursor: pointer;
}
</style>
