<script setup>

import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';

const form = useForm({
    name: '',
    description: '',
    image: null,
})
</script>

<template>
<AppLayout title="Details">
    <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Create a product
            </h2>
    </template>
    <div class="container">
  <form @submit.prevent="form.post('/rentals')" class="my-4">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" v-model="form.name">
      <div v-if="form.errors.name" class="text-danger">{{ form.errors.name }}</div>
    </div>
    <div class="form-group">
      <label for="description">Description:</label>
      <input type="text" class="form-control" id="description" v-model="form.description">
      <div v-if="form.errors.description" class="text-danger">{{ form.errors.description }}</div>
    </div>
    <div class="form-group">
      <label for="image">Image:</label>
      <div>
        <input type="file" class="form-control-file" id="image" @change="onImageSelected">
        <div v-if="form.image">
          <img :src="form.image" alt="Selected image" class="mt-2">
        </div>
        <div v-if="form.errors.image" class="text-danger">{{ form.errors.image }}</div>
      </div>
    </div>
    <button class="btn btn-primary">Create Rental Product</button>
  </form>
</div>

</AppLayout>
</template>

