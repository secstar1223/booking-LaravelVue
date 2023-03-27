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
    <div>
      <form @submit.prevent="form.post('/rentals')">
        <label>
          Name:
          <input type="text" v-model="form.name">
          <div v-if="form.errors.name">{{ form.errors.name }}</div>
        </label>
        <br>
        <label>
          Description:
         <input type="text" v-model="form.description">
          <div v-if="form.errors.description">{{ form.errors.description }}</div>
        </label>
        <br>
        <label>
         image:
		  <div>
			<input type="file" @change="onImageSelected">
			<div v-if="form.image">
			  <img :src="form.image" alt="Selected image">
			</div>
			<div v-if="form.errors.image">{{ form.errors.image }}</div>
		  </div>
        </label>
        <br>
        <button>Create Rental Product</button>
      </form>
    </div>
</AppLayout>
</template>

