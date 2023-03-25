<script setup>

import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    rentalProductId: {
        type: Number,
        required: true
    }
})

const form = useForm({
  type: 'daily',
  first_time: 0,
  last_time: 0,
  starts_every: 900,
  buffer_time: 0,
  starts_specific: [],
})
</script>

<template>
<AppLayout title="Durations">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          Create an Availability
      </h2>
    </template>
    <div>

      $table->foreign('rental_product_id')->references('id')->on('rental_products')->onDelete('cascade');
            $table->index('rental_product_id');
            $table->enum('availability_type', ['once', 'daily', 'weekly', 'monthly']);
            $table->integer('first_time');
            $table->integer('last_time');
            $table->integer('starts_every');
            $table->integer('buffer_time');
            $table->text('starts_specific');
            $table->string('created_timezone');
            $table->boolean('display_created_timezone');


      <form @submit.prevent="form.post('/tax-rules')">
        <label>
          Name:
          <input type="text" v-model="form.availability_type">
          <div v-if="form.errors.name">{{ form.errors.name }}</div>
        </label>
        <br>
        <label>
          Type:
          <select v-model="form.type">
            <option value="fixed">Fixed</option>
            <option value="percent">Percentage</option>
          </select>
          <div v-if="form.errors.type">{{ form.errors.type }}</div>
        </label>
        <br>
        <label>
          Amount:
          <input
            type="number"
            v-model="form.amount"
            :max="form.type === 'percentage' ? 100 : null"
            step="1"
          >
          {{ form.type === 'percentage' ? '%' : '' }}
          <div v-if="form.errors.amount">{{ form.errors.amount }}</div>
        </label>
        <br>
        <button>Create Tax Rule</button>
      </form>
    </div>
</AppLayout>
</template>

