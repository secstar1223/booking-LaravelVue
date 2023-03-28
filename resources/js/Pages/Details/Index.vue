<script setup>
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
<AppLayout title="Details">
    <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Details
            </h2>
    </template>
    <div>
        <table style="width:100%;">
            <thead>
                <tr>
                    <th>Name</th>
					<th>Equipment</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="detail in details" :key="detail.id">
                    <td>{{ detail.name }}</td>
					<td>
						<ul>
							<li>equipment_type for this product</li>
						</ul>
					</td>
                    <td>
                        <Link :href="`/rentals/${details.id}/edit`" as="button" type="button">Edit</Link>
                        <Link :href="`/rentals/${details.id}`" method="delete" as="button" type="button">Delete</Link>
                    </td>
                </tr>
            </tbody>
        </table>
        <Link href="/rentals/create" as="button" type="button">Create a new Product</Link>
    </div>
</AppLayout>
</template>
  
<script>
export default {

    props: {
        details: Array,
    },
};
</script>
  