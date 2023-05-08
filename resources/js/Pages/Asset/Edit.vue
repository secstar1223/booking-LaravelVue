<template>
<AppLayout title="Assets">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Edit Asset
      </h2>
    </template>
   <div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" v-model="form.name">
        <div v-if="form.errors.name" class="text-danger">{{ form.errors.name }}</div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="amount">Amount:</label>
        <input type="number" class="form-control" id="amount" v-model="form.amount">
        <div v-if="form.errors.amount" class="text-danger">{{ form.errors.amount }}</div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="resource-tracking">Resource Tracking:</label>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="resource-tracking" v-model="form.resource_tracking">
          <label class="form-check-label" for="resource-tracking">Track this asset</label>
        </div>
        <div v-if="form.errors.type" class="text-danger">{{ form.errors.type }}</div>
      </div>
    </div>
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary" @click="form.put(`/asset/${asset.id}`)">Update Asset</button>
    </div>
  </div>
</div>

</AppLayout>
</template>
  
  <script setup>
  import { useForm } from '@inertiajs/vue3'
  import AppLayout from '@/Layouts/AppLayout.vue';
  import { ref, onMounted, nextTick } from 'vue'
  
  const props = defineProps({
    asset: {
      type: Object,
      required: true
    }
  })
  
  const form = useForm({
    name: props.asset.name,
    resource_tracking: props.asset.resource_tracking,
    amount: props.asset.amount,
  })


  // Use a ref to track whether the checkbox has been rendered yet
  const checkboxRendered = ref(false)

  onMounted(() => {
    // Use nextTick to delay rendering the checkbox until after the component has been fully mounted
    nextTick(() => {
      // Check if the checkbox has been rendered yet
      if (!checkboxRendered.value) {
        // Set the value of the checkbox manually
        document.querySelector('input[type="checkbox"]').checked = form.resource_tracking === 1
      }
    })
  })

  // Set the value of the checkbox manually when it is rendered
  const onCheckboxRendered = () => {
    checkboxRendered.value = true
    document.querySelector('input[type="checkbox"]').checked = form.resource_tracking === 1
  }


  </script>