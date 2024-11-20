<script setup>
import {ref} from 'vue';

import HeaderLanding from "./HeaderLanding.vue";
import ModalRegistro from "../login/ModalRegistro.vue";


// ----------------
// - Propriedades -
// ----------------
const modalOpen = ref(false);
const minhaFoto = 'https://pbs.twimg.com/profile_images/1578733200578383872/WXBtJVW-_400x400.jpg'

// -----------
// - Funções -
// -----------
const openModal = () => {
    modalOpen.value = true;
};
const closeModal = () => {
    modalOpen.value = false;
};

</script>

<template>
    <main>
        <HeaderLanding @openModal="openModal" />

        <ul v-if="modalOpen">
            <ModalRegistro @close-modal="closeModal"/>
        </ul>

        <section>
            <el-avatar :size="200" :src="minhaFoto" />
            <div>
                <p class="title">Olá
                </p>

                <main class="apresentacao">
                    <p>Eu me chamo <span>Matheus</span></p>
                    <p style="font-weight: bold">Santo André/SP</p>
                    <p style="font-weight: bold">Desenvolvedor fullstack em formação</p>
                </main>

                <br>
                <hr>

                <br>
                <p>Sou estudante de Ciências da Computação e tive a oportunidade de estagiar no Banco do Brasil, onde acompanhei fluxos de trabalho e realizei a correção de bugs em sistemas departamentais, utilizando tecnologias como Java com Spring MVC e NodeJs com EJS.</p>
                <br>
                <p>Trabalhei em equipes ágeis, contribuindo para ritos do Scrum e gerenciando tarefas com Kanban. Possuo experiência em desenvolvimento web, incluindo projetos pessoais com Django, FastAPI, PHP (Symfony e Laravel com Sail), Vue.js e jQuery. Também tenho experiência prática com Docker e Git em contextos profissionais.</p>

                <br>

                <ol>
                    <a href="https://www.linkedin.com/in/matheus-ferraz-rezende-2572372b2/" target="_blank">
                        <v-icon scale="2" name="bi-linkedin" />
                    </a>
                    <a href="http://github.com/ferrazrezende" target="_blank">
                        <v-icon scale="2" name="bi-github" />
                    </a>
                    <a href="http://wa.me/5511978631492" target="_blank">
                        <v-icon scale="2" name="bi-whatsapp" />
                    </a>
                </ol>

            </div>

        </section>

    </main>
</template>

<style scoped>

section {
    padding: 32px 0;
    color: black;
    width: 100vw;
    height: 100vh;
    display: flex;
    align-items: center;
    flex-direction: column;
}

.title {
    font-size: 2rem;
}

span {
    font-size: 1.5rem;
}

div{
    width: 60%;
    margin-top: -16px;
    padding: 32px;
    border-radius: 16px;
    box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;}

.apresentacao {
    width: 100%;
    display: flex;
    justify-content: space-between;
    margin-bottom: -24px;
}

p {
    line-height: 24px;
}

ol {
    margin: 8px 0;
}

a {
    color: black;
    margin: 0 8px
}

a:hover {
    color: cornflowerblue;
    cursor: pointer;
}



</style>
