
<script setup>
import { reactive } from 'vue';
import { defineProps, nextTick } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import ProductLayout from '@/Layouts/ProductLayout.vue';

const props = defineProps({
    equipmenttypes: {
        type:Array,
        required:true
    },
    name: {
        type: String,
        required: true
    },
    description: {
        type: String,
        required: true
    },
    minAmount: {
        type: Number,
        default: null
    },
    max_amount: {
        type: Number,
        default: null
    },
    require_min: {
        type: [Boolean, Number],
        required: true
    },
    widget_image: {
       type: String,
        default: null
    },
    widget_display: {
        type: Boolean,
        required: true
    },
	  assets: {
        type: Array,
        required: true
    },
    detail: {
      type: Object,
      required: true
},

})

function addEquipmentType() {
	state.equipmenttypes = state.equipmenttypes || [];
    state.equipmenttypes.push({
        id: Date.now(),
        name: '',
		description: '',
		min_amount: '',
		max_amount: '',
		require_min: 0,
 		widget_image: '', // add widget_image prop with an initial value
        widget_display: false, // add widget_display prop with an initial value
		rental_product_id: props.detail.id, 
		assetID: '',
        has_changes: false,
        is_new: true,
        errors: [],
    })
}

function saveEquipmentType(equipmenttypeId) {
    let equipmenttype = state.equipmenttypes.filter((equipmenttype) => (equipmenttype.id == equipmenttypeId))
    if (equipmenttype.length != 1) {
        return
    }

    equipmenttype = equipmenttype[0]

    let method = 'PUT'
    let url = '/rentals/' + props.detail.id + '/editnewrentals/equipmenttypes/' + equipmenttype.id

    if (equipmenttype.is_new) {
        method = 'POST'
        url = '/rentals/' + props.detail.id + '/editnewrentals/equipmenttypes'
    }

    var status = 0
    fetch(url, {
        method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf"]').content,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify(equipmenttype),
    })
    .then((response) => {
        if (response.status != 200) {
            throw response
        }

        return response.json()
    })
    .then((data) => {
  if (data.equipmenttypes) {
    this.updateEquipmentTypes(data.equipmenttypes);
           /// state.equipmenttype.id = data.newId;
           /// state.equipmenttypes.is_new = false;
        }
    })
    .catch((response) => {
        return response.json().then((data) => {
            equipmenttype.errors = data.errors
           
        });
    })
}

function deleteEquipmentType(equipmenttypeId) {
    let equipmenttype = state.equipmenttypes.filter((equipmenttype) => (equipmenttype.id == equipmenttypeId))
    if (equipmenttype.length != 1) {
        return
    }

    equipmenttype = equipmenttype[0]

    let method = 'DELETE'
    let url = '/rentals/' + props.detail.id + '/editnewrentals/equipmenttypes/' + equipmenttype.id

    fetch(url, {
        method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf"]').content,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify(equipmenttype),
    })
    .then((response) => {
        if (response.status != 200) {
            throw response
        }

        return response.json()
    })
    .then((data) => {
    if (data.equipmenttypes) {
        state.equipmenttypes = data.equipmenttypes;
    }
})
    .catch((response) => {
        return response.json().then((data) => {
            equipmenttype.errors = data.errors
        });
    })

}


  

const state = reactive({
    equipmenttypes: props.equipmenttypes,
})



</script>

<template>
<AppLayout title="Equipment type">
    <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Equipment Type
            </h2>
    </template>
	<ProductLayout v-if="detail" :detail="detail">
      		
    </ProductLayout>
