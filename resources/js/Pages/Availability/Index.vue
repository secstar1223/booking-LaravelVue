<!-- TaxRules/Index.vue -->
<script setup>
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    rentalProductId: {
        type: Number,
        required: true
    },
    availabilities: {
        type: Array,
        required: true
    }
})
</script>

<template>
<AppLayout title="Availability">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Availability
      </h2>
    </template>
    <div>
        <table style="width:100%;">
            <thead>
                <tr>
                    <th>Repeats</th>
                    <th>Times</th>
                    <th>Applies to</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="taxRule in taxRules" :key="taxRule.id">
                    <td>{{ taxRule.name }}</td>
                    <td>{{ taxRule.amount }}</td>
                    <td>{{ taxRule.type }}</td>
                    <td>
                        <Link :href="`/tax-rules/${taxRule.id}/edit`" as="button" type="button">Edit</Link>
                        <Link :href="`/tax-rules/${taxRule.id}`" method="delete" as="button" type="button">Delete</Link>
                    </td>
                </tr>
            </tbody>
        </table>
        <Link :href="`/rentals/1/availability/create`" as="button" type="button">Create a new Availability</Link>
    </div>
</AppLayout>
</template>
  