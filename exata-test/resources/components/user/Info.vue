<script setup>
import { computed } from 'vue';

const { nome, data_criacao, is_admin } = defineProps({

    nome: { type: String, required: true },

    data_criacao: { type: String, default: '' },

    is_admin: { type: Boolean, default: false },
});

const formatDate = computed(() => {
    return data_criacao
        ? new Date(data_criacao).toLocaleDateString('pt-BR', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
        })
        : 'Data não informada';
});
</script>

<template>
    <main>
        <el-descriptions
            column="2"
            border
        >
            <el-descriptions-item label="Nome">{{ nome }}</el-descriptions-item>
            <el-descriptions-item label="Data de cadastro">{{ formatDate }}</el-descriptions-item>
            <el-descriptions-item label="Tipo de usuário">
                <el-tag
                    :type="is_admin ? 'primary' : 'success' "
                    effect="dark"
                >{{ is_admin ? "Admin" : "Comum" }}</el-tag>
            </el-descriptions-item>
        </el-descriptions>
    </main>
</template>

<style scoped>

</style>
