<!-- TaxRules/Index.vue -->
<script setup>
import { Link } from '@inertiajs/vue3'

</script>

<template>
    <div>
        <h1>Tax Rules</h1>
        <table style="width:100%;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Type</th>
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
        <Link href="/tax-rules/create" as="button" type="button">Create a new tax rule</Link>
    </div>
</template>
  
<script>
export default {
    props: {
        taxRules: Array,
    },
};
</script>
  