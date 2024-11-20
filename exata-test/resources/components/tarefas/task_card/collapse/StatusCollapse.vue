<script setup>
defineProps({
    status: {
        type: Number,
        required: true
    }
});
</script>

<template>
    <main>
        <h1>Status</h1>

        <el-steps class="steps" style="width: 350px" :active="status" align-center>

            <el-step title="Pendente" />
            <el-step title="Em andamento" />
            <el-step title="Concluida" />

        </el-steps>
    </main>
</template>

<style scoped>

h1 {
    margin: 16px 0;
}

.steps {
    --el-color-primary: var(--color-secondary)!important;
    --el-bg-color: #fff!important;
}

</style>
