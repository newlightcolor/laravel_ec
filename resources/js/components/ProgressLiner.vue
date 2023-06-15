<template>
    <v-progress-linear
        indeterminate
        color="blue-darken-1"
        v-show="display"
    ></v-progress-linear>
</template>

<script setup>
import { ref, defineExpose } from "vue"

const display = ref(false)

function show() {
    display.value = true
}
function hide() {
    display.value = false
}

defineExpose({
    show,
    hide
})

</script>