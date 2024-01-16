import axios from 'axios';

export default {
    namespaced: true,
    state: () => ({
        users: [],

    }),
    mutations: {

        SET_USERS(state, users) {
            state.users = users;
        },
    },
    actions: {
        async users({ commit }, searchTerm) {
            try {
                const response = await axios.get(`/api/users?search=${searchTerm}`, {
                    headers: {
                        'Authorization': `Bearer ${this.state.auth.token}`
                    }
                });

                // commit('SET_COMMENTS', response.data.data);

                return response; // Return the response if needed in the component
            } catch (error) {
                console.error('Error posting comments:', error);
                throw error; // Re-throw the error for the component to handle if needed
            } finally {
                // commit('app/SET_LOADING', false, { root: true });
            }

        },

    },
    getters: {
        users: state => state.users,

    }
}