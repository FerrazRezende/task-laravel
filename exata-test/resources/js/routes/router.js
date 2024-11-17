import { createRouter, createWebHistory } from 'vue-router';
import Index from '../../components/landing/Index.vue'
import Login from '../../components/login/Login.vue';
import Dashboard from '../../components/dashboard/Dashboard.vue';
import Tarefas from "../../components/tarefas/Tarefas.vue";
import Perfil from "../../components/user/Perfil.vue";

const routes = [
    { path: '/', component: Index },
    {
        path: '/login',
        component: Login,
        meta: {
            requiresGuest: true
        }
    },
    {
        path: '/perfil',
        component: Perfil,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/dashboard',
        component: Dashboard,
        meta: {
                requiresAuth: true
        }
    },
    {
        path: '/tarefas',
        component: Tarefas,
        meta: {
            requiresAuth: true
        }
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = sessionStorage.getItem('access_token') !== null;

    if (to.meta.requiresAuth && !isAuthenticated) {
        next('/login');
    } else if (to.meta.requiresGuest && isAuthenticated) {
        next('/dashboard');
    } else {
        next();
    }
});

export default router;
