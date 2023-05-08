  <script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import ProductLayout from '@/Layouts/ProductLayout.vue';

  const props = defineProps({
    detail: {
      type: Object,
      required: true
    }
  });
  
   
  </script>


<template>
<AppLayout title="Details">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Edit Details
      </h2>
    </template>
<div>Select options to add to this product:</div>
 	<ProductLayout v-if="detail" :detail="detail">
      		
    	</ProductLayout>
</AppLayout>
</template>



  
  