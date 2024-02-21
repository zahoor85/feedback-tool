<!-- CommentSection.vue -->
<template>
    <div>
        <!-- comments -->
        <div class="text-sm text-gray-500 mb-2">
            Total Comments: {{ totalComments }}
        </div>

        <!-- show/hide comments -->
        <button @click="toggleComments" class="bg-blue-500 text-white py-3 px-4 rounded font-medium">
            {{ showComments ? 'Hide Comments' : 'Show Comments' }}
        </button>

        <div v-if="showComments">
            <div v-for="comment in comments" :key="comment.id">
                <p>{{ comment.user }} Posted: {{ comment.content }}</p>
                <i>Created: {{ formatDateTime(comment.created_at) }}</i>
            </div>
        </div>

        <!-- Post Comment Modal -->
        <div v-if="shouldShowToggleAndPostButton && this.feedback.showComments">
            <form @submit.prevent="submitComment(feedback.id)">
                <div class="text-sm text-gray-500 mb-2">
                    <editor v-model="content" />
                </div>
                <button type="submit" class="bg-blue-500 text-white py-3 px-4 rounded font-medium">Post Comment</button>
            </form>
        </div>
    </div>
</template>
  
<script>
import Editor from '../../components/Editor.vue'; // Update the path accordingly
import { ref, computed, onMounted } from 'vue';
import { useStore } from 'vuex';  // Assuming you are using Vuex


export default {

    components: {
        Editor,
    },

    setup() {
        const store = useStore();
        const content = ref(''); // Assuming 'content' is a reactive variable

        const submitComment = async (feedbackId) => {
            try {

                console.log(content);

                const payload = {
                    feedback_id: feedbackId,
                    content: content.value
                };

                const response = await store.dispatch('comment/postComments', payload);

                // Check the response or handle success as needed
                console.log('Comment submitted successfully:', response);

                // Clear the content after submitting
                content.value = '';
                
            } catch (error) {
                // Handle errors
                console.error('Error submitting comment:', error);
            }
        };

        return {
            store,
            submitComment,
            content
        };

    },


    props: {
        feedback: {
            type: Object,
            required: true
        }
    },
    computed: {
        totalComments() {
            return this.feedback.totalComments;
        },
        showComments() {
            return this.feedback.showComments;
        },
        comments() {
            return this.feedback.comments;
        },
        shouldShowToggleAndPostButton() {
            // Use computed property instead of a method
            return this.feedback.totalComments > 0 && this.feedback.is_comment && this.feedback.status === 'open';

            // return this.feedback.someCondition && this.showComments;
        }
    },
    methods: {




        toggleComments() {
            this.$emit('toggle-comments', this.feedback.id);
        },
        //   submitComment() {
        //     this.$emit('submit-comment', { feedbackId: this.feedback.id, content: this.content });
        //     this.content = ''; // Clear the content after submitting
        //   },
        formatDateTime(dateTime) {
            // Implement your date formatting logic here
        }
    }
};
</script>
  
<style scoped>
/* Add component-specific styles here if needed */
</style>