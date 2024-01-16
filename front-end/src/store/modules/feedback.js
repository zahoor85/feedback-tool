import axios from 'axios';
import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        feedbacks: [],
        feedback: []
    }),
    mutations: {

        SET_FEEDBACKS(state, feedbacks) {
            state.feedbacks = feedbacks;
        },

        SET_FEEDBACK(state, feedback) {
            state.feedback = feedback;
        },

    },
    actions: {
        async addFeedback({ commit }, payload) {
            commit('app/SET_LOADING', true, { root: true });
            await axios.post('/api/feedbacks', payload, {
                headers: {
                    'Authorization': `Bearer ${this.state.auth.token}`
                }
            }).then(res => {
                // dispatch('/getAllFeedbacks', null, { root: true });
                commit('app/SET_ERRORS', null, { root: true });
                router.go(0);
                // commit('SET_FEEDBACK', res.data.data);

            }).catch(err => commit('app/SET_ERRORS', err.response.data.errors, { root: true }));

            commit('app/SET_LOADING', false, { root: true });
        },
        async getAllFeedbacks({ commit }) {
            commit('app/SET_LOADING', true, { root: true });
            await axios.get(`/api/feedbacks`, {
                headers: {
                    'Authorization': `Bearer ${this.state.auth.token}`
                }
            }).then(res => {
                commit('SET_FEEDBACKS', res.data.data);
            }).catch(err => console.log(err));

            commit('app/SET_LOADING', false, { root: true });
        },
        async fetchSingleFeedback({ commit }, feedbackId) {
            commit('app/SET_LOADING', true, { root: true });
            await axios.get(`/api/feedbacks/${feedbackId}`, {
                headers: {
                    'Authorization': `Bearer ${this.state.auth.token}`
                }
            }).then(res => {
                commit('SET_FEEDBACK', res.data.data);
            }).catch(err => console.log(err));

            commit('app/SET_LOADING', false, { root: true });
        }
    },
    getters: {
        feedbacks: state => state.feedbacks,
        feedback: state => state.feedback

    }
}