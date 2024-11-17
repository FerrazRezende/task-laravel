<script setup>
import LoginForm from './LoginForm.vue'

</script>

<template>
    <main>
        <section>
            <div class="top-container">
                <img src="https://www.exata.it/wp-content/uploads/2023/03/exata-icone-cloud-intelligence-min.png">
                <h1>Seja bem vindo!</h1>
                <h2>Entre com suas credenciais:</h2>
            </div>
            <div class="form-container">
                <LoginForm />
            </div>
        </section>
    </main>
</template>

<style scoped>
main {
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden!important;
    width: 100vw;
    height: 100vh;
    background-color: var(--el-color-white);

}

section {
    width: 318px;
    height: 100vh;
    background-color: var(--el-color-success);
}

img {
    margin-top: 32px
}

h1, h2 {
    color: var(--el-color-white);
}

h1 {
    font-size: 2rem;
    padding: 18px 0;
}

h2 {
    font-size: 1.5rem;
}

.top-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 64px;
}

.form-container {
    display: flex;
    align-items: center;
    justify-content: center;
}


</style>

