<template>
<AppLayout title="Assets">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Edit Asset
      </h2>
    </template>
    <div>
      <form @submit.prevent="form.put(`/asset/${asset.id}`)">
        <label>
          Name:
          <input type="text" v-model="form.name">
          <div v-if="form.errors.name">{{ form.errors.name }}</div>
        </label>
        <br>
        <label>
          Resource Tracking:
          <select v-model="form.type">
            <option value="fixed">Yes</option>
            <option value="percent">No</option>
          </select>
          <div v-if="form.errors.type">{{ form.errors.type }}</div>
        </label>
        <br>
        <label>
          Amount:
          <input type="number" v-model="form.amount">
          <div v-if="form.errors.amount">{{ form.errors.amount }}</div>
        </label>
        <br>
        <button>Update Tax Rule</button>
      </form>
    </div>
</AppLayout>
</template>
  
  <script setup>
  import { useForm } from '@inertiajs/vue3'
  import AppLayout from '@/Layouts/AppLayout.vue';
  
  const props = defineProps({
    asset: {
      type: Object,
      required: true
    }
  })
  
  const form = useForm({
    name: props.asset.name,
    resource_tracking: props.asset.resource_tracking,
    amount: props.asset.amount,
  })
  </script>