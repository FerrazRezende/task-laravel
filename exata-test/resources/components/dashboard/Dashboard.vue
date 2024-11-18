<script setup>
import { onMounted } from 'vue';

import Sidebar from "../partials/Sidebar.vue";
import Header from "../partials/Header.vue";
import {useAuthStore} from "../../js/stores/authStore.js";




</script>

<template>
    <main>
        <Header />
        <section>
            <Sidebar />
            <article>
                <h1>Dashboard</h1>
                <div class="card-container">
                    <div class="card">
                        <p>Tarefas em aberto</p>
                        <span>60</span>
                    </div>
                    <div class="card andamento">
                        <p>Tarefas em andamento</p>
                        <span>60</span>
                    </div>
                    <div class="card finalizadas">
                        <p>Tarefas finalizadas</p>
                        <span>60</span>
                    </div>
                </div>

            </article>

        </section>
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

.card-container{
    display: flex;
}

.finalizadas {
    color: greenyellow!important;
}

.andamento {
    color: darkorange!important;
}

</style>
