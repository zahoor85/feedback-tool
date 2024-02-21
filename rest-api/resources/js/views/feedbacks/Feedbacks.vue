<template>
  <div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">

      <div class="bg-white p-4 rounded-md shadow-md mb-4">
        <add-feedback />
      </div>

      <div v-for="feedback in feedbacks" :key="feedback.id">


        <div class="bg-white p-4 rounded-md shadow-md mb-4">
          <router-link :to="{ name: 'feedback-detail', params: { id: feedback.id } }">
            <h2 class="text-xl font-semibold mb-2">
              <a href="" class="font-bold">{{ feedback.title }}</a>
            </h2>

          </router-link>

          <span class="text-gray-600 text-sm">Posted: {{ formatDateTime(feedback.created_at) }}</span>

          <p class="mb-2">{{ feedback.description }}</p>
          <div class="text-sm text-gray-500 mb-2">
            Category: {{ feedback.category }}
          </div>
          <div class="text-sm text-gray-500 mb-2">
            User: {{ feedback.user }}
          </div>
          <div class="text-sm text-gray-500  mb-2">
            Total Comments: {{ feedback.totalComments }}
          </div>
          <div class="text-sm text-gray-500  mb-2">
            Current Status: {{ feedback.status }}
          </div>






        </div>

      </div>

    </div>
  </div>
</template>

<script>

import { ref, computed, onMounted } from 'vue';
import { useStore } from 'vuex';  // Assuming you are using Vuex
import AddFeedback from './AddFeedback.vue';
import FeedbackDetail from './FeedbackDetail.vue';

export default {
  name: 'Feedbacks',
  components: {
    FeedbackDetail,
    AddFeedback,
  },
  setup() {
    const store = useStore();
    const feedbacks = computed(() => store.getters['feedback/feedbacks']);
    onMounted(() => {
      store.dispatch('feedback/getAllFeedbacks');
    });
    const formatDateTime = (dateTime) => {
      return new Date(dateTime).toLocaleString();
    };

    return {
      feedbacks,
      formatDateTime
    };
  }
};
</script>