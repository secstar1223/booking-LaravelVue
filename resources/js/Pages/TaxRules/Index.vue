<!-- TaxRules/Index.vue -->
<script setup>
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';

</script>

<template>
<AppLayout title="Tax rules">
<div class="container">
    <div class="box">
        <h1>Tax rules</h1>
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Type</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="taxRule in taxRules" :key="taxRule.id">
                    <td>{{ taxRule.name }}</td>
                    <td>{{ taxRule.amount }}</td>
                    <td>{{ taxRule.type }}</td>
                    <td style="text-align:right;">
                        <Link :href="`/tax-rules/${taxRule.id}/edit`" as="button" type="button" class="btn btn-sm btn-outline-primary" title="Edit this tax rule"><i class="fas fa-edit"></i></Link>
                        &nbsp;
                        <Link :href="`/tax-rules/${taxRule.id}`" method="delete" as="button" type="button" class="btn btn-sm btn-outline-danger" title="Delete this tax rule"><i class="fas fa-trash-alt"></i></Link>
                    </td>
                </tr>
            </tbody>
        </table>
        <Link href="/tax-rules/create" as="button" type="button" class="btn btn-primary">Create a new tax rule</Link>
    </div>
</div>
</AppLayout>
</template>
  
<script>
export default {
    props: {
        taxRules: Array,
    },
};
</script>
  