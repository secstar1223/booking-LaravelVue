<script setup>
import { reactive } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    detailsId: {
        type: Number,
        required: true
    },
    durations: {
        type: Array,
        required: true
    },
	equipmenttype: {
        type: Array,
        required: true
    }
})


function savePrice(priceId) {
    let price = state.price.filter((price) => (price.id == priceId))
    if (price.length != 1) {
        return
    }

    price = price[0]

    let method = 'PUT'
    let url = '/rentals/' + props.detailsId + '/price/' + price.id

    if (price.is_new) {
        method = 'POST'
        url = '/rentals/' + props.detailsId + '/price'
    }

    var status = 0
    fetch(url, {
        method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf"]').content,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify(price),
    })
    .then((response) => {
        if (response.status != 200) {
            throw response
        }

        return response.json()
    })
    .then((data) => {
        if (data.price) {
            state.price = data.price
        }
    })
    .catch((response) => {
        return response.json().then((data) => {
            price.errors = data.errors
        });
    })
}

const state = reactive({
    price: props.price,
})
</script>

<template>
<AppLayout title="Prices">
    <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Prices
            </h2>
    </template>
 <div class="overflow-x-auto">
      <table class="table-auto">
        <thead>
          <tr>
            <th></th> <!-- Empty header for spacing -->
            <template v-for="equipmenttype in props.equipmenttype">
              <th>{{ equipmenttype.name }}</th>
            </template>
          </tr>
        </thead>

        <tbody>
          <tr v-for="duration in props.durations" :key="duration.id">
            <td>{{ duration.name }}</td>
            <template v-for="equipmenttype in props.equipmenttype">
              <td>
                <div>
                  <label>Price:</label>
                  <input type="text" v-model="duration.prices[equipmenttype.id].price">
                  <div v-if="duration.prices[equipmenttype.id].errors.price">
                    <div v-for="(item, key) in duration.prices[equipmenttype.id].errors.price" :key="key">{{ item }}</div>
                  </div>
                </div>

                <div>
                  <label>Deposit:</label>
                  <input type="text" v-model="duration.prices[equipmenttype.id].deposit">
                  <div v-if="duration.prices[equipmenttype.id].errors.deposit">
                    <div v-for="(item, key) in duration.prices[equipmenttype.id].errors.deposit" :key="key">{{ item }}</div>
                  </div>
                </div>

                <button @click="savePrice(duration.prices[equipmenttype.id].id)">Save</button>
              </td>
            </template>
          </tr>
        </tbody>
      </table>
    </div>
</AppLayout>
</template>