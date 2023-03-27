<script setup>

import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';

const form = useForm({
    name: '',
   resource_tracking: true,
    amount: 0,
})
</script>

<template>
<AppLayout title="Assets">
    <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Create a Asset
            </h2>
    </template>
    <div>
      <form @submit.prevent="form.post('/asset')">
        <label>
          Name:
          <input type="text" v-model="form.name">
          <div v-if="form.errors.name">{{ form.errors.name }}</div>
        </label>
        <br>
        <label>
              Resource Tracking:
              <input type="checkbox" v-model="form.resource_tracking">
          <div v-if="form.errors.type">{{ form.errors.type }}</div>
        </label>
        <br>
        <label>
          Amount:
          <input
            type="number"
            v-model="form.amount"
          >
          <div v-if="form.errors.amount">{{ form.errors.amount }}</div>
        </label>
        <br>
        <button>Create Asset</button>
      </form>
    </div>
</AppLayout>
</template>

