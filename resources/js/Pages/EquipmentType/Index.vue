
<script setup>
import { reactive } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    detailId: {
        type: Number,
        required: true
    },
    equipmenttype: {
        type: Array,
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
    maxAmount: {
        type: Number,
        default: null
    },
    requireMin: {
        type: Boolean,
        required: true
    },
    widgetImage: {
        type: String,
        default: null
    },
    widgetDisplay: {
        type: Boolean,
        required: true
    },
    assets: {
        type: Array,
        required: true
    }
})


function addEquipmentType() {
    state.equipmenttype.push({
        id: Date.now(),
        name: '',
		description: '',
		minamount: '',
		maxamount: '',
		requiremin: '',
		widgetimage: '',
		widgetdisplay: '',
		detailId: detail.id,
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
    let url = '/rentals/' + props.detailId + '/equipmenttypes/' + equipmenttype.id

    if (equipmenttype.is_new) {
        method = 'POST'
        url = '/rentals/' + props.detailId + '/equipmenttypes'
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
        if (data.equipmenttype) {
            state.equipmenttypes = data.equipmenttypes
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
    let url = '/rentals/' + props.detailId + '/equipmenttypes/' + equipmenttype.id

    fetch(url, {
        method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf"]').content,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
    })
    .then((response) => {
        if (response.status != 200) {
            throw response
        }

        return response.json()
    })
    .then((data) => {
        if (data.equipmenttypes) {
            state.equipmenttypes = data.equipmenttypes
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
    <div>
        <table style="width:100%;">
            <tbody>
                <tr v-for="equipmenttype in state.equipmenttypes" :key="equipmenttype.id">
				  <td>
					<label>Name:</label>
					<input type="text" v-model="equipmenttype.name">
					<div v-if="equipmenttype.errors.name">
					  <div v-for="(item, key) in equipmenttype.errors.name" :key="key">{{ item }}</div>
					</div>
				  </td>
				  <td>
					<label>Asset:</label>
					<select v-model="equipmentType.asset_id">
						<option value="">Select an asset</option>
						<option v-for="asset in assets" :key="asset.id" :value="asset.id">{{ asset.name }}</option>
					</select>
					<div v-if="equipmentType.errors.asset_id">
						<div v-for="(error, key) in equipmentType.errors.asset_id" :key="key">{{ error }}</div>
					</div>
				  </td>
				  <td>
					<label>Description:</label>
					<input type="text" v-model="equipmenttype.description">
					<div v-if="equipmenttype.errors.description">
					  <div v-for="(item, key) in equipmenttype.errors.description" :key="key">{{ item }}</div>
					</div>
				  </td>
				  <td>
					<label>Min Amount:</label>
					<input type="number" v-model="equipmenttype.minamount" min="0">
					<div v-if="equipmenttype.errors['min-amount']">
					  <div v-for="(item, key) in equipmenttype.errors['min-amount']" :key="key">{{ item }}</div>
					</div>
				  </td>
				  <td>
					<label>Max Amount:</label>
					<input type="number" v-model="equipmenttype.maxamount" min="0">
					<div v-if="equipmenttype.errors['max-amount']">
					  <div v-for="(item, key) in equipmenttype.errors['max-amount']" :key="key">{{ item }}</div>
					</div>
				  </td>
				  <td>
					<label>Require Min:</label>
					<input type="checkbox" v-model="equipmenttype.requiremin">
					<div v-if="equipmenttype.errors['require-min']">
					  <div v-for="(item, key) in equipmenttype.errors['require-min']" :key="key">{{ item }}</div>
					</div>
				  </td>
				  <td>
					<label>Widget Image:</label>
					<input type="text" v-model="equipmenttype.widgetimage">
					<div v-if="equipmenttype.errors['widget-image']">
					  <div v-for="(item, key) in equipmenttype.errors['widget-image']" :key="key">{{ item }}</div>
					</div>
				  </td>
				  <td>
					<label>Widget Display:</label>
					<input type="checkbox" v-model="equipmenttype.widgetdisplay">
					<div v-if="equipmenttype.errors['widget-display']">
					  <div v-for="(item, key) in equipmenttype.errors['widget-display']" :key="key">{{ item }}</div>
					</div>
				  </td>
                    <td>
                        <button @click="saveEquipmentType(equipmenttype.id)">Save</button>
                        <button @click="deleteEquipmentType(equipmenttype.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button @click="addEquipmentType">Add Equipment Type</button>
    </div>
</AppLayout>
</template>