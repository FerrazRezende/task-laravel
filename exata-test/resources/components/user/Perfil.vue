<script setup>

import Header from "../partials/Header.vue";
import Sidebar from "../partials/Sidebar.vue";
import {ref} from "vue";
import Info from "./Info.vue";
import Estatisticas from "./Estatisticas.vue";

const profilePicture = ref("https://static.thenounproject.com/png/354384-200.png");
</script>

<template>
    <main>
        <Header />
        <section>
            <Sidebar />
            <article>
                <h1>Perfil de Matheus</h1>
                <div class="perfil-container">
                    <div class="avatar-container">
                        <el-avatar :size="100" :src="profilePicture" />
                    </div>
                    <div class="info-container">
                        <Info />
                        <div class="divider-container">
                            <el-divider />
                        </div>
                        <Estatisticas />
                    </div>
                </div>
            </article>
        </section>
    </main>
</template>

<style scoped>
section {
    display: flex;
    width: 100vw;
    height: 100vh;
    color: var(--el-color-white);
}

article {
    display: flex;
    flex-direction: column;
    color: black;
    padding: 16px;
    width: 100vw;
}

h1 {
    font-size: 1.5rem;
}

.perfil-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

}

.avatar-container{
    margin: 64px 0;
}

.divider-container {
    margin: 32px 0;
}

</style>
