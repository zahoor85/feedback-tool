import axios from 'axios';

export default {
    namespaced: true,
    state: () => ({
        categories: [],

    }),
    mutations: {

        SET_CATEGORIES(state, categories) {

            console.log('Setting categories:', categories);
            
            state.categories = categories;
        },
    },
    actions: {
        async categories({ commit }) {
            try {
                const response = await axios.get('/api/categories', {
                    headers: {
                        'Authorization': `Bearer ${this.state.auth.token}`
                    }
                });
                console.log("axios  Response ");
                commit('SET_CATEGORIES', response.data.data);
                return response.data.data; // Return the response if needed in the component
            } catch (error) {
                console.error('Error posting comments:', error);
                throw error; // Re-throw the error for the component to handle if needed
            } finally {
                //  commit('app/SET_LOADING', false, { root: true });
            }

        },

    },
    getters: {
        categories: state => state.categories,

    }
}