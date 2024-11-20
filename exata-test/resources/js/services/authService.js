import axios from 'axios';

const apiClient = axios.create({
    baseURL: '/api'
});

// --------------------------
// - Token de authenticação -
// --------------------------
const setAuthToken = () => {
    const token = localStorage.getItem('access_token');
    if (token) {

        apiClient.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    }
};

// ------------------------
// - Funções para as reqs -
// ------------------------
const login = (credentials) => {
    return apiClient.post("/login", credentials);
}

const register = (payload) => {
    return apiClient.post("/register", payload);
};

const logout = () => {
    setAuthToken();
    return apiClient.get("/logout");
};

const check = () => {
    setAuthToken();
    return apiClient.get('/check');
};

// ----------
// - Export -
// ----------
export default {
    register,
    login,
    logout,
    check
};
