<script setup>

</script>

<template>
    <main>
        <el-statistic :value="5">
            <template #title>
                <div style="display: inline-flex; align-items: center">
                    Tarefas em aberto
                </div>
            </template>
        </el-statistic>
        <el-statistic :value="5">
            <template #title>
                <div style="display: inline-flex; align-items: center">
                    Tarefas em andamento
                </div>
            </template>
        </el-statistic>
        <el-statistic :value="5">
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
