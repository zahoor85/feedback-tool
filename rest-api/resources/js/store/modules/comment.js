import axios from 'axios';
import { useToast } from 'vue-toastification';
const toast = useToast();

export default {
  namespaced: true,
  state: () => ({
    comments: []
  }),
  mutations: {

    SET_COMMENTS(state, comments) {
      state.comments = comments;
    },

  },
  actions: {
    async postComments({ commit, state }, payload) {
      commit('app/SET_LOADING', true, { root: true });

      try {
        const response = await axios.post(`/api/comments`, payload, {
          headers: {
            'Authorization': `Bearer ${this.state.auth.token}`
          }
        });

        commit('SET_COMMENTS', response.data.data);
        toast.success('Comment has been added successfully');

        return response; // Return the response if needed in the component
      } catch (error) {
        console.error('Error posting comments:', error);
        throw error; // Re-throw the error for the component to handle if needed
      } finally {
        commit('app/SET_LOADING', false, { root: true });
      }
    }

    
  },
  getters: {
    comments: state => state.comments
  }
}