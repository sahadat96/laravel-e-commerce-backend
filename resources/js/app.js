import './bootstrap';
import './assets/allcss..js'
import './assets/alljs.js'

import { createApp, markRaw } from 'vue';
import App from './App.vue';
import router from './route/route.js';
import { createPinia } from 'pinia';


const app = createApp(App);
const pinia = createPinia();

pinia.use(({ store }) => {
     store.router = markRaw(router);
});


app.use(router);
app.use(pinia);
app.mount("#app");





