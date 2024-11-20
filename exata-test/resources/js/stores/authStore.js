import { defineStore } from 'pinia';
import router from '../routes/router.js'
import AuthService from "../services/authService.js";
import {ElNotification} from "element-plus";

export const useAuthStore = defineStore('authStore', {

    // Variáveis de estado
    state: () => ({
        token: null,
        tokenType: null,
        userId: null,
        isAdmin: false,
    }),

    actions: {
        async register(payload) {
            try {
                const response = await AuthService.register(payload);

                if(response.data) {
                    ElNotification({
                        title: 'Ok',
                        message: 'Conta registrada com sucesso!',
                        type: 'success'
                    });
                    return true;
                }

            } catch(err) {
                ElNotification({
                    title: 'Erro',
                    message: 'Falha ao criar a conta',
                    type: 'success'
                });
            }
        },

        async login(nome_usuario, password) {
            try {
                const credentials = {
                    "nome_usuario": nome_usuario,
                    "password": password
                };

                const response = await AuthService.login(credentials);

                if (response.data && response.data.access_token) {
                    this.token = response.data.access_token;
                    this.tokenType = response.data.token_type;
                    this.userId = response.data.user_id;
                    this.isAdmin = response.data.is_admin;
                    this.isAuthenticated = true;

                    localStorage.setItem('access_token', response.data.access_token);

                    return true;
                } else {
                    ElNotification({
                        title: 'Erro',
                        message: 'Credenciais inválidas',
                        type: 'error',
                    });
                }
            } catch (err) {
                return false;
            }
        },

        async logout() {
            try {
                const response = await AuthService.logout();

                if (response.data) {
                    this.$reset();
                    localStorage.removeItem('access_token');

                    await router.push("/");

                    ElNotification({
                        title: 'Sucesso',
                        message: 'Logout efetuado com sucesso!',
                        type: 'success',
                    });

                } else {
                    ElNotification({
                        title: 'Erro',
                        message: 'Não foi possível efetuar o logout',
                        type: 'error',
                    });
                }
            } catch(err) {
                ElNotification({
                    title: 'Erro',
                    message: 'Ocorreu um erro inesperado ao fazer logout',
                    type: 'error',
                });
            }
        },

        async checkSession() {
            try {
                const response = await AuthService.check();

                if (response.data) {
                    this.isAdmin = response.data.is_admin;
                    this.userId = response.data.user_id;
                }
            } catch(err){
            }
        },
    }
})
