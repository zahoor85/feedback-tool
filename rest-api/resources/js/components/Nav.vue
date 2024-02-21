<template>
    <nav class="p-6 bg-white flex justify-between mb-6">
        <ul class="flex items-center">
            <li>

                <router-link to="/" class="p-3">Home</router-link>


            </li>
            <li>
                <router-link to="/feedbacks" class="p-3">Feebacks</router-link>
            </li>
        </ul>




        <Right />


    </nav>
</template>

<script>

import Right from './Right.vue';

export default {
    name: 'Nav',
    components: {
        Right
    }
}

</script>