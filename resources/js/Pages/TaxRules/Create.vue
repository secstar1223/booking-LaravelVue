<script setup>

import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';

const form = useForm({
    name: '',
    type: 'fixed',
    amount: 0,
})
</script>

<template>
    <AppLayout title="Create a tax rule">
        <div class="container">
            <div class="box">
                <h1>Create a tax rule</h1>
                <form @submit.prevent="form.post('/tax-rules')">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" :class="'form-control' + (form.errors.name ? ' is-invalid' : '')" id="name" v-model="form.name">
                        <div class="invalid-feedback">{{ form.errors.name }}</div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select :class="'form-control' + (form.errors.type ? ' is-invalid' : '')" id="type" v-model="form.type">
                            <option value="fixed">Fixed</option>
                            <option value="percent">Percentage</option>
                        </select>
                        <div class="invalid-feedback">{{ form.errors.type }}</div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <div :class="'input-group' + (form.errors.amount ? ' is-invalid' : '')">
                            <input type="number" :class="'form-control' + (form.errors.amount ? ' is-invalid' : '')" id="amount" v-model="form.amount" :max="form.type === 'percentage' ? 100 : null" step="1">
                            <span :class="'input-group-text' + (form.errors.amount ? ' is-invalid' : '')" v-if="form.type == 'percent'">%</span>
                        </div>
                        <div class="invalid-feedback" v-if="form.errors.amount">{{ form.errors.amount }}</div>
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

