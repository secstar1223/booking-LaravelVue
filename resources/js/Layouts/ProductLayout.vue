<script setup>
  	import { defineProps } from 'vue';
 	

  const props = defineProps({
    detail: {
      type: Object,
      required: true
    }
  });
</script>

<template>
  <div>
    <nav>
      <ul>
        <li><a :href="`/rentals/${detail.id}/editnewrentals/equipmenttypes`">Equipment</a></li>
        <li><a :href="`/rentals/${detail.id}/editnewrentals/durations`">Durations</a></li>
        <li><a :href="`/rentals/${detail.id}/editnewrentals/prices`">Prices</a></li>
        <li><a :href="`/rentals/${detail.id}/editnewrentals/availabilityindex`">Availability</a></li>
      </ul>
    </nav>
    <slot></slot>
  </div>
</template>

