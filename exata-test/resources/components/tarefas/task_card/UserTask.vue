<script setup>
import {onMounted, ref} from "vue";
import userService from "../../../js/services/userService.js";
import {ElNotification} from "element-plus";

// ----------------
// - Propriedades -
// ----------------
const { userId } = defineProps({
    userId: {
        type: Number,
        required: true
    }
});

const profilePicture = ref("https://static.thenounproject.com/png/354384-200.png");
const userData = ref([]);

// -----------
// - Funções -
// -----------
const fetchUser = async () => {
    try {
        const response = await userService.getUserById(userId);
        userData.value = response.data;
    } catch (err) {
        ElNotification({
            title: "Erro",
            message: "Erro ao recuperar os dados",
            type: "error"
        });
    }
};

// -----------
// - Eventos -
// -----------
onMounted(() => {
    fetchUser();
})
</script>

<template>
    <main>

        <el-avatar :size="40" :src="profilePicture" />
        <p class="fixed-text">{{ userData.nome }}</p>

    </main>
</template>

<style scoped>

main {
    display: flex;
    align-items: center;
}

main > p {
    margin: 0 4px;
}

.fixed-text {
    width: 120px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
