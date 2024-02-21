<template>
    <ul v-if="isLoggedIn" class="flex items-center">
        <li>
            <a href="#" class="p-3">{{ userName }}</a>
        </li>
        <li>
            <form @submit.prevent="logout" class="p-3 inline">
                <button type="submit">Logout</button>
            </form>
        </li>
    </ul>

    <ul v-else class="flex items-center">
        <li>
            <router-link to="/login" class="p-3">Login</router-link>
        </li>
        <li>
            <router-link to="/register" class="p-3">Register</router-link>
        </li>
    </ul>
</template>

<script>

export default {

    name: "Right",
    computed: {
        isLoggedIn() {
            return this.$store.getters['auth/isAuthenticated'];
        },
        userName() {  
            return this.$store.getters['auth/userName'];
        },
    },
    methods: {
        logout() {
            this.$store.dispatch('auth/logout');
        },
    },
}

</script>