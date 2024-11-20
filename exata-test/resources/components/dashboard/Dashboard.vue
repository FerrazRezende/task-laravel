<script setup>
import { onMounted } from 'vue';
import {ref} from 'vue';
import {useAuthStore} from "../../js/stores/authStore.js";

import Sidebar from "../partials/Sidebar.vue";
import Header from "../partials/Header.vue";
import tarefasService from "../../js/services/tarefasService.js";
import CardEstatistica from "./CardEstatistica.vue";
import {ElNotification} from "element-plus";

// ----------------
// - Propriedades -
// ----------------
const authStore = useAuthStore();
const dashData = ref({});


// -----------
// - Funções -
// -----------
const getData = async () => {
    try {
        const response = await tarefasService.getTaskCountsByUserId(authStore.userId);

        dashData.value = response.data;

        console.log(dashData.value);
    } catch(err) {
    }
};

// -----------
// - Eventos -
// -----------
onMounted(async () => {
    await authStore.checkSession();

    await getData();
});
</script>

<template>
    <main>
        <Header />
        <section>
            <Sidebar />

            <article>
                <h1>Dashboard</h1>

                <div class="card-container">
                    <CardEstatistica :count="dashData.pendentes" tipo="pendentes" />
                    <CardEstatistica :count="dashData.emAndamento" tipo="andamento" />
                    <CardEstatistica :count="dashData.concluidas" tipo="finalizadas" />
                </div>
            </article>

        </section>
    </main>
</template>

<style scoped>




.card-container{
    display: flex;
}

</style>
