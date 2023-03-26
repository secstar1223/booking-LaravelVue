
<template>
    <div class="container">
        <div class="col-md-12">
            <h1>{{language.seats_label}}</h1>
        </div>
        <div v-if="state.error_message" class="col-md-12">
            <div class="alert alert-danger" role="alert">
                {{ state.error_message }}
            </div>
        </div>
    <div class="card card-body" v-for="seat in state.seats" :key="seat.id">
        <div class="row">
            <div v-if="seat.error_message" class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    {{ seat.error_message }}
                </div>
            </div>
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
                        <button v-for="(price, index) in seat.prices" :key="price.id" type="button" class="btn btn-outline-secondary" :class="{ active: price.checked }" @click="togglePrice(seat, price)">
                            {{ price.name }} - {{ displayPrice(price) }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <VDatePicker mode="date" borderless expanded columns="2" :attributes="state.attributes" :timezone="state.timezone" :locale="{ id: 'en', firstDayOfWeek: 2, masks: { weekdays: 'WW' } }" is-required :modelValue="state.selected_date" @update:modelValue="updateDate" :min-date="new Date()" :disabled-dates="state.disabled_dates" />
        </div>
        <div class="col-md-4">
            {{ language.time_label }}
            <select>
                <option v-for="(time) in state.times" :key="time" :value="time">{{time}}</option>
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
import { reactive } from 'vue'

export default {
    props: {
        event_id: {
            type: Number,
            required: true,
        },
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
                start: new Date(2022),
                repeat: {
                    every: 'week',
                    weekdays: props.schedule.days.map((value, key) => (value.length === 0 ? key+1 : 0 )).filter((value) => value !== 0),
                }
            }],
            can_book: false,
            has_errors: false,
            total: {
                price: 0,
                symbol: '$'
            },
            total_duration: 0,
            times: [],
            timezone: 'utc',
            attributes: (typeof props.schedule.messages == 'object' ? Object.keys(props.schedule.messages) : props.schedule.messages.map((value, key) => key)).map((key) => ({
                key: 'message' + key, 
                popover: {
                    label: props.schedule.messages[key],
                },
                dates: {
                    start: new Date(2022),
                    repeat: {
                        every: 'week',
                        weekdays: parseInt(key)+1,
                    }
                }
            })),
/*            [
                {
                    key: 3,
                    //content: 'green',
                    //bar: 'green',
                    popover: {
                        label: "Closed Tuesdays & Wednesdays",
                    },
                    dates: {
                        start: new Date(2022),
                        repeat: {
                            every: 'week',
                            weekdays: props.schedule.days.map((value, key) => (value.length === 0 ? key+1 : 0 )).filter((value) => value !== 0),
                        }
                    }
                }
            ],*/
        })

        //console.log(state.attributes)

        const checkHasErrors = () => {
            let has_errors = false
            let has_seats_ordered = false
            state.error_message = ''
            for (let i = 0; i < state.seats.length; i++) {
                state.seats[i].error_message = ''
                if (state.seats[i].quantity > 0) {
                    if (state.seats[i].quantity < state.seats[i].minimum_order) {
                        has_errors = true
                        state.seats[i].error_message = 'Minimum order of _ seats.'.replace('_', state.seats[i].minimum_order)
                    } else {
                        has_seats_ordered = true
                    }

                    let found_checked = false
                    for (let j = 0; j < state.seats[i].prices.length; j++) {
                        if (state.seats[i].prices[j].checked) {
                            found_checked = true
                            break;
                        }
                    }

                    if (!found_checked) {
                        has_errors = true
                        state.seats[i].error_message = 'Please select a duration.'
                    }
                }
            }

            if (!has_seats_ordered) {
                has_errors = true
                state.error_message = 'Please select the seats you want to book.'
            }

            state.has_errors = has_errors
            return has_errors
        }

        const bookNow = () => {
            if (checkHasErrors()) {
                return
            }

            fetch('/events/' + props.event_id + '/reserve')
                .then((response) => response.json())
                .then((data) => {
                    
                });
        }

        const updateDate = (new_date) => {
            state.selected_date = new_date
            updateTimes()
        }

        const updateTimes = () => {
            state.times = [];

            let today = new Date()
            let time = Math.floor(today.getTime() / 1000)
            today.setUTCHours(0,0,0,0)
            time = time - Math.floor(today.getTime() / 1000)
            today.setUTCHours(23,59,59,999)
            today = Math.floor(today.getTime() / 1000)

            let times = props.schedule.days[state.selected_date.getDay()]

            let selected_time = Math.floor(state.selected_date.getTime() / 1000)
            if (selected_time < today) {
                times = times.filter((value) => time < value)
            }

            state.times = times.map((value) => {
                let pad = (value) => (value < 10 ? '0' + value : value)
                let hours = Math.floor(value / 60 / 60)
                let minutes = Math.floor((value - hours * 60 * 60) / 60)
                return (props.options.time == 12 ? (hours > 12 ? hours - 12 : hours) : pad(hours >= 24 ? 0 : hours)) + ':' + pad(minutes) + (props.options.time == 12 ? (hours > 11 && hours != 24 ? ' pm' : ' am') : '')
            })
        }
        updateTimes()

        const updateTotal = () => {
            let total_duration = 0
            let total_price = 0

            for (let i = 0; i < state.seats.length; i++) {
                if (state.seats[i].quantity > state.seats[i].max_capacity) {
                    state.seats[i].quantity = state.seats[i].max_capacity
                } else if (state.seats[i].quantity < 0) {
                    state.seats[i].quantity = 0
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
            state.total_duration = total_duration
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

        const togglePrice = (seat, price) => {
            for (let i = 0; i < state.seats.length; i++) {
                if (props.options.fixed_duration || state.seats[i].id == seat.id) {
                    for (let j = 0; j < state.seats[i].prices.length; j++) {
                        if (state.seats[i].prices[j].duration == price.duration) {
                            state.seats[i].prices[j].checked = true
                        } else {
                            state.seats[i].prices[j].checked = false
                        }
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
            updateTimes,
            displayPrice,
            incrementQuantity,
            decrementQuantity,
            togglePrice,
        }
    },
}
</script>