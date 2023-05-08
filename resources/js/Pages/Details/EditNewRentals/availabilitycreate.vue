<script setup>

import { reactive } from 'vue'
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    rentalProductId: {
        type: Number,
        required: true
    },
    durations: {
        type: Array,
        required: true
    },
    detail: {
        type: Array,
        required: true
    }

})

const state = reactive({
    daily: true,
    mon: true,
    tue: true,
    wed: true,
    thu: true,
    fri: true,
    sat: true,
    sun: true,
    times: 'repeats',
    starts_every: 15,
	start_time: 0,
	end_time: 3600000,
    all_durations: false,
    durations: {},

    time_specific: 0,
	starts_specific: [],
    errors: [],
})

props.durations.forEach((duration) => {
    state.durations[duration.id] = false;
})

function addSpecificTime() {
    state.starts_specific.push({
        id: Date.now(),
        time: Math.floor(state.time_specific/1000)
    })
}

function removeSpecificTime(specific_id) {
    state.starts_specific = state.starts_specific.filter((specific) => (specific.id != specific_id))
}

function displayTime(timestamp) {
    let pad = (value) => (value < 10 ? '0' + value : value)
    let hours = Math.floor(timestamp / 60 / 60)
    let minutes = Math.floor((timestamp - hours * 60 * 60) / 60)
    return (hours > 12 ? hours - 12 : (hours == 0 ? 12 : hours )) + ':' + pad(minutes) + (hours > 11 && hours != 24 ? ' pm' : ' am')
}

function checkDurations(event) {
    let duration_id = parseInt(event.target.id.substr(9))
    state.durations[duration_id] = !state.durations[duration_id];

    let all_true = true
    props.durations.forEach((duration) => {
        if (true != state.durations[duration.id]) {
            all_true = false
        }
    })

    state.all_durations = all_true
}

function toggleDurations() {
    state.all_durations = !state.all_durations;
    props.durations.forEach((duration) => {
        state.durations[duration.id] = state.all_durations;
    })
}

function checkDaily(event) {
    state[event.target.id] = !state[event.target.id]
    if (state.mon != state.tue || state.mon != state.wed || state.mon != state.thu || state.mon != state.fri || state.mon != state.sat || state.mon != state.sun) {
        state.daily = false
    } else {
        state.daily = true
    }
}

function toggleDaily() {
    state.mon = state.tue = state.wed = state.thu = state.fri = state.sat = state.sun = !state.daily
}

function handleSubmit() {
    let method = 'POST'
    let url = '/rentals/' + props.detail.id + '/editnewrentals/availabilityindex'

    let availability = {
        mon: state.mon,
        tue: state.tue,
        wed: state.wed,
        thu: state.thu,
        fri: state.fri,
        sat: state.sat,
        sun: state.sun,
        times: state.times,
        starts_every: state.starts_every*60,
        start_time: Math.floor(state.start_time/1000),
        end_time: Math.floor(state.end_time/1000),
        starts_specific: state.starts_specific.map((el) => el.time),
        durations: Object.keys(state.durations).filter((key) => state.durations[key]).map((id) => parseInt(id)),
    }

    console.log(Object.keys(state.durations).filter((key) => state.durations[key]))
    //availability.durations

    fetch(url, {
        method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf"]').content,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify(availability)
    })
    .then((response) => {
        if (response.status != 200) {
            throw response
        }

        return response.json()
    })
    .then((data) => {
        if (data.errors) {
            state.errors = data.errors
            return
        }
        window.location = '/rentals/' + props.detail.id + '/editnewrentals/availabilityindex'
    })
    .catch((response) => {
        return response.json().then((data) => {
            state.errors = data.errors
        });
    })
}
</script>
<style>
.cDaySelector {
    width: 100%;
}

.cDaySelector th {
    text-align: center;
    width: 12.5%;
}

.cDaySelector td {
    text-align: center;
}

