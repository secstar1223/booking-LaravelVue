
<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div>
        <h1>Tax Groups</h1>
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
        <Link href="/tax-groups/create" as="button" type="button">Create a new tax rule</Link>
    </div>
</template>
  
<script>
export default {
    props: {
        taxGroups: Array,
    },
};
</script>
  