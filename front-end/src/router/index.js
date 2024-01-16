import { createRouter, createWebHistory } from 'vue-router'
import store from '../store'
const routes = [
  {
    path: '/login',
    name: 'login',
    component: () => import('../views/auth/Login.vue'),
    meta: {
      requiresAuth: false
    }
  },
  {
    path: '/register',
    name: 'register',
    component: () => import('../views/auth/Register.vue'),
    meta: {
      requiresAuth: false
    }
  },
  {
    path: '/',
    name: 'home',
    component: () => import('../views/home/Home.vue'),
    meta: {
      requiresAuth: false
    }
  },
  {
    path: '/feedbacks',
    name: 'feedbacks',
    component: () => import('../views/feedbacks/Feedbacks.vue'),
    meta: {
      requiresAuth: true
    }
  },

  {
    path: '/feedback/:id',
    name: 'feedback-detail',
    component: () => import('../views/feedbacks/FeedbackDetail.vue'),
    meta: {
      requiresAuth: true
    }
  }




]

const router = createRouter({
  history: createWebHistory(),
  routes
})


// Add a beforeEach navigation guard
router.beforeEach((to, from, next) => {

  store.commit('app/CLEAR_ERRORS');

  if (to.meta.requiresAuth) {
    // Check if the user is authenticated
    const isAuthenticated = store.getters['auth/isAuthenticated'];

    if (!isAuthenticated) {
      // User is not authenticated, redirect to the login page
      next({ name: 'login' });
      return;
    }
  }


  next();
});

export default router