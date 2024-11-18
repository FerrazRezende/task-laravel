<script setup>
import Header from "../partials/Header.vue";
import Sidebar from "../partials/Sidebar.vue";
import { ref, onMounted } from 'vue';

import userService from "../../js/services/userService.js";
import {ElNotification} from "element-plus";

const tableData = ref([{}]);



const deleteUser = async (user_id) => {
    const response = await userService.deleteUser(user_id)

    if (!response.data) {
        ElNotification({
            title: 'Erro',
            message: `${response.data.message}`,
            type: 'error'
        })

        return;
    }

    tableData.value = tableData.value.filter(user => user.id !== user_id);

    ElNotification({
        title: 'Ok',
        message: `${response.data.message}`,
        type: 'success'
    })


}

const fetchUsers = async () => {
    const response = await userService.getAllUsers()

    if (response.data) {

        tableData.value = response.data.map(user => ({
            ...user,
            data_criacao: formatDate(user.data_criacao)
        }));
        console.log(tableData.value);
    }

};

const formatDate = (dateString) => {
    if(!dateString) return '';

    return new Date(dateString).toLocaleDateString('pt-BR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    });
}

onMounted(() => {
    fetchUsers();
});
</script>

<template>
    <main>
        <Header />

        <section>
            <Sidebar />

            <article>
                <h1>Lista de usuários</h1>

                <div class="table-container">
                    <el-table :data="tableData" stripe style="width: 80%">
                        <el-table-column prop="nome" label="Nome" width="180" />
                        <el-table-column prop="nome_usuario" label="Nome de usuário" width="180" />
                        <el-table-column prop="data_criacao" label="Data de criação" width="180" />
                        <el-table-column prop="admin" label="Tipo de usuário" width="180">
                            <template #default="{ row }">
                                <span>
                                    <el-tag
                                        :type="row.admin ? 'primary' : 'success'"
                                        effect="dark"
                                    >
                                      {{ row.admin ? 'Administrador' : 'Comum' }}
                                    </el-tag>
                                </span>
                            </template>
                        </el-table-column>
                        <el-table-column label="Ações" width="180">
                            <template #default="{ row }">
                                <el-tooltip
                                    effect="dark"
                                    content="Editar usuário"
                                    placement="top"
                                >
                                    <a @click="editUser(row.id)"><v-icon name="fa-edit" /></a>
                                </el-tooltip>

                                <el-tooltip
                                    effect="dark"
                                    content="Excluir usuário"
                                    placement="top"
                                >
                                    <a @click="deleteUser(row.id)"><v-icon name="md-deleteforever" /></a>
                                </el-tooltip>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>
            </article>
        </section>
    </main>
</template>

<style scoped>
.table-container {
    margin: 32px 0;
}

a {
    cursor: pointer;
    margin: 0 16px;
    color: var(--el-color-success);
}
</style>
