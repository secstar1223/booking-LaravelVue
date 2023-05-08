<script setup>
import { reactive } from 'vue'
import { computed } from 'vue';
import { defineProps } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import ProductLayout from '@/Layouts/ProductLayout.vue';

const props = defineProps({
    durations: {
        type: Array,
        required: true
    },
	equipmenttype: {
        type: Array,
        required: true
    },
    price: {
        type: Array,
        required: true
    },
	    detail: {
      type: Object,
      required: true
},

})


function saveAllPrices() {
  state.price.forEach((price) => {
    savePrice(price);
  });
}

function savePrice(price) {
  let method = 'PUT';
  let url = '/rentals/' + props.detail.id + '/editnewrentals/prices/' + price.id;

  if (price.is_new) {
    method = 'POST';
    url = '/rentals/' + props.detail.id + '/editnewrentals/prices';
  }

  var status = 0;
  fetch(url, {
    method,
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf"]').content,
      'Content-Type': 'application/json',
      Accept: 'application/json',
    },
    body: JSON.stringify(price),
  })
    .then((response) => {
      if (response.status != 200) {
        throw response;
      }

      return response.json();
    })
   .then((data) => {
  if (data.price) {
    data.price.forEach((newPrice) => {
      const index = state.price.findIndex(
  (price) =>
    price.equipment_id === newPrice.equipment_id &&
    price.duration_id === newPrice.duration_id &&
    price.rentals_product_id === newPrice.rentals_product_id
);
      if (index !== -1) {
        const price = state.price[index];
        Object.assign(price, newPrice);
        price.is_new = false; // set is_new to false for the updated price
      }
    });
  }
})

    .catch((response) => {
      return response.json().then((data) => {
        price.errors = data.errors;
      });
    });
}

const state = reactive({
    price: props.price,
})

const getEquipmentTypeName = (equipmentId) => {
  const equipmentType = props.equipmenttype.find(type => type.id === equipmentId);
  return equipmentType ? equipmentType.name : 'Unknown';
}

const getPrice = (durationId, equipmentId) => {
  let price = state.price.find(p => p.duration_id === durationId && p.equipment_id === equipmentId);
  
  if (!price) {
    const now = new Date().getTime();
    price = { 
      deposit: 0, 
      total: 1, 
      errors: {}, 
      is_new: true, 
      id: now, 
      equipment_id: equipmentId,
      duration_id: durationId,
      rental_product_id: props.detail.id
    };
    state.price.push(price);
	
  }
  
  return price;
}




const computedDurations = computed(() => {
  return props.durations.map(duration => {
    const computedPrices = {};
    props.equipmenttype.forEach(equipmenttype => {
      const price = getPrice(duration.id, equipmenttype.id);
      computedPrices[equipmenttype.id] = price;
    });

    return {
      ...duration,
      prices: reactive(computedPrices),
    };
  });
});
</script>

<template>
<AppLayout title="Prices">
    <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Prices
            </h2>
    </template>
		<ProductLayout v-if="detail" :detail="detail">
      		
    </ProductLayout>
  <!-- ********PRICE********
    <div>Prices: {{ price }}</div>
    ********DETAIL********
    <div>Detail: {{ detail }}</div>
    ********DURATIONS********
    <div>Durations: {{ durations }}</div>
    ********EQUIPMENTTYPE********
    <div>Equipmenttype: {{ equipmenttype }}</div>-->

 <div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th></th>
        <template v-for="equipmenttype in props.equipmenttype">
          <th>{{ equipmenttype.name }}</th>
        </template>
      </tr>
    </thead>
    <tbody>
      <template v-for="duration in computedDurations" :key="duration.id">
        <tr>
          <td>{{ duration.name }}</td>
          <template v-for="equipmenttype in props.equipmenttype" :key="equipmenttype.id">
            <td>
              <div>
                <label>Price:</label>
                <input type="number" class="form-control" v-model="duration.prices[equipmenttype.id].total">
                <div v-if="duration.prices[equipmenttype.id].errors.total">
                  <div v-for="(item, key) in duration.prices[equipmenttype.id].errors.total" :key="key">{{ item }}</div>
                </div>
              </div>

              <div>
                <label>Deposit:</label>
                <input type="number" class="form-control" v-model="duration.prices[equipmenttype.id].deposit">
                <div v-if="duration.prices[equipmenttype.id].errors.deposit">
                  <div v-for="(item, key) in duration.prices[equipmenttype.id].errors.deposit" :key="key">{{ item }}</div>
                </div>
              </div>
            </td>
          </template>
        </tr>
      </template>
      <tr>
        <td>
          <button class="btn btn-primary" @click="saveAllPrices()">Save All</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>


</AppLayout>
</template>