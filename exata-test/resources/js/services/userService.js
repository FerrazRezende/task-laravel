import axios from 'axios';

const apiClient = axios.create({
    baseURL: '/api/users'
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
const getAllUsersPage = (page = 1) => {
    setAuthToken();

    return apiClient.get("/page", {
        params: { page },
    });
};

const getAllUsers = () => {
    setAuthToken();

    return apiClient.get("/");
};

const getUserById = (user_id) => {
    setAuthToken();

    return apiClient.get(`/${user_id}`);
};

const editUser = (user_id, payload) => {
    setAuthToken();

    return apiClient.put(`/${user_id}`, payload);
};

const deleteUser = (user_id) => {
    setAuthToken();

    return apiClient.delete(`/${user_id}`);
};

// ----------
// - Export -
// ----------
export default {
    getAllUsers,
    getUserById,
    editUser,
    getAllUsersPage,
    deleteUser
};
