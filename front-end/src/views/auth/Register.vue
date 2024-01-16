<template>
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg">
            <div class="mb-8">
                <h2 class="text-4xl font-bold tracking-tight mb-2">Register</h2>
                <p class="text-sm text-gray-800">Fill in the fields to register an account.</p>
            </div>

            <form @submit.prevent="submitForm" class="mb-4">


                <div class="mb-4">
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" name="name" v-model="name" id="name" placeholder="Enter your name"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg" :class="{ 'bg-red-100': errors?.name }"
                        value="" />


                    <div v-if="errors?.name" class="text-red-500 text-sm mt-2">
                        {{ errors.name[0] }}
                    </div>


                </div>

                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email" id="email"  :class="{ 'bg-red-100': errors?.email }" v-model="email" placeholder="Enter your email"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg " value="" />
                    <div v-if="errors?.email" class="text-red-500 text-sm mt-2">
                        {{ errors.email[0] }}
                    </div>

                </div>

                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" v-model="password" id="password"  :class="{ 'bg-red-100': errors?.password }" 
                        placeholder="choose your password" class="bg-gray-100 border-2 w-full p-4 rounded-lg " />
                    <div v-if="errors?.password" class="text-red-500 text-sm mt-2">
                        {{ errors.password[0] }}
                    </div>

                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="sr-only">Password Confirmation</label>
                    <input type="password" name="password_confirmation" v-model="password_confirmation" :class="{ 'bg-red-100': errors?.password_confirmation }"
                        id="password_confirmation" placeholder="Password Confirmation"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg" />
                    <div v-if="errors?.password_confirmation" class="text-red-500 text-sm mt-2">
                        {{ errors.password_confirmation[0] }}
                    </div>
                </div>

                <div>
                    <button type="submit" name="register"
                        class="bg-blue-500 text-white py-3 px-4 rounded font-medium w-full">Register</button>
                </div>
            </form>
        </div>

    </div>
</template>
    

<script>
import { ref, computed } from 'vue';
import { useStore } from "vuex";

export default {
    name: 'Register',
    setup() {

        const store = useStore();
        const name = ref("");
        const email = ref("");
        const password = ref("");
        const password_confirmation = ref("");
        const loading = computed(() => store.getters["app/loading"]);
        const errors = computed(() => store.getters["app/errors"]);

        async function submitForm() {

            const payload = {
                name: name.value,
                email: email.value,
                password: password.value,
                password_confirmation: password_confirmation.value
            };

            await store.dispatch("auth/userRegister", payload);

        }

        return {
            name,
            email,
            password,
            password_confirmation,
            loading,
            errors,
            submitForm
        }
    }
}
</script>