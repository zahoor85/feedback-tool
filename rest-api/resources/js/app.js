import './bootstrap';
import { createApp } from 'vue';
import '../css/app.css';
import App from './App.vue';
import axios from 'axios';
import store from './store';
import router from './router';

import Toast from 'vue-toastification';

import 'vue-toastification/dist/index.css';

axios.defaults.withCredentials = true;
// axios.defaults.baseURL = 'http://feedback-tool.local:8085';

createApp(App).use(store).use(router).use(Toast).mount('#app')
