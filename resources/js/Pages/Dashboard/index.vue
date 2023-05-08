<!-- Asset/Index.vue -->
<script setup>
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';



</script>

<template>
<AppLayout title="DashBoard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
       Welcome To Your Dashboard
      </h2>
    </template>
  <div class="container pt-4">
    <div class="row">
      <div class="col-4">
        <div class="card mt-3 mx-auto">
          <div class="card-header bg-info">Todays Bookings</div>
          <div class="card-body">
            Bob's Marina : 2 Bookings <br>  
            Jills Marina : 2 Bookings</div>
          <div class="card-footer">4 Total Bookings</div>
        </div>
      </div>
      <div class="col-4">
        <div class="card mt-3 mx-auto">
          <div class="card-header bg-info">Todays Rental Profits</div>
          <div class="card-body">
            Rentals - $3,759.00<br> 
            Add-ons - $798.00<br> 
            Tips - $400.00<br> 
            Total : $4,850.00

          </div>
          <div class="card-footer">4/12/23</div>
        </div>
      </div>
      <div class="col-4">
        <div class="card mt-3 mx-auto">
          <div class="card-header bg-info">Up Comming Bookings</div>
          <div class="card-body">
            4/13/23 : 5 Bookings<br> 
            4/14/23 : 2 Bookings<br> 
            4/15/23 : 7 Bookings<br> 
            4/16/23 : 69 Bookings
          </div>
          <div class="card-footer">82 Bookings in next 7 days</div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-4">
        <div class="card mt-3 mx-auto">
          <div class="card-header bg-info">Todays Tickets</div>
          <div class="card-body">
            Bob's MoJo 10pm 200 Tickets<br> 
                       4pm  249 Tickets<br> 
                       8pm  305 Tickets<br> 
            
            Naked Neds 12pm 450 Tickets<br> 
                       6pm  325 Tickets<br> 
                       10pm 669 Tickets<br> 

          </div>
          <div class="card-footer">1245 Tickets sold Today</div>
        </div>
      </div>
      <div class="col-4">
        <div class="card mt-3 mx-auto">
          <div class="card-header bg-info">Todays Ticket Profits</div>
          <div class="card-body">
            Bob's Mojo - $12,334.00<br> 
            Naked Neds - $20,213.99<br> 
            Total: $32,553.99
          </div>
          <div class="card-footer">4/12/23</div>
        </div>
      </div>
      <div class="col-4">
        <div class="card mt-3 mx-auto">
          <div class="card-header bg-info">Up Comming Ticket Shows</div>
          <div class="card-body">
            4/13/23 Bob's Mojo , Naked Neds<br> 
            4/14/23 Bob's Mojo , Naked Neds<br> 
            4/15/23 Return of Two Foot Tommy<br> 
            4/16/23 Little Man Big Dictator
          </div>
          <div class="card-footer">Shows next 7 days</div>
        </div>
      </div>
    </div>
  </div>

  <div>
    <bar-chart :chart-data="chartData" :chart-options="chartOptions" />
  </div>

</AppLayout>
</template>
  
<script>


export default {
  props: {
    user: Object,
    team: Object,
   
}
};
</script>




