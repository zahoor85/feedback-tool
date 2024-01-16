import axios from 'axios';
import Cookies from 'js-cookie';
import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        user: null,
        isAdmin: false,
        token: null,
        userName:null
    }),
    mutations: {
        SET_USER(state, user) {
            state.user = user;
        },
        SET_USER_NAME(state, userName) {
            state.userName = userName;
        },
        SET_IS_ADMIN(state, isAdmin) {
            state.isAdmin = isAdmin;
        },
        SET_TOKEN(state, token) {
            state.token = token;
        }
    },
    actions: {
        async userLogin({ commit, dispatch }, credentials) {
            commit('app/SET_LOADING', true, { root: true });
            await axios.get('/sanctum/csrf-cookie');
            axios.post('/api/login', credentials)
                .then(
                    res => {
                    commit('SET_USER', res.data.data.user);
                    commit('SET_USER_NAME', res.data.data.user.name);
                    commit('SET_IS_ADMIN', false)
                    commit('SET_TOKEN', res.data.data.token);
                    commit('app/SET_ERRORS', null, { root: true });
                    dispatch('feedback/getAllFeedbacks', null, { root: true });
                    router.push('/feedbacks');
                })
                .catch(err => commit('app/SET_ERRORS', err.response.data.errors, { root: true }));
            
                await commit('app/SET_LOADING', false, { root: true });
        },
        async userRegister({ commit, dispatch }, credentials) {
            commit('app/SET_LOADING', true, { root: true });
            await axios.get('/sanctum/csrf-cookie');
            axios.post('/api/register', credentials)
                .then(
                    res => {
                    commit('SET_USER', res.data.data.user);
                    commit('SET_IS_ADMIN', false)
                    commit('SET_TOKEN', res.data.data.token);
                    commit('app/SET_ERRORS', null, { root: true });
                    router.push('/login');
                })
                .catch(err => commit('app/SET_ERRORS', err.response.data.errors, { root: true }));
            
                await commit('app/SET_LOADING', false, { root: true });
        },
        async logout({ commit }) {
            await axios.post('/api/logout', [], {
                headers: {
                  'Authorization': `Bearer ${this.state.auth.token}`
                }
              })
                .then(res => {
                    if(res.status === 204) {
                        commit('SET_USER', null);
                        commit('SET_IS_ADMIN', false);
                        commit('SET_USER_NAME', null);
                        commit('app/SET_ERRORS', null, { root: true });
                        Cookies.remove('XSRF-TOKEN');
                        router.push('/');
                    }
                })
        }
    },
    getters: {
        user: state => state.user,
        userName:state => state.userName,
        isAdmin: state => state.isAdmin,
        isAuthenticated: state => !!state.user,
        token: state => state.token
    }
}