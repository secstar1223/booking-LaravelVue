<!-- Asset/Index.vue -->
<script setup>
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';

</script>

<template>
<AppLayout title="Assets">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Tax Rules
      </h2>
    </template>
    <div>
        <table style="width:100%;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Resource Tracking</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="asset in assets" :key="asset.id">
                    <td>{{ asset.name }}</td>
                    <td>{{ asset.amount }}</td>
                    <td>{{ asset.resource_tracking }}</td>
                    <td>
                        <Link :href="`/asset/${asset.id}/edit`" as="button" type="button">Edit</Link>
                        <Link :href="`/asset/${asset.id}`" method="delete" as="button" type="button">Delete</Link>
                    </td>
                </tr>
            </tbody>
        </table>
        <Link href="/asset/create" as="button" type="button">Create a new asset</Link>
    </div>
</AppLayout>
</template>
  
<script>
export default {
    props: {
        asset: Array,
    },
};
</script>