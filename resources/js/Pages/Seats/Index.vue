
<template>
    <div class="container">
        <div class="col-md-12">
            <h1>Seats for Event</h1>
        </div>
        <div class="row" v-for="seat in seats" :key="seat.id">
            <div class="col-md-2">
                <button @click="decrementQuantity(seat.id)">-</button>
                <input type="number" v-model="seat.quantity" min="0" max="100">
                <button @click="incrementQuantity(seat.id)">+</button>
            </div>
            <div class="col-md-10">
                <h2>{{ seat.name }}</h2>
<div class="mt-3">
    <div class="btn-group" role="group" aria-label="Prices">
        <button v-for="(price, index) in seat.prices" :key="price.id" type="button" class="btn btn-outline-secondary" :class="{ active: price.checked }" @click="togglePrice(price)">
            {{ price.name }} - {{ price.price }}
        </button>
    </div>
</div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive } from 'vue'

export default {
    props: {
        seats: {
            type: Array,
            required: true,
        },
    },

    setup(props) {
        const state = reactive({
            seats: props.seats.map((seat) => {
                seat.quantity = 0
                seat.checked = false
                return seat
            }),
        })

        const incrementQuantity = (index) => {
            for (let i = 0; i < state.seats.length; i++) {
                if (state.seats[i].id == index && state.seats[i].quantity > 0) {
                    state.seats[i].quantity++
                }
            }
        }

        const decrementQuantity = (index) => {
            for (let i = 0; i < state.seats.length; i++) {
                if (state.seats[i].id == index && state.seats[i].quantity > 0) {
                    state.seats[i].quantity--
                }
            }
        }

        return {
            state,
            incrementQuantity,
            decrementQuantity,
        }
    },
}
</script>