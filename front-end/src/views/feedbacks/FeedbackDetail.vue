<!-- FeedbackDetail.vue -->
<template>
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">




            <div class="bg-white p-4 rounded-md shadow-md mb-4">
                <h2 class="text-xl font-semibold mb-2">{{ feedback.title }}</h2>

                <span class="text-gray-600 text-sm">Posted: {{ formatDateTime(feedback.created_at) }}</span>

                <p class="mb-2">{{ feedback.description }}</p>
                <div class="text-sm text-gray-500 mb-2">
                    Category: {{ feedback.category }}
                </div>
                <div class="text-sm text-gray-500 mb-2">
                    User: {{ feedback.user }}
                </div>

            </div>

            <div v-if="feedback.is_comment && feedback.status === 'published'" class="bg-white p-4 rounded-md shadow-md mb-4">
                <h1 class="text-2xl font-meduim mb-1">Post Comment</h1>
                <!-- Post New Comment -->
                <div class="p-2 rounded-lg mb-2">

                    <form @submit.prevent="submitComment(feedback.id)">
                        <div class="mb-2">
                            <editor v-model="content" :key="reloadComponent" />
                        </div>
                        <button type="submit" class="bg-blue-500 text-white py-3 px-4 rounded font-medium">Post
                            Comment</button>
                    </form>

                </div>
            </div>

            <!-- Loop through Comments -->
            <div v-if="feedback.totalComments">

                <h1 class="text-2xl font-meduim mb-1">Comments</h1>

                <!-- Display comments here -->
                <div v-for="comment in feedback.comments" :key="comment.id" class="bg-white p-4 rounded-md shadow-md mb-4">
                    <!-- <p>{{ comment.content }}</p> -->

                    <p v-html="comment.content"></p>
                    <div class="flex justify-between">
                        <span class="text-gray-600 text-sm flex items-center">Posted By: {{ comment.user }}</span>
                        <span class="text-gray-600 text-sm flex items-center">Post at: {{ formatDateTime(comment.created_at)
                        }}</span>
                    </div>

                </div>

            </div>

        </div>
    </div>
</template>
  
<script>

import { ref, computed, onMounted } from 'vue';
import { useStore } from 'vuex';  // Assuming you are using Vuex
import { useRoute, useRouter } from 'vue-router';
import Editor from '../../components/Editor.vue'; // Update the path accordingly


export default {
    name: "FeedbackDetail",
    components: {
        Editor,
    },
    setup() {
        const store = useStore();
        const route = useRoute();
        const router = useRouter();
        const reloadComponent = ref(false);
        const feedbackId = computed(() => {
            return route.params.id;
        });

        const feedback = computed(() => store.getters['feedback/feedback']);
        const content = ref('');

        onMounted(() => {
            store.dispatch('feedback/fetchSingleFeedback', feedbackId.value);
        });

        const formatDateTime = (dateTime) => {
            return new Date(dateTime).toLocaleString();
        };

        const submitComment = async (feedbackId) => {
            try {

                const payload = {
                    feedback_id: feedbackId,
                    content: content.value
                };
                const response = await store.dispatch('comment/postComments', payload);

                console.log('Comment submitted successfully:', response);

                content.value = '';

                await store.dispatch('feedback/fetchSingleFeedback', feedbackId);

                await router.push({ path: `/feedback/${feedbackId}` });

                reloadComponent.value = !reloadComponent.value;

            } catch (error) {
                // Handle errors
                console.error('Error submitting comment:', error);
            }
        };

        return {
            feedback,
            feedbackId,
            formatDateTime,
            submitComment,
            content,
            reloadComponent
        };
    }

};
</script>