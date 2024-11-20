<script setup>
// ----------------
// - Propriedades -
// ----------------
const { nome, data_criacao, is_admin } = defineProps({
    nome: {
        type: String,
        required: true
    },

    data_criacao: {
        type: String,
        default: ''
    },

    is_admin: {
        type: Boolean,
        default: false
    },
});

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
</script>

<template>
    <main>
        <el-descriptions
            column="2"
            border
        >

            <el-descriptions-item label="Nome">{{ nome }}</el-descriptions-item>
            <el-descriptions-item label="Data de cadastro">{{ formatDate(data_criacao) }}</el-descriptions-item>

            <el-descriptions-item label="Tipo de usuário">
                <el-tag
                    :type="is_admin ? 'primary' : 'success' "
                    effect="dark"
                >
                    {{ is_admin ? "Admin" : "Comum" }}
                </el-tag>
            </el-descriptions-item>

        </el-descriptions>
    </main>
</template>

<style scoped>

</style>
