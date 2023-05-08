
<script setup>
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
<AppLayout title="Tax groups">
<div class="container">
    <div class="box">
        <h1>Tax groups</h1>
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="taxGroup in taxGroups" :key="taxGroup.id">
                    <td>{{ taxGroup.name }}</td>
                    <td style="text-align:right;">
                        <Link :href="`/tax-groups/${taxGroup.id}/edit`" as="button" type="button" class="btn btn-sm btn-outline-primary" title="Edit this tax group"><i class="fas fa-edit"></i></Link>
                        &nbsp;
                        <Link :href="`/tax-groups/${taxGroup.id}`" method="delete" as="button" type="button" class="btn btn-sm btn-outline-danger" title="Delete this tax group"><i class="fas fa-trash-alt"></i></Link>
                    </td>
                </tr>
            </tbody>
        </table>
        <Link href="/tax-groups/create" as="button" type="button" class="btn btn-primary">Create a new tax group</Link>
    </div>
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
  