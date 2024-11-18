import './bootstrap';

import { createPinia } from 'pinia';
import router from '../js/routes/router.js';

import ElementPlus from 'element-plus';

import '../css/reset.css';
import 'element-plus/dist/index.css';
import '../css/global.css';

import { OhVueIcon, addIcons } from "oh-vue-icons";
import {
    MdLogout,
    CoHome,
    FaTasks,
    BiInfoCircle,
    HiUserGroup,
    FaEdit,
    MdDeleteforever

} from "oh-vue-icons/icons";

import App from '../components/App.vue'

import { createApp } from 'vue';
// -------------------------- /\ IMPORTS /\ -------------------------- //


// ---------------- //
// - Oh Vue Icons - //
// ---------------- //
addIcons(
    MdLogout,
    CoHome,
    FaTasks,
    BiInfoCircle,
    HiUserGroup,
    FaEdit,
    MdDeleteforever
);

// --------- //
// - Pinia - //
// --------- //
const pinia = createPinia();

const app = createApp();

app.component('app', App)
app.component("v-icon", OhVueIcon);

app.use(router)
app.use(ElementPlus);
app.use(pinia);

app.mount('#app');
