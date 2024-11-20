<script setup>
defineProps({
    descricao: {
        type: String,
        required: true
    },
    data: {
        type: String,
        required: true
    },
});
</script>

<template>
    <main>

        <div>
            <h2>Descrição</h2>
            <p class="fixed-text">{{ descricao }}</p>
        </div>

        <div>
            <h2>Data de criação</h2>
            <p>{{ data }}</p>
        </div>

    </main>
</template>

<style scoped>
main {
    display: flex;
}

div {
    margin: 0 8px
}

h2 {
    padding: 16px 0;
}

.fixed-text {
    width: 190px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}


</style>
