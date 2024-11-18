<script setup>
import {useAuthStore} from "../js/stores/authStore.js";
import {onMounted} from "vue";

const authStore = useAuthStore()

onMounted(() => {{
    authStore.checkSession()
}});


</script>

<template>
    <main>
        <router-view></router-view>
    </main>
</template>

<style scoped>

</style>
