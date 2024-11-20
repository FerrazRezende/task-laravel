<script setup>
// ----------------
// - Propriedades -
// ----------------
const {type, status, background } = defineProps({
    type: {
        type: String,
        required: true
    },
    status: {
        type: String,
        required: true
    },
    background: {
        type: String,
        required: true
    }
});
</script>

<template>
    <main>
        <h3>Status:</h3>

        <el-tag
            :type="type"
            effect="dark"
            :class="background"
        >
            {{ status }}
        </el-tag>

    </main>
</template>

<style scoped>
main {
    display: flex;
    align-items: center;
    height: 100%;
}

.andamento {
    background-color: rgba(0, 0, 139, 0.5)!important;
}

.pendente {
    background-color: rgba(255, 69, 0, 0.5)!important;
}

.finalizada {
    background-color: rgba(0, 100, 0, 0.5)!important;
}

main > .el-tag {
    margin: 0 16px ;
}
</style>
