import { createRouter, createWebHistory } from 'vue-router'
const BASE_URL = '/'

import ProductShow from './components/ProductShow.vue'

const routes = [
  {
    path: '/',
    name: 'ProductShow',
    component: ProductShow,
  },
]

const router = createRouter({
  history: createWebHistory(BASE_URL),  // set BASE_URL
  routes
})

export default router