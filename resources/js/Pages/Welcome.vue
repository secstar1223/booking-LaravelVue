<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

export default {
  name: 'LandingPage',
  data() {
    return {
      testimonials: [
        {
          quote: 'Booking 24/7 has completely transformed the way I manage my bookings. It\'s so easy to use and my clients love it!',
          author: 'John Smith',
          job: 'Owner of Smith happty ending Salon'
        },
        {
          quote: 'I\'ve tried several booking software solutions over the years, but Booking 24/7 is by far the best. It\'s simple, efficient, and has saved me so much time.',
          author: 'Jane Doe',
          job: 'Personal Trainer of Butts'
        }
      ]
    }
  }
}
</script>

<template>
  <Head title="Welcome" />
  <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
    <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</Link>
    <template v-else>
      <Link :href="route('login')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</Link>
      <Link v-if="canRegister" :href="route('register')" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</Link>
    </template>
  </div> 
  <div class="landing-page">
    <header>
      <h1>Booking 24/7</h1>
      <p>The Online Booking Solution</p>
      <a href="#" class="cta-btn">Book Now</a>
    </header>
    <section class="benefits">
      <h2>Why Choose Booking 24/7?</h2>
      <ul>
        <li>24/7 availability</li>
        <li>Easy booking process</li>
        <li>Automatic reminders</li>
        <li>Customizable booking forms</li>
      </ul>
    </section>
    <section class="testimonials">
      <h2>What Our Customers Say</h2>
      <div class="testimonial" v-for="(testimonial, index) in testimonials" :key="index">
        <p>"{{ testimonial.quote }}"</p>
        <p class="author">- {{ testimonial.author }}, {{ testimonial.job }}</p>
      </div>
    </section>
    <footer>
      <p>&copy; 2023 Booking 24/7. All rights reserved.</p>
    </footer>
  </div>
</template>



<style>
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

header {
  background-color: #0077CC;
  color: #FFFFFF;
  text-align: center;
  padding: 50px;
}

header h1 {
  font-size: 3em;
  margin-bottom: 10px;
}

header p {
  font-size: 1.2em;
  margin-bottom: 30px;
}

.cta-btn {
  background-color: #FFFFFF;
  color: #0077CC;
  font-size: 1.2em;
  padding: 10px 20px;
  border-radius: 5px;
  text-decoration: none;
}

.cta-btn:hover {
  background-color: #0077CC;
  color: #FFFFFF;
}

.benefits {
  background-color: #F7F7F7;
  padding: 50px;
}

.benefits h2 {
  font-size: 2em;
  margin-bottom: 30px;
}

.benefits ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.benefits li {
  font-size: 1.2em;
  margin-bottom: 10px;
}

.testimonials {
  background-color: #FFFFFF;
  padding: 50px;
}

.testimonials h2 {
  font-size: 2em;
  margin-bottom: 30px;
}

.testimonial {
  margin-bottom: 30px;
}

.testimonial p {
  font-size: 1.2em;
margin-bottom: 10px;
}

.testimonial .author {
font-size: 1em;
font-style: italic;
}

.footer {
background-color: #0077CC;
color: #FFFFFF;
text-align: center;
padding: 20px;
}

.footer p {
font-size: 1.2em;
margin: 0;
}
</style>