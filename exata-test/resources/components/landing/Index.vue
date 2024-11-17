<script setup>
import HeaderLanding from "./HeaderLanding.vue";
import ModalRegistro from "../login/ModalRegistro.vue";

import {ref} from 'vue';

const modalOpen = ref(false)

const openModal = () => {
    modalOpen.value = !modalOpen.value
}

</script>

<template>
    <main>
        <HeaderLanding @openModal="openModal" />

        <ModalRegistro v-if="modalOpen"/>

        <section>

        </section>

    </main>
</template>

<style scoped>

</style>
