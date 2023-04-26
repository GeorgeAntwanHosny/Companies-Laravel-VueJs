import './bootstrap';
import '../css/app.css'
import {createApp} from 'vue'

import App from './App.vue'
import router from "./router";
import VueClickAway from "vue3-click-away";
import userStore from './store/userStore'

createApp(App).use(userStore).use(router).use(VueClickAway).mount("#app");

