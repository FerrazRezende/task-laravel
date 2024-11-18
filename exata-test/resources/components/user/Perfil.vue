<script setup>

import Header from "../partials/Header.vue";
import Sidebar from "../partials/Sidebar.vue";
import {onMounted, ref} from "vue";
import Info from "./Info.vue";
import Estatisticas from "./Estatisticas.vue";
import userService from "../../js/services/userService.js";
import {useAuthStore} from "../../js/stores/authStore.js";


const profilePicture = ref("https://static.thenounproject.com/png/354384-200.png");

const authStore = useAuthStore()

const userData = ref({})

const fetchUser = async () => {
    const response = await userService.getUserById(authStore.userId)

    if (response.data) {
        userData.value = response.data
        console.log(userData.value)
    }

}
onMounted(() => {{
    authStore.checkSession()
    setTimeout(() => {
        fetchUser()
    },1000)

}});

</script>

<template>
    <main>
        <Header />
        <section>
            <Sidebar />
            <article>
                <h1>Perfil de {{ userData.nome }}</h1>
                <div class="perfil-container">
                    <div class="avatar-container">
                        <el-avatar :size="100" :src="profilePicture" />
                    </div>
                    <div class="info-container">
                        <Info :nome="userData.nome" :data_criacao="userData.data_criacao" :is_admin="userData.admin" />
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


article {
    display: flex;
    flex-direction: column;
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
