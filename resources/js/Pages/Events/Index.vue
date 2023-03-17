<template>
  <div class="row">
    <h1 class="col-12">Events</h1>
    <div v-for="event in events" :key="event.id" class="col-lg-4 col-md-6 col-sm-12 mb-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ event.name }}</h5>
          <p class="card-text">{{ event.description }}</p>
          <a :href="'/events/' + event.id + '/seats'" class="btn btn-primary">View Details</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    events: Array
  }
}
</script>