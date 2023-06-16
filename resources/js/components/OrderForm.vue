<template>
<v-sheet class="py-5 px-2">

    <ErrorAlert ref="errorAlert" />
    <ProgressLiner ref="progressLiner" />

    <v-form ref="form" :disabled="orderForm.disabled">
        <v-sheet v-for="setting in orderForm.settings">
            <v-select
                v-if="setting.type === 'select'"
                :label="setting.label"
                v-model="orderForm.order[setting.name]"
                item-title="display"
                item-value="value"
                :items="orderForm.options[setting.name]"
                :rules="setting.rules"
                @update:modelValue="changed(setting.name)"
                variant="underlined"
                color="blue-darken-1"
            ></v-select>
            <v-text-field 
                v-if="setting.type === 'text'"
                :label="setting.label"
                v-model="orderForm.order[setting.name]"
                :rules="setting.rules"
                @change="changed(setting.name)"
                variant="underlined"
                color="blue-darken-1"
            ></v-text-field>
        </v-sheet>

        <v-btn
            :disabled="orderForm.disabled"
            @click="buy"
            class="mt-10"
            width="150"
            color="blue-darken-1"
        >
            購入
        </v-btn>
    </v-form>

    <Snackbar ref="snackbar"/>

</v-sheet>
</template>

<script setup>
import axios from 'axios'
import { ref, reactive, defineProps, computed, onMounted } from "vue"
import ProgressLiner from './ProgressLiner.vue'
import ErrorAlert from './ErrorAlert.vue'
import Snackbar from './Snackbar.vue'

const progressLiner = ref()
const errorAlert = ref()
const snackbar = ref()
const form = ref()

const props = defineProps({
    productId: null,
})

const formData = computed(() => {
    let formData = new Object();
        formData = Object.assign(formData, orderForm.order)
        formData = Object.assign(formData, { product_id: props.productId })
    return formData
})

const orderForm = reactive({
    disabled: true,
    order: {
        delivery_date: '',
        postcode: '',
        prefecture: '',
        municipality: '',
        address: '',
        building: ''
    },
    options: {
        delivery_date: []
    },
    settings: [
        {
            name: 'delivery_date',
            label: '配送日',
            type: 'select',
            isWatch: false,
            rules: [
                v => !!v || '配送日は必須です'
            ],
        },
        {
            name: 'postcode',
            label: '郵便番号',
            type: 'text',
            isWatch: false,
            rules: [
                v => !!v || '郵便番号は必須です',
                v => v.length === 7 || '郵便番号は7桁で入力してください'
            ],
        },
        {
            name: 'prefecture',
            label: '都道府県',
            type: 'text',
            isWatch: true,
            rules: [
                v => !!v || '都道府県は必須です'
            ],
        },
        {
            name: 'municipality',
            label: '市区町村',
            type: 'text',
            isWatch: false,
            rules: [
                v => !!v || '市区町村は必須です'
            ],
        },
        {
            name: 'address',
            label: '番地',
            type: 'text',
            isWatch: false,
            rules: [
                v => !!v || '番地は必須です'
            ],
        },
        {
            name: 'building',
            label: '建物名・部屋番号',
            type: 'text',
            isWatch: false,
        },
    ],
})

/**
 * ライフサイクルフック
 */
onMounted(async () => {
    showLoading()
    disableForm()
    const response = await axios.get('/api/order_form')
    orderForm.options = response.data.options
    hideLoading()
    enableForm()
})

/**
 * フォームの値が変更された場合に呼び出される
 */
function changed(name) {
    // 監視対象の場合は、サーバーに問い合わせる
    const setting = orderForm.settings.find(setting => setting.name === name)
    if(setting.isWatch) {

        showLoading()
        disableForm()

        axios.get('/api/order_form', {
            params: orderForm.order
        })
        .then(response => {
            orderForm.options = response.data.options
            unsetSelectNotInOptions(name)
            hideLoading()
            enableForm()
        })
    }
}

/**
 * selectタグの選択肢にない値を選択していた場合、選択を解除する
 */
function unsetSelectNotInOptions() {
    for(const setting of orderForm.settings) {
        if(setting.type === 'select') {
            const options       = orderForm.options[setting.name]
            const selectedValue = orderForm.order[setting.name]
            if(!options.find(option => option.value === selectedValue)) {
                orderForm.order[setting.name] = ''
            }
        }
    }
}

/**
 * 購入ボタンが押された場合に呼び出される
 */
function buy(){

    hideError()

    form.value.validate().then(result => {
        if(result.valid)
        {
            showLoading()
            axios.post('/api/order', formData.value)
            .then(response => {
                snackbar.value.setText(response.data.message)
                snackbar.value.show()
                form.value.reset()
            })
            .catch(error => {
                showError(error.response.data)
            })
            .finally(() => {
                hideLoading()
            })
        }
    })
}

/**
 * フォームの有効/無効
 */
function enableForm(){
    orderForm.disabled = false
}
function disableForm(){
    orderForm.disabled = true
}

/**
 * エラー 表示/非表示
 */
function showError(errorMessages = []){
    errorAlert.value.setErrorMessage(errorMessages)
    errorAlert.value.show()
}
function hideError(){
    errorAlert.value.hide()
}

/**
 * ローディング 表示/非表示
 */
function showLoading(){
    progressLiner.value.show()
}
function hideLoading(){
    progressLiner.value.hide()
}

</script>