.cDaySelector .eDaily {
    border-right: 1px solid #000;
}
.vc-bordered {
    border: none;
}
.vc-time-picker {
    padding: 0;
}
.vc-time-select-group {
    padding: 4px 8px;
}
.vc-time-picker select {
    border: none;
}
</style>
<template>
<AppLayout title="Availability">
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
					Create an Availability
			</h2>
		</template>
		<div class="container">
            <br>
            <div class="card">
                <div class="card-body m-2">
			<form @submit.prevent="handleSubmit()">
                <div class="row">
                    <div class="col-12 mb-4">
                        <label class="form-label">Scheduled days</label>
                        <table class="cDaySelector">
                            <thead><tr>
                                <th class="eDaily"><label class="form-check-label" for="daily">Daily</label></th>
                                <th><label class="form-check-label" for="mon">Mon</label></th>
                                <th><label class="form-check-label" for="tue">Tue</label></th>
                                <th><label class="form-check-label" for="wed">Wed</label></th>
                                <th><label class="form-check-label" for="thu">Thu</label></th>
                                <th><label class="form-check-label" for="fri">Fri</label></th>
                                <th><label class="form-check-label" for="sat">Sat</label></th>
                                <th><label class="form-check-label" for="sun">Sun</label></th>
                            </tr></thead>
                            <tbody><tr>
                                <td class="eDaily"><input v-model="state.daily" @click="toggleDaily" class="form-check-input" type="checkbox" id="daily"></td>
                                <td><input v-model="state.mon" @click="checkDaily" class="form-check-input" type="checkbox" id="mon"></td>
                                <td><input v-model="state.tue" @click="checkDaily" class="form-check-input" type="checkbox" id="tue"></td>
                                <td><input v-model="state.wed" @click="checkDaily" class="form-check-input" type="checkbox" id="wed"></td>
                                <td><input v-model="state.thu" @click="checkDaily" class="form-check-input" type="checkbox" id="thu"></td>
                                <td><input v-model="state.fri" @click="checkDaily" class="form-check-input" type="checkbox" id="fri"></td>
                                <td><input v-model="state.sat" @click="checkDaily" class="form-check-input" type="checkbox" id="sat"></td>
                                <td><input v-model="state.sun" @click="checkDaily" class="form-check-input" type="checkbox" id="sun"></td>
                            </tr></tbody>
                        </table>
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label">Scheduled times</label><br>
                        <div class="btn-group" role="group" aria-label="Does the availability repeat?">
                            <input type="radio" class="btn-check" v-model="state.times" value="repeats" id="repeats" autocomplete="off">
                            <label class="btn btn-outline-primary" for="repeats">Repeating Times</label>

                            <input type="radio" class="btn-check" v-model="state.times" value="specific" id="specific" autocomplete="off">
                            <label class="btn btn-outline-primary" for="specific">Specific Times</label>
                        </div>
                    </div>
                </div>

                <div class="row" v-if="state.times == 'repeats'">
                    <div class="col-4 mb-4">
<label class="form-label" for="starts_every">Rental starts every</label>
<div class="input-group">
  <select class="form-select" id="starts_every" v-model="state.starts_every" aria-label="Rental starts every x minutes." aria-describedby="minute_label">
    <option value="15">15 minutes</option>
    <option value="30">30 minutes</option>
    <option value="45">45 minutes</option>
    <option value="60">60 minutes</option>
  </select>
</div>



                    </div>
                    <div class="col-2 mb-4"></div>
                    <div class="col-3 mb-4">
                        <label class="form-label" for="start_time">From</label><br>
                        <v-date-picker mode="time" v-model="state.start_time" hide-time-header borderless timezone="utc" :time-accuracy="2" />
                    </div>

                    <div class="col-3 mb-4">
                        <label class="form-label" for="end_time">Until</label><br>
                        <v-date-picker mode="time" v-model="state.end_time" hide-time-header borderless timezone="utc" :time-accuracy="2" :model-config="{type:'number'}" />
                    </div>
                </div>

                <div class="row" v-if="state.times == 'specific'">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label">Start times</label>
                            </div>
                            <div class="col-auto mb-4">
                                <v-date-picker mode="time" v-model="state.time_specific" hide-time-header borderless timezone="utc" :time-accuracy="2" />
                            </div>
                            <div class="col-auto mb-4">
                                <button type="button" class="btn btn-primary" @click="addSpecificTime">Add start time</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <table v-if="state.starts_specific.length != 0">
                            <thead>
                                <tr><th>Starts at</th><th></th></tr>
                            </thead>
                            <tbody>
                                <tr v-for="specific in state.starts_specific" :key="specific.id">
                                    <td>{{ displayTime(specific.time) }}</td>
                                    <td><button type="submit" class="btn btn-danger ml-4 btn-sm" @click="removeSpecificTime(specific.id)"><i class="far fa-trash-alt"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-auto">
                        <label class="form-label">Applies to durations</label>
                    </div>
                    <div class="col-auto">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" v-model="state.all_durations" @click="toggleDurations" id="all-durations" autocomplete="off">
                            <label class="form-check-label" for="all-durations">All</label>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <span v-for="duration in props.durations" :key="duration.id">
                            <input type="checkbox" class="btn-check" v-model="state.durations[duration.id]" @click="checkDurations" :id="`duration-${duration.id}`" autocomplete="off">
                            <label class="btn btn-outline-primary m-1" :for="`duration-${duration.id}`">{{duration.name}}</label>
                        </span>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Create Availability</button>
                    </div>
                </div>

			</form>
                </div>
            </div>
		</div>
</AppLayout>
</template>

