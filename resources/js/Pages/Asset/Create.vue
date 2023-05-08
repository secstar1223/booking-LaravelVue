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
    <div class="container">
  <form @submit.prevent="form.post('/asset')" class="row g-3">
    <div class="col-md-6">
      <label for="name" class="form-label">Name:</label>
      <input type="text" class="form-control" id="name" v-model="form.name">
      <div v-if="form.errors.name" class="invalid-feedback">{{ form.errors.name }}</div>
    </div>
    <div class="col-md-6">
      <label class="form-label">Resource Tracking:</label>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="resource_tracking" v-model="form.resource_tracking">
        <label class="form-check-label" for="resource_tracking">Track this asset as a resource</label>
      </div>
      <div v-if="form.errors.type" class="invalid-feedback">{{ form.errors.type }}</div>
    </div>
    <div class="col-md-6">
      <label for="amount" class="form-label">Amount:</label>
      <input type="number" class="form-control" id="amount" v-model="form.amount">
      <div v-if="form.errors.amount" class="invalid-feedback">{{ form.errors.amount }}</div>
    </div>
    <div class="col-12">
      <button class="btn btn-primary" type="submit">Create Asset</button>
    </div>
  </form>
</div>

</AppLayout>
</template>

