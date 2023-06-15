<template>
	<div class="text-center">
		<v-snackbar
			v-model="display"
			:timeout="timeout"
			:color="color"
		>
			{{ text }}

			<v-btn
				variant="text"
				@click="display = false"
			>
				閉じる
			</v-btn>
		</v-snackbar>
	</div>
</template>

<script setup>
import { ref } from 'vue'

const display = ref(false)
const text = ref('')
const timeout = ref(5000)
const color = ref('blue-darken-1')

function setText(useText) {
	text.value = useText
}
function setTime(useTime) {
	timeout.value = useTime
}
function setColor(useColor) {
	color.value = useColor
}
function show() {
	display.value = true
}

defineExpose({
	setText,
	setTime,
	setColor,
	show
})

</script>