<div>
  <table class="table table-striped table-bordered">
    <tbody>
      <tr v-for="equipmenttype in state.equipmenttypes" :key="equipmenttype.id">
        <td>
          <div class="form-group">
            <label>Name:</label>
            <input type="text" class="form-control" v-model="equipmenttype.name">
            <div v-if="equipmenttype.errors.name" class="text-danger">
              <div v-for="(item, key) in equipmenttype.errors.name" :key="key">{{ item }}</div>
            </div>
          </div>
        </td>
        <td>
          <div class="form-group">
            <label>Description:</label>
            <input type="text" class="form-control" v-model="equipmenttype.description">
            <div v-if="equipmenttype.errors.description" class="text-danger">
              <div v-for="(item, key) in equipmenttype.errors.description" :key="key">{{ item }}</div>
            </div>
          </div>
        </td>
        <td>
          <div class="form-group">
            <label>Asset:</label>
            <select class="form-control" v-model="equipmenttype.assetID">
              <option value="">Select an asset</option>
              <option v-for="asset in assets" :key="asset.id" :value="asset.id" :selected="asset.id === equipmenttype.assetID">{{ asset.name }}</option>
            </select>
            <div v-if="equipmenttype && equipmenttype.errors && equipmenttype.errors.assetid" class="text-danger">
              <div v-for="(error, key) in equipmenttype.errors.assetid" :key="key">{{ error }}</div>
            </div>
          </div>
        </td>
        <td>
          <div class="form-group">
            <label>Min Amount:</label>
            <input type="number" class="form-control" v-model="equipmenttype.min_amount" min="0">
            <div v-if="equipmenttype.errors['min_amount']" class="text-danger">
              <div v-for="(item, key) in equipmenttype.errors['min_amount']" :key="key">{{ item }}</div>
            </div>
          </div>
        </td>
        <td>
          <div class="form-group">
            <label>Max Amount:</label>
            <input type="number" class="form-control" v-model="equipmenttype.max_amount" min="0">
            <div v-if="equipmenttype.errors['max_amount']" class="text-danger">
              <div v-for="(item, key) in equipmenttype.errors['max_amount']" :key="key">{{ item }}</div>
            </div>
          </div>
        </td>
        <td>
          <div class="form-group">
            <label>Require Min:</label>
            <input type="checkbox" v-model="equipmenttype.require_min">
            <div v-if="equipmenttype.errors['require_min']" class="text-danger">
              <div v-for="(item, key) in equipmenttype.errors['require_min']" :key="key">{{ item }}</div>
            </div>
          </div>
        </td>
       <td>
  <div class="form-group">
    <label>Widget Image:</label>
    <div>
      <div v-if="equipmenttype.widget_image">
        <img :src="equipmenttype.widget_image" class="selected-image" />
      </div>
      <input type="file" @change="handleFileSelect" accept="image/*" />
    </div>
    <div v-if="equipmenttype.errors['widget_image']" class="text-danger">
      <div v-for="(item, key) in equipmenttype.errors['widget_image']" :key="key">{{ item }}</div>
    </div>
  </div>
</td>
<td>
  <label class="form-label">Widget Display:</label> 
  <div class="form-check">
    <input class="form-check-input" type="checkbox" v-model="equipmenttype.widget_display">
    <input type="hidden" v-model="equipmenttype.rental_product_id">
    <div v-if="equipmenttype.errors['widget_display']" class="invalid-feedback">
      <div v-for="(item, key) in equipmenttype.errors['widget_display']" :key="key">{{ item }}</div>
    </div>
  </div>
</td>
<td>
  <button class="btn btn-primary" @click="saveEquipmentType(equipmenttype.id)">Save</button>
  <button class="btn btn-danger" @click="deleteEquipmentType(equipmenttype.id)">Delete</button>
</td>

               </tr>
            </tbody>
        </table>
        <button class="btn btn-primary" @click="addEquipmentType">Add Equipment Type</button>
    </div>
</AppLayout>
</template>
<script>
import { defineProps, nextTick } from 'vue';

export default {
  props: {
    equipmenttypes: {
      type: Array,
      required: true,
    },
  },
  methods: {
    handleFileSelect(event) {
      const file = event.target.files[0];
      const reader = new FileReader();
      reader.onload = () => {
        this.equipmenttype.widget_image = reader.result;
      };
      reader.readAsDataURL(file);
    },

    updateEquipmentTypes(newEquipmentTypes) {
      // Loop through each equipmenttype and set the checked value of the checkboxes
      newEquipmentTypes.forEach((equipmenttype) => {
        equipmenttype.require_min = !!equipmenttype.require_min;
        equipmenttype.widget_display = !!equipmenttype.widget_display;
      });

      // Replace the old equipmenttypes array with the new one
      this.equipmenttypes.splice(0, this.equipmenttypes.length, ...newEquipmentTypes);
    },
  },

  mounted() {
    // Use nextTick to update the checkboxes after the DOM has been updated
    nextTick(() => {
      this.updateEquipmentTypes(this.equipmenttypes);
    });
  },
};
</script>


