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
const getAllTasks = () => {
    setAuthToken();

    return apiClient.get('/tarefas');
};

const filterTasks = (userId, filters = {}) => {
    setAuthToken();

    const params = new URLSearchParams(filters).toString();

    return apiClient.get(`/tarefas/user/${userId}?${params}`);
};

const filterTasksAdmin = (filters = {}) => {
    setAuthToken();

    const params = new URLSearchParams(filters).toString();

    return apiClient.get(`/tarefas/?${params}`);
};

const getTaskByUserId = (userId) => {
    setAuthToken();

    return apiClient.get(`/tarefas/user/${userId}`);
};

const getTaskById = (taskId) => {
    setAuthToken();

    return apiClient.get(`/tarefas/${taskId}`);
};

const getTaskCountsByUserId = (userId) => {
    setAuthToken();

    return apiClient.get(`/tarefas/${userId}/count`);
};

const createTask = async (payload) => {
    setAuthToken();

    return await apiClient.post('/tarefas', payload);
};

const editTask = async (payload, taskId) => {
    setAuthToken();

    return await apiClient.put(`/tarefas/${taskId}`, payload);
};

const deleteTask = async (taskId) => {
    setAuthToken();

    return await apiClient.delete(`/tarefas/${taskId}`);
};

// ----------
// - Export -
// ----------
export default {
    getAllTasks,
    filterTasks,
    filterTasksAdmin,
    getTaskByUserId,
    getTaskById,
    getTaskCountsByUserId,
    createTask,
    editTask,
    deleteTask
};
