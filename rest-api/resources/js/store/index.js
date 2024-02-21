import { createStore } from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import auth from './modules/auth'
import app from './modules/app'
import feedback from './modules/feedback'
import comment from './modules/comment'
import users from './modules/users'
import categories from './modules/categories'


export default createStore({
    plugins: [createPersistedState()],
    modules: {
        auth,
        app, 
        feedback,
        comment,
        users,
        categories
    }
  })
  
