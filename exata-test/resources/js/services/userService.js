import axios from 'axios';

const apiClient = axios.create({
    baseURL: '/api/users'
});

const setAuthToken = () => {
    const token = sessionStorage.getItem('access_token');
    if (token) {
        apiClient.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    }
}

const getAllUsers = () => {
    setAuthToken()

    return apiClient.get("/");
}

const getUserById = (user_id) => {
    setAuthToken()

    return apiClient.get(`/${user_id}`)
}

const editUser = (user_id, payload) => {
    setAuthToken()

    return apiClient.put(`/${user_id}`, payload)
}

const deleteUser = (user_id) => {
    setAuthToken()

    return apiClient.delete(`/${user_id}`)
}


export default {
    getAllUsers,
    getUserById,
    editUser,
    deleteUser
};
