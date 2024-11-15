import './bootstrap';

import App from '../components/App.vue'
import { createApp } from 'vue';

const app = createApp();

app.component('app', App)

app.mount('#app')
