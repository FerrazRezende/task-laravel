<script setup>
import Header from "../partials/Header.vue";
import Sidebar from "../partials/Sidebar.vue";

import { ref } from 'vue';

const collapsedCards = ref([]);

const toggleCollapse = (index) => {
    if (collapsedCards.value.includes(index)) {
        collapsedCards.value = collapsedCards.value.filter(i => i !== index);
    } else {
        collapsedCards.value.push(index);
    }
};
</script>

<template>
    <main>
        <Header />

        <section>
            <Sidebar />
            <article>
                <h1>Tarefas</h1>
                <div class="task-container">

                    <div class="filter-container">

                    </div>

                    <div
                        v-for="(task, index) in 8"
                        :key="index"
                        :class="{ collapse: collapsedCards.includes(index) }"
                        class="task-card"
                        @click="toggleCollapse(index)"
                    >
                    </div>
                </div>
            </article>
        </section>
    </main>
</template>

<style scoped>


.task-container {
    height: 75%;
    overflow: auto !important;
    margin: 16px 0;
    padding: 0 32px;
    border-radius: 16px;
    outline: 1px solid var(--el-color-primary);
}

.task-card {
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    width: 80%;
    height: 64px;
    border-radius: 8px;
    margin: 24px 0;
    transition: height 0.2s ease;
}

.task-card.collapse {
    height: 255px !important;
}


</style>
