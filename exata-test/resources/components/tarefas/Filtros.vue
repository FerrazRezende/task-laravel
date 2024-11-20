<script setup>
import {ref, onMounted} from 'vue';
import {useAuthStore} from "../../js/stores/authStore.js";
import userService from "../../js/services/userService.js";
import {ElNotification} from "element-plus";

// ----------------
// - Propriedades -
// ----------------
const authStore = useAuthStore();
const statusFilter = ref(null);
const orderField = ref("data_criacao");
const orderDirection = ref('asc');
const users = ref([]);
const selectedUserId = ref("");
const emit = defineEmits();

// -----------
// - Funções -
// -----------
const loadUsers = async () => {
    try {
        const response = await userService.getAllUsers();
        users.value = response.data;
    } catch (error) {
        ElNotification({
            title: "Erro",
            message: "Erro ao recuperar os dados",
            type: "error"
        });
    }
};
const emitFilters = () => {
    const filters = {
        status: statusFilter.value,
        orderField: orderField.value,
        orderDirection: orderDirection.value,
        selectedUserId: selectedUserId.value,
    };
    emit('update-filters', filters);
};

// -----------
// - Eventos -
// -----------
onMounted(() => {
    loadUsers();
});

</script>

<template>
    <main>
        <div class="filter-user" v-if="authStore.isAdmin">
            <p>Usuários</p>

            <el-select
                v-model="selectedUserId"
                placeholder="Escolha o usuário"
                size="small"
                style="width: 150px"
                @change="emitFilters"
            >
                <el-option :value="null" label="Mostrar todos" />
                <el-option
                    v-for="user in users"
                    :key="user.id"
                    :label="user.nome"
                    :value="user.id"
                />
            </el-select>
        </div>

        <div class="filter-status">
            <p>Status</p>

            <el-select
                v-model="statusFilter"
                placeholder="Selecione o status"
                size="small"
                style="width: 150px"
                @change="emitFilters"
            >
                <el-option-group label="Status">
                    <el-option
                        label="Mostrar Todos"
                        :value="null"
                    />
                    <el-option
                        label="Pendente"
                        value="Pendente"
                    />
                    <el-option
                        label="Em Andamento"
                        value="Em andamento"
                    />
                    <el-option
                        label="Concluido"
                        value="Concluido"
                    />
                </el-option-group>

            </el-select>
        </div>

        <div class="filter-ordenacao">
            <p>Ordenar</p>

            <div class="ordenar-container">

                <el-select style="width: 150px" v-model="orderField" placeholder="Campo" size="small" @change="emitFilters">
                    <el-option label="Data de criação" value="data_criacao" />
                    <el-option label="Data de edição" value="data_modificacao" />
                </el-select>

                <div
                    class="asc-btn"
                    :class="{ active: orderDirection === 'desc' }"
                    @click="orderDirection = 'desc'; emitFilters()"
                >
                    <v-icon name="co-sort-ascending" scale="0.8" />
                </div>

                <div
                    class="asc-btn"
                    :class="{ active: orderDirection === 'asc' }"
                    @click="orderDirection = 'asc'; emitFilters()"
                >
                    <v-icon name="co-sort-descending" scale="0.8" />
                </div>

            </div>
        </div>
    </main>
</template>

<style scoped>
main {
    display: flex;
    align-items: center;
}

.filter-status {
    margin-right: 32px;
}

.filter-user {
    margin-right: 16px;
}

.ordenar-container {
    display: flex;

}


.asc-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 2px;
    outline: 1px solid #a0aec0;
    cursor: pointer;
}

.asc-btn.active {
    background-color: #1d72b8;
    color: white;
}

.ordenar-container > div {
    margin: 0 6px;
}
</style>
