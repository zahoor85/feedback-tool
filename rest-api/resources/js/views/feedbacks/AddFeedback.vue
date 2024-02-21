<template>
  <div class="p-4">
    <form @submit.prevent="submitForm">
      <!-- Category Dropdown -->
      <div class="mb-4">
        <label for="category" class="block text-sm font-medium text-gray-600">Category</label>
        <select v-if="categories.length" v-model="selectedCategory" id="category" name="category"
          class="mt-1 p-2 border rounded-md w-full" :class="{ 'bg-red-100': errors?.category_id }">
          <option value="" disabled>Select Category</option>
          <option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.name }}
          </option>
        </select>
        <p v-else>Loading Categories...</p>

        <div v-if="errors?.category_id" class="text-red-500 text-sm mt-2">
          {{ errors.category_id[0] }}
        </div>

      </div>

      <!-- Title Input -->
      <div class="mb-4">
        <label for="title" class="block text-sm font-medium text-gray-600">Title</label>
        <input v-model="title" type="text" id="title" name="title" class="mt-1 p-2 border rounded-md w-full"
          :class="{ 'bg-red-100': errors?.title }">


        <div v-if="errors?.title" class="text-red-500 text-sm mt-2">
          {{ errors.title[0] }}
        </div>

      </div>

      <!-- Textarea -->
      <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-600">Description</label>
        <textarea v-model="description" id="description" name="description" rows="4"
          class="mt-1 p-2 border rounded-md w-full" :class="{ 'bg-red-100': errors?.title }" ></textarea>

        <div v-if="errors?.description" class="text-red-500 text-sm mt-2">
          {{ errors.description[0] }}
        </div>

      </div>

      <!-- Status Dropdown -->
      <div class="mb-4">
        <label for="status" class="block text-sm font-medium text-gray-600">Status</label>
        <select v-model="status" id="status" name="status" class="mt-1 p-2 border rounded-md w-full" :class="{ 'bg-red-100': errors?.title }">
          <!-- Add your status options here -->
          <option value="draft">Draft</option>
          <option value="published">Published</option>
          <!-- Add more options as needed -->
        </select>

        <div v-if="errors?.status" class="text-red-500 text-sm mt-2">
          {{ errors.status[0] }}
        </div>

      </div>

      <!-- Radio for is_comment -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-600">Allow Comments</label>
        <div class="flex items-center mt-1">
          <input v-model="isComment" type="radio" id="allowComments" name="isComment" value="true" class="mr-2">
          <label for="allowComments" class="text-sm">Yes</label>

          <input v-model="isComment" type="radio" id="disallowComments" name="isComment" value="false" class="ml-4 mr-2">
          <label for="disallowComments" class="text-sm">No</label>
        </div>

        <div v-if="errors?.is_comment" class="text-red-500 text-sm mt-2">
          {{ errors.is_comment[0] }}
        </div>

      </div>

      <!-- Submit Button -->
      <div>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Submit</button>
      </div>
    </form>
  </div>
</template>
  
<script>

import { ref, computed, onMounted, watch } from 'vue';
import { useStore } from 'vuex';  // Assuming you are using Vuex
import { useRoute, useRouter } from 'vue-router';

export default {

  setup() {
    const store = useStore();
    const categories = ref([]);
    // const reloadComponent = ref(false);

    const selectedCategory = ref("");
    const title = ref("");
    const description = ref("");
    const status = ref("");
    const isComment = ref("");
    const errors = computed(() => store.getters["app/errors"]);


    onMounted(async () => {
      const response = await store.dispatch('categories/categories');
      categories.value = response;

    });

    async function submitForm() {

      isComment.value = isComment.value === 'true';

      const payload = {
        category_id: selectedCategory.value,
        title: title.value,
        description: description.value,
        status: status.value,
        is_comment: isComment.value,

      };

      await store.dispatch("feedback/addFeedback", payload);

      //  reloadComponent.value = !reloadComponent.value;

      console.log(errors);

    }


    return {
      categories,

      selectedCategory,
      title,
      description,
      status,
      isComment,
      errors, submitForm

    };

  }
};
</script>