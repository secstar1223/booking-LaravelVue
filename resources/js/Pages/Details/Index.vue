<script setup>
import { Link } from '@inertiajs/vue3'
import { computed, defineProps } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'

const props = defineProps({
  details: {
    type: Array,
    required: true
  },
  equipmenttypes: {
    type: Object,
    required: true
  },
  prices: {
    type: Object
  },
  durations: {
    type: Object
  },
  availabilities: {
    type: Object
  }
})
</script>
<template>
  <AppLayout title="Details">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Details
      </h2>
    </template>
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Equipment</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="detail in details" :key="detail.id">
            <td>
              <span v-if="!hasMatchingRentalProductId(detail.id,detail.prices,detail.durations,detail.availabilities,detail.equipmenttypes)">
                <i class="fas fa-exclamation-triangle" style="color: red;"></i>
              </span>
              {{ detail.name }}
            </td>
            <td>
              <ul>
                <li v-for="equipmenttype in detail.equipmenttypes" :key="equipmenttype.id">
                  {{ equipmenttype.name }}
                </li>
              </ul>
            </td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                <a :href="`/rentals/${detail.id}/editnewrentals`" class="btn btn-primary" role="button">Edit</a>
                <a :href="`/rentals/${detail.id}`" class="btn btn-danger" role="button" @click.prevent="deleteRental(detail.id)">Delete</a>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <a href="/rentals/create" class="btn btn-success" role="button">Create a new Product</a>
    </div>
  </AppLayout>
</template>

<script>
const hasMatchingRentalProductId = (rentalProductId, prices, durations, availabilities, equipmenttypes) => {
  const allData = [prices, durations, availabilities, equipmenttypes]
  for (let data of allData) {
    if (data) {
      if (data.some((item) => item.rental_product_id === rentalProductId)) {
        return true
      }
    }
  }
  return false
}
</script>
