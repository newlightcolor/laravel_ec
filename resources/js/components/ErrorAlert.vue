<template>
    <v-alert
        type="error"
        color="red-darken-1"
        class="mb-5"
        v-show="display"
        @click="display = false"
    >
        <div v-for="errorMessage in errorMessages">{{ errorMessage }}</div>
    </v-alert>
</template>

<script setup>
import { ref, defineExpose } from "vue"

const display = ref(false)
const errorMessages = ref([])

function show() {
    display.value = true
}
function hide() {
    display.value = false
}
function setErrorMessage(useErrorMessages = []) {
    errorMessages.value = useErrorMessages
}

defineExpose({
    show,
    hide,
    setErrorMessage
})
</script>