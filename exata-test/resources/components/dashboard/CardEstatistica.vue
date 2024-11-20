<script setup>
defineProps({
    tipo: {
        type: String,
        required: true
    },
    count: {
        type: Number,
        required: true,
    },
});

</script>

<template>
    <main>
        <div :class="`card ${tipo}`">

            <p>Tarefas {{ tipo }}</p>
            <span>{{ count }}</span>

        </div>
    </main>
</template>

<style scoped>

span {
    font-size: 3rem;
}


.card {
    color: white;
    margin: 16px 8px;
    padding: 32px;
    width: 199px;
    height: 120px;
    background-color: var(--el-color-success);
    border-radius: 8px;

}


.finalizadas {
    color: greenyellow!important;
}

.andamento {
    color: darkorange!important;
}


</style>
