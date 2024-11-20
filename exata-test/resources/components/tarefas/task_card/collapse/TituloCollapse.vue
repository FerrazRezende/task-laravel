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

        <p>{{ titulo }}</p>

    </main>
</template>

<style scoped>
main {
    text-align: left;
}

h2 {
    padding: 8px 0;
}
</style>
