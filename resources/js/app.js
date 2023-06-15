import './bootstrap';
import router from './router'
import { createApp } from 'vue/dist/vue.esm-bundler';
import 'vuetify/lib/styles/main.sass';
import { createVuetify } from 'vuetify';
import App from './components/App.vue';
import '@mdi/font/css/materialdesignicons.css'

const vuetify = createVuetify({});

const app = createApp(App);
app.use(router);
app.use(vuetify);
app.mount('#app');