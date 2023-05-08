<script setup>
import { reactive } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue';
 import ProductLayout from '@/Layouts/ProductLayout.vue';
 
const props = defineProps({
    detailID: {
        type: Number,
        required: true
    },
    durations: {
        type: Array,
        required: true
    },
	detail: {
      type: Object,
      required: true
},
})

function addDuration() {
    state.durations = state.durations || [];
    state.durations.push({
        id: Date.now(),
        name: '',
        days: 0,
        hours: 0,
        minutes: 0,
        rental_product_id: props.detail.id,
        has_changes: false,
        is_new: true,
        errors: [],
    })
}

function saveDuration(durationId) {
    let duration = state.durations.filter((duration) => (duration.id == durationId))
    if (duration.length != 1) {
        return
    }

    duration = duration[0]

    let method = 'PUT'
    let url = '/rentals/' + props.detail.id + '/editnewrentals/durations/' + duration.id

    if (duration.is_new) {
        method = 'POST'
        url = '/rentals/' + props.detail.id + '/editnewrentals/durations'
    }

    var status = 0
    fetch(url, {
        method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf"]').content,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify(duration),
    })
    .then((response) => {
        if (response.status != 200) {
            throw response
        }

        return response.json()
    })
    .then((data) => {
        if (data.durations) {
            state.durations = data.durations
        }
    })
    .catch((response) => {
        return response.json().then((data) => {
            duration.errors = data.errors
        });
    })
}

function deleteDuration(durationId) {
    let duration = state.durations.filter((duration) => (duration.id == durationId))
    if (duration.length != 1) {
        return
    }

    duration = duration[0]

    let method = 'DELETE'
    let url = '/rentals/' + props.detail.id + '/editnewrentals/durations/' + duration.id

    fetch(url, {
        method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf"]').content,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify(duration),
    })
    .then((response) => {
        if (response.status != 200) {
            throw response
        }

        return response.json()
    })
    .then((data) => {
        if (data.durations) {
            state.durations = data.durations
        }
    })
    .catch((response) => {
        return response.json().then((data) => {
            duration.errors = data.errors
        });
    })
}

const state = reactive({
    durations: props.durations,
})
</script>

<template>
<AppLayout title="Durations">
    <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Durations
            </h2>
    </template>
	<ProductLayout v-if="detail" :detail="detail">
      		
    </ProductLayout>
    <div class="table-responsive">
  <table class="table table-bordered table-hover">
    <tbody>
      <tr v-for="duration in state.durations" :key="duration.id">
        <td>
          <label>Name:</label>
          <input type="text" class="form-control" v-model="duration.name">
          <div v-if="duration.errors.name" class="invalid-feedback">
            <div v-for="(item, key) in duration.errors.name" :key="key">{{ item }}</div>
          </div>
        </td>
        <td>
          <label>Days:</label>
          <input type="text" class="form-control" v-model="duration.days">
          <div v-if="duration.errors.days" class="invalid-feedback">
            <div v-for="(item, key) in duration.errors.days" :key="key">{{ item }}</div>
          </div>
        </td>
        <td>
          <label>Hours:</label>
          <input type="text" class="form-control" v-model="duration.hours">
          <div v-if="duration.errors.hours" class="invalid-feedback">
            <div v-for="(item, key) in duration.errors.hours" :key="key">{{ item }}</div>
          </div>
        </td>
        <td>
          <label>Minutes:</label>
          <input type="text" class="form-control" v-model="duration.minutes">
          <input type="hidden" v-model="duration.rental_product_id">
          <div v-if="duration.errors.minutes" class="invalid-feedback">
            <div v-for="(item, key) in duration.errors.minutes" :key="key">{{ item }}</div>
          </div>
        </td>
        <td>
          <button class="btn btn-primary" @click="saveDuration(duration.id)">Save</button>
          <button class="btn btn-danger" @click="deleteDuration(duration.id)">Delete</button>
        </td>
      </tr>
    </tbody>
  </table>
  <button class="btn btn-success" @click="addDuration">Add a duration</button>
</div>

</AppLayout>
</template>