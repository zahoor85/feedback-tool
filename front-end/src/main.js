import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import axios from 'axios'
import store from './store'
import router from './router'


axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://feedback-tool.local:8085';

createApp(App).use(store).use(router).mount('#app')
