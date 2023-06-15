<template>
<v-sheet class="d-md-flex flex-wrap my-5 content-wrapper">
    <v-row>
        
        <ProgressLiner ref="progressLiner" />

        <v-col cols="12" sm="5">
            <v-img src="image/product.png" width="100%"></v-img>
        </v-col>
        <v-col cols="12" sm="7">
            <v-card><h1>{{ state.product.product_name }}</h1></v-card>
            <v-sheet class="mx-3 my-5">商品の説明</v-sheet>

            <OrderForm :productId="state.product.id" />

        </v-col>
    </v-row>
</v-sheet>
</template>

<script setup>
import axios from 'axios'
import { ref, reactive, onMounted } from "vue"
import OrderForm from './OrderForm.vue'
import ProgressLiner from './ProgressLiner.vue'

const progressLiner = ref()
const state = reactive({
    product: {
        product_name: '...'
    }
})

/**
 * ライフサイクルフック
 */
onMounted(async () => {
    showLoading()
    const response = await axios.get('/api/product')
    state.product = response.data
    hideLoading()
})

/**
 * ローディング
 */
function showLoading(){
    progressLiner.value.show()
}
function hideLoading(){
    progressLiner.value.hide()
}

</script>

<style scoped>
.content-wrapper {
    max-width: 1200px;
    margin: 0 auto;
}
</style>