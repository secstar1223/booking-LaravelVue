
<script setup>
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
<AppLayout title="Durations">
    <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Tax groups
            </h2>
    </template>
    <div>
        <table style="width:100%;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="taxGroup in taxGroups" :key="taxGroup.id">
                    <td>{{ taxGroup.name }}</td>
                    <td>
                        <Link :href="`/tax-groups/${taxGroup.id}/edit`" as="button" type="button">Edit</Link>
                        <Link :href="`/tax-groups/${taxGroup.id}`" method="delete" as="button" type="button">Delete</Link>
                    </td>
                </tr>
            </tbody>
        </table>
        <Link href="/tax-groups/create" as="button" type="button">Create a new tax group</Link>
    </div>
</AppLayout>
</template>
  
<script>
export default {
    props: {
        taxGroups: Array,
    },
};
</script>
  