<template>
    <div>
      <h1>Edit Tax Rule {{ taxRule.id }}</h1>
      <form @submit.prevent="form.put(`/tax-rules/${taxRule.id}`)">
        <label>
          Name:
          <input type="text" v-model="form.name">
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
        <button>Update Tax Rule</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { useForm } from '@inertiajs/vue3'
  
  const props = defineProps({
    taxRule: {
      type: Object,
      required: true
    }
  })
  
  const form = useForm({
    name: props.taxRule.name,
    type: props.taxRule.type,
    amount: props.taxRule.amount,
  })
  </script>
  