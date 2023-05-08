<script setup>
import { Link} from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import ProductLayout from '@/Layouts/ProductLayout.vue';

const props = defineProps({
    detailsId: {
        type: Number,
        required: true
    },
    availabilities: {
        type: Array,
        required: true
    },
	detail: {
      type: Object,
      required: true

	},

})

	const daysOfWeek = (availability) => {
		let days = [];
		if (availability.mon) days.push('Monday');
		if (availability.tue) days.push('Tuesday');
		if (availability.wed) days.push('Wednesday');
		if (availability.thu) days.push('Thursday');
		if (availability.fri) days.push('Friday');
		if (availability.sat) days.push('Saturday');
		if (availability.sun) days.push('Sunday');
		return days.join(', ');
	};
	
function displayTime(timestamp) {
    let pad = (value) => (value < 10 ? '0' + value : value)
    let hours = Math.floor(timestamp / 60 / 60)
    let minutes = Math.floor((timestamp - hours * 60 * 60) / 60)
    return (hours > 12 ? hours - 12 : (hours == 0 ? 12 : hours )) + ':' + pad(minutes) + (hours > 11 && hours != 24 ? ' pm' : ' am')
}

	

</script>

<template>
<AppLayout title="Availability">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Availability
      </h2>
    </template>
	<ProductLayout v-if="detail" :detail="detail">
      		
    </ProductLayout>
    <div class="container">
  <table class="table">
    <thead>
      <tr>
        <th>Repeats</th>
        <th>Times</th>
        <th>Applies to</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(availability, index) in detail.availabilities" :key="index">
        <td>
          {{ availability.times }}
          {{ availability.mon && availability.tue && availability.wed && availability.thu && availability.fri && availability.sat && availability.sun ? 'Daily' : 'Each Week on: ' + daysOfWeek(availability) }}
        </td>
        <td>
          {{ availability.times === 'specific' ? 'Fixed at ' + availability.starts_specific.map(el => displayTime(el)).join(', ') : 'Variable every ' + (availability.starts_every / 60) + ' mins from ' + (availability.start_time === 0 ? displayTime(0) : displayTime(availability.start_time)) + ' to ' + displayTime(availability.end_time) }}
        </td>
        <td>
          {{ props.availabilities.find(a => a.id === availability.id).applies_to.map(item => item[0]).join(', ') }}
        </td>
        <td>
          <a :href="`/rentals/${props.detail.id}/editnewrentals/availabilityedit/{availID}`" class="btn btn-primary" role="button">Edit</a>
          <a :href="`/rentals/${props.detail.id}/editnewrentals/availability/{availID}`" class="btn btn-danger" role="button">Delete</a>
        </td>
      </tr>
    </tbody>
  </table>
  <a :href="`/rentals/${props.detailsId}/editnewrentals/availabilitycreate`" class="btn btn-success" role="button">Create a new Availability</a>
</div>

</AppLayout>
</template>
  