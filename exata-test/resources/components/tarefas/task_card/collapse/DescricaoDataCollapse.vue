<script setup>
defineProps({
    descricao: {
        type: String,
        required: true
    },
    dataCriacao: {
        type: String,
        required: false
    },
    dataModificacao: {
        type: String,
        required: false
    }
});
</script>

<template>
    <main>
        <div>
            <h2>Descrição</h2>
            <p>{{ descricao }}</p>
        </div>

        <div class="data-container">

            <div v-if="dataCriacao">
                <h3 class="data-collapse">Data de criação</h3>
                <p class="data-collapse">{{ dataCriacao }}</p>
            </div>

            <div v-if="dataModificacao">
                <h3 class="data-collapse">Data de modificação</h3>
                <p class="data-collapse">{{ dataModificacao }}</p>
            </div>

        </div>

    </main>
</template>

<style scoped>
main {
    text-align: left;

}

h2 {
    padding: 12px 0;
}

h3 {
    margin-top: 16px;
}

.data-collapse {
    font-size: 0.8rem;
}

.data-container {
    display: flex;
}

.data-container > div {
    margin: 0 16px
}


</style>
