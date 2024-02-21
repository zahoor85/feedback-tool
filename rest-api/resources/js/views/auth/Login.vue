<template>
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg">

            <div class="mb-8">
                <h2 class="text-4xl font-bold tracking-tight mb-2">Log in.</h2>
                <p class="text-sm text-gray-800">Log in with email and password you were provided.</p>
            </div>

            <form @submit.prevent="submitForm" class="mb-4">

                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email" id="email" placeholder="Enter your email"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="" v-model="email" :class="{ 'bg-red-100': errors?.password }" />
                    <div v-if="errors?.email" class="text-red-500 text-sm mt-2">
                        {{ errors.email[0] }}
                    </div>

                </div>

                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg " v-model="password" :class="{ 'bg-red-100': errors?.password }" />
                    <div v-if="errors?.password" class="text-red-500 text-sm mt-2">
                        {{ errors.password[0] }}
                    </div>

                </div>

                <div class="mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="mr-2" v-model="remember" />
                        <label for="remember">Remember me</label>
                    </div>
                </div>

                <div>
                    <button type="submit" name="login"
                        class="bg-blue-500 text-white py-3 px-4 rounded font-medium w-full">Login</button>
                </div>
            </form>

        </div>

    </div>
</template>
    

<script>
import { ref, computed } from 'vue';
import { useStore } from "vuex";

export default {
    name: 'Login',
    setup() {
        const store = useStore();
        const email = ref("");
        const password = ref("");
        const remember = ref(false);
        const loading = computed(() => store.getters["app/loading"]);
        const errors = computed(() => store.getters["app/errors"]);

        async function submitForm() {
            const payload = {
                email: email.value,
                password: password.value,
            };

            await store.dispatch("auth/userLogin", payload);

        }

        return {
            email,
            password,
            loading,
            errors,
            submitForm
        }
    }
}
</script>