<script setup>
defineProps({
    pendente: {
        type: Number,
        required: true
    },
    emAndamento: {
        type: Number,
        required: true
    },
    concluidas: {
        type: Number,
        required: true
    }
});
</script>

<template>
    <main>

        <el-statistic :value="pendente">
            <template #title>
                <div style="display: inline-flex; align-items: center">
                    Tarefas em aberto
                </div>
            </template>
        </el-statistic>

        <el-statistic :value="emAndamento">
            <template #title>
                <div style="display: inline-flex; align-items: center">
                    Tarefas em andamento
                </div>
            </template>
        </el-statistic>

        <el-statistic :value="concluidas">
            <template #title>
                <div style="display: inline-flex; align-items: center">
                    Tarefas completadas
                </div>
            </template>
        </el-statistic>

    </main>
</template>

<style scoped>
main {
    display: flex;
    justify-content: space-around;
}

</style>
