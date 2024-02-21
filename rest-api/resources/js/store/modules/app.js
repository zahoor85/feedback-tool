export default {
    namespaced: true,
    state: () => ({
        loading: false,
        errors: null,
        successMessage: null
    }),
    mutations: {
        SET_LOADING(state, loading) {
            state.loading = loading;
        },
        SET_ERRORS(state, errors) {
            state.errors = errors;
        },
        CLEAR_ERRORS(state) {
            state.errors = null;
        },
        SET_SUCCESS_MESSAGE(state, successMessage) {
            state.successMessage = successMessage
        }
    },
    actions: {},
    getters: {
        loading: state => state.loading,
        errors: state => state.errors,
        successMessage: state => state.successMessage
    }
}