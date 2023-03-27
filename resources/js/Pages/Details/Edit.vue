<template>
<AppLayout title="Details">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Edit Details
      </h2>
    </template>
    <div>
      <form @submit.prevent="form.put(`/rentals/${details.id}`)">
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
        <button>Update Details</button>
      </form>
    </div>
</AppLayout>
</template>
  
  <script setup>
  import { useForm } from '@inertiajs/vue3';
  import AppLayout from '@/Layouts/AppLayout.vue';
  
  const props = defineProps({
    detail: {
      type: Object,
      required: true
    }
  });
  
  const form = useForm({
    name: props.detail.name,
    descripton: props.detail.description,
    image: props.detail.image,
  });
  
  function onImageSelected(event) {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.addEventListener('load', () => {
      setData('image', reader.result);
    });
    reader.readAsDataURL(file);
  }
  </script>
  