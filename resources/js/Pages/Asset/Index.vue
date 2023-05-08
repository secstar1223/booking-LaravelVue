<!-- Asset/Index.vue -->
<script setup>
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';

</script>

<template>
<AppLayout title="Assets">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
       List of Assets
      </h2>
    </template>
    <div>
  <table class="table" style="width:100%;">
    <thead class="thead-dark">
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
        <td>{{ asset.resource_tracking == 1 ? 'true' : 'false' }}</td>
        <td>
          <a :href="`/asset/${asset.id}/edit`" class="btn btn-primary" role="button">Edit</a>
          <a :href="`/asset/${asset.id}`" class="btn btn-danger" role="button">Delete</a>
        </td>
      </tr>
    </tbody>
  </table>
  <Link href="/asset/create" class="btn btn-success" as="button" type="button">Create a new asset</Link>
</div>

</AppLayout>
</template>
  
<script>
export default {
  props: {
    user: Object,
    team: Object,
    assets: Array,
  },
};
</script>