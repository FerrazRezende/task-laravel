<script setup>
defineProps({
    titulo: {
        type: String,
        required: true
    }
});
</script>

<template>
    <main>

        <h2>Titulo</h2>
        <p class="fixed-text">{{ titulo }}</p>

    </main>
</template>

<style scoped>
h2 {
    padding: 16px 0;
}

.fixed-text {
    width: 150px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
