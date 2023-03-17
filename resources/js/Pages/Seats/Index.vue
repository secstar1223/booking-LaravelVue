
<template>
    <div class="container">
        <div class="col-md-12">
            <h1>{{language.seats_label}}</h1>
        </div>

    <div class="card card-body" v-for="seat in state.seats" :key="seat.id">
        <div class="row">
            <div class="col-md-2">
                <button @click="decrementQuantity(seat.id)">-</button>
                <input type="number" v-model="seat.quantity" @change="updateTotal" min="0" :max="seat.max_capacity">
                <button @click="incrementQuantity(seat.id)">+</button>
            </div>
            <div class="col-md-10">
                <h2>{{ seat.name }}</h2>
            </div>
            <div class="col-md-2">
                <div class="mt-3">
                    <h3>{{language.duration_label}}</h3>
                </div>
            </div>
            <div class="col-md-10">
                <div class="mt-3">
                    <div >
                        <button v-for="(price, index) in seat.prices" :key="price.id" type="button" class="btn btn-outline-secondary" :class="{ active: price.checked }" @click="togglePrice(price)">
                            {{ price.name }} - {{ displayPrice(price) }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <VDatePicker mode="date" borderless columns="2" :modelValue="state.selected_date" @update:modelValue="updateDate" :min-date="new Date()" :disabled-dates="state.disabled_dates" />
        </div>
        <div class="col-md-4">
            {{ language.time_label }}
            <select>
                <option v-for="(time) in state.times" :value="time">{{time}}</option>
            </select>
            <br>
            {{ language.total_label }}{{ displayPrice(state.total) }}<br>
            <br>
            <button type="button" class="btn btn-primary" @click="bookNow()">
                {{ language.book_now }}
            </button>
        </div>
    </div>
</div>
</template>

<script>
import { reactive, ref } from 'vue'

export default {
    props: {
        seats: {
            type: Array,
            required: true,
        },
        language: {
            type: Array,
            required: true,
        },
        schedule: {
            type: Array,
            required: true,
        },
        schedule_exceptions: {
            type: Array,
            required: true,
        },
        options: {
            type: Array,
            required: true,
        },
    },

    setup(props) {
        const state = reactive({
            seats: props.seats,
            selected_date: new Date(),
            disabled_dates: [{
                repeat: {
                    every: [props.schedule.repeats_every, 'days'],
                    weekdays: props.schedule.days.filter((value) => value.length === 0).map((value, key) => key + 1),
                }
            }],
            can_book: false,
            total: { 
                price: 0,
                symbol: '$'
            },
            times: ['Select a date'],
        })

        const bookNow = () => {
            
        }

        const updateDate = (new_date) => {
            console.log(new_date)
            state.selected_date = new_date
            return state.selected_date
        }

        const updateTotal = () => {
            let total_duration = 0
            let total_price = 0

            for (let i = 0; i < state.seats.length; i++) {
                if (state.seats[i].quantity > state.seats[i].max_capacity) {
                    state.seats[i].quantity = state.seats[i].max_capacity
                }

                if (state.seats[i].quantity > 0) {
                    for (let j = 0; j < state.seats[i].prices.length; j++) {
                        if (state.seats[i].prices[j].checked) {
                            total_price += state.seats[i].prices[j].price * state.seats[i].quantity

                            if (state.seats[i].prices[j].duration > total_duration) {
                                total_duration = state.seats[i].prices[j].duration
                            }
                        }
                    }
                }
            }

            state.total.price = total_price
            console.log(state.total)
        }

        const displayPrice = (price) => {
            return price.symbol + (price.price/100).toFixed(2)
        }

        const incrementQuantity = (index) => {
            for (let i = 0; i < state.seats.length; i++) {
                if (state.seats[i].id == index && state.seats[i].quantity < state.seats[i].max_capacity) {
                    state.seats[i].quantity++
                }
            }
            updateTotal()
        }

        const decrementQuantity = (index) => {
            for (let i = 0; i < state.seats.length; i++) {
                if (state.seats[i].id == index && state.seats[i].quantity > 0) {
                    state.seats[i].quantity--
                }
            }
            updateTotal()
        }

        const togglePrice = (price) => {
            for (let i = 0; i < state.seats.length; i++) {
                for (let j = 0; j < state.seats[i].prices.length; j++) {
                    if (state.seats[i].prices[j].duration == price.duration) {
                        state.seats[i].prices[j].checked = true
                    } else {
                        state.seats[i].prices[j].checked = false
                    }
                }
            }
            updateTotal()
        }

        return {
            state,
            bookNow,
            updateDate,
            updateTotal,
            displayPrice,
            incrementQuantity,
            decrementQuantity,
            togglePrice,
        }
    },
}
</script>