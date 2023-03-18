<script setup>
//import AppLayout from '@/Layouts/AppLayout.vue';
//import Welcome from '@/Components/Welcome.vue';
</script>



<template>
	<header>
		<h1>Book It Dashboard</h1>
	</header>
<!-- Navagation Bar left side -->
	<div class="container">
		<div class="leftnav">
			<h2>Navigation</h2>
			<div class="nav-button-container">
				<button id="nav-dashboard-btn">Dashboard</button>
				<ul id="nav-dashboard-menu" class="hidden">
					<li><a href="#" id="nav-manifest-btn">Manifest</a></li>
					<li><a href="#" id="nav-capacity-btn">Capacity Report</a></li>
				</ul>
				<button id="nav-calendar-btn">Calendar</button>
				<ul id="nav-calendar-menu" class="hidden">
					<li><a href="#" id="nav-calrentals-btn">Rentals</a></li>
					<li><a href="#" id="nav-calavilablity-btn">Availablity</a></li>
				</ul>
				<button id="nav-customers-btn">Customers</button>
				<ul id="nav-customers-menu" class="hidden">
					<li><a href="#" id="nav-searchcustomers-btn">Search</a></li>
					<li><a href="#" id="nav-members-btn">Members</a></li>
				</ul>
				<button id="nav-reports-btn">Reports</button>
				<ul id="nav-reports-menu" class="hidden">
					<li><a href="#" id="nav-sales-btn">sales</a></li>
					<li><a href="#" id="nav-profit-btn">profit</a></li>
				</ul>
				<button id="nav-marketing-btn">Marketing</button>
				<ul id="nav-marketing-menu" class="hidden">
					<li><a href="#" id="nav-promocode-btn">PromoCode</a></li>
					<li><a href="abandon.html" id="nav-abandoned-btn">Abandoned</a></li>
				</ul>
				<button id="nav-products-btn">Products</button>
			<ul id="nav-products-menu" class="hidden">
				<li><a href="#" id="nav-rentals-btn">Rentals</a></li>
				<li><a href="addon.html" id="nav-addon-btn">Add-ons</a></li>
				<li><a href="#" id="nav-membership-btn">Memberships</a></li>
			</ul>
				<button id="nav-configuration-btn">Configuration</button>
			<ul id="nav-configuration-menu" class="hidden">
			</ul>
			</div>
		</div>
<!-- Right Side Content side -->	
		<div class="right">
		<h2>Welcome to your Dashboard!</h2>
<!-- Configuration Items -->
			<div id="customer-section" class="right hidden" >
			  <h2>Your Customers</h2>
			  <div class="customer-buttons">
				<button><a href="Widgetflow.html">Widget Flow</a></button>
				<button><a href="Questions.html">Activity Questions</a></button>
				<button>Waivers</button>
				<button>Emails</button>
				<button>Tipping</button>
			  </div>
			  <h2>Office Items</h2>
			  <div class="customer-buttons">
				<button>Taxes</button>
				<button><a href="EquipmentGuides.html"></a></button>
			  </div>
			  <h2>Integrations</h2>
			  <div class="customer-buttons">
				<button>square</button>
			  </div>
			  <h2>Business</h2>
			  <div class="customer-buttons">
				<button>account detail</button>
				<button>employee and premissions</button>
			  </div>
			</div>
<!-- Manafest Items -->			
			<div id="manafest-selection" class="right hidden" >
			  <div class="customer-buttons">
			  <h2>Manifest</h2>
				<button>Today</button>
				<button>Tomorrow</button>
				<button>Select Date</button>
			  </div>
			  Shows your rentals times (some nice calander view.)
			</div>
<!-- Capacity Items -->			
			<div id="capacity-selection" class="right hidden" >
			  <div class="customer-buttons">
			  <h2>Capacity Report</h2>
				<button>Today</button>
				<button>Tomorrow</button>
				<button>Select Date</button>
			  </div>
			  Shows what you have available (some nice calander view.)
			</div>
<!-- Rentals by calander view -->			
			<div id="calrentals-selection" class="right hidden" >
			  <div class="customer-buttons">
			  <h2>Calendar Rentals</h2>
				<button>Today</button>
				<button>Tomorrow</button>
				<button>Select Date</button>
			  </div>
			  shows all the rentals and none rental times. maybe not needed?
			</div>
<!-- Availablity view  -->			
			<div id="calavilablity-selection" class="right hidden" >
			  <div class="customer-buttons">
			  <h2>Calendar avilablity</h2>
				<button>Today</button>
				<button>Tomorrow</button>
				<button>Select Date</button>
			  </div>
			  shows what is available , maybe add on something bettre..maybe not needed.
			</div>
<!-- Search Customers -->			
			<div id="searchcustomers-selection" class="right hidden" >
			  <h2>Customer Search</h2>
					<form>
						<label for="search-input">Search:</label>
						<input type="text" id="search-input" name="search-input">
						<button type="submit">Go</button>
					</form>
			  	<table>
				<thead>
					<tr>
						<th>Last</th>
						<th>First</th>
						<th>Purchase Date</th>
						<th>Activity Date</th>
						<th>Product</th>
						<th>Status</th>
						<th>Price</th>
						<th>Booking ID</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Doe</td>
						<td>John</td>
						<td>2022-02-14</td>
						<td>2022-02-15</td>
						<td>Product A</td>
						<td>Active</td>
						<td>$50</td>
						<td>12345</td>
					</tr>
				</tbody>
			</table>
			</div>
<!-- View Memberships -->			
			<div id="members-selection" class="right hidden" >
			  <div>
				<label for="search">Search:</label>
				<input type="text" id="search" name="search">
			</div>

			<table>
				<thead>
					<tr>
						<th>Member</th>
						<th>Membership</th>
						<th>Redemption Total</th>
						<th>Stats</th>
						<th>Price</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<ul>
								<li>Name: John Doe</li>
								<li>Email: john.doe@example.com</li>
								<li>Phone Number: 555-1234</li>
								<li>Member Code: 12345</li>
							</ul>
						</td>
						<td>Membership A</td>
						<td>1 per year, used 0 total redemptions</td>
						<td>Confirm</td>
						<td>$100.00</td>
						<td><button>Cancel (No Refund)</button></td>
					</tr>
					<tr>
						<td>
							<ul>
								<li>Name: Jane Smith</li>
								<li>Email: jane.smith@example.com</li>
								<li>Phone Number: 555-5678</li>
								<li>Member Code: 54321</li>
							</ul>
						</td>
						<td>Membership B</td>
						<td>1 per year, used 1 total redemptions</td>
						<td>Cancelled</td>
						<td>$50.00</td>
						<td><button>Cancel (No Refund)</button></td>
					</tr>
				</tbody>
			</table>
			</div>
<!-- Sales Reports -->			
			<div id="sales-selection" class="right hidden" >
			  <div class="customer-buttons">
			  <h2>Monthly Sales</h2>
				<table>
				  <thead>
					<tr>
					  <th>Month</th>
					  <th>Total Sales</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td>January</td>
					  <td>$10,000</td>
					</tr>
					<tr>
					  <td>February</td>
					  <td>$15,000</td>
					</tr>
					<tr>
					  <td>March</td>
					  <td>$12,000</td>
					</tr>
					<tr>
					  <td>April</td>
					  <td>$18,000</td>
					</tr>
					<tr>
					  <td>May</td>
					  <td>$22,000</td>
					</tr>
					<tr>
					  <td>June</td>
					  <td>$25,000</td>
					</tr>
					<tr>
					  <td>July</td>
					  <td>$20,000</td>
					</tr>
					<tr>
					  <td>August</td>
					  <td>$18,000</td>
					</tr>
					<tr>
					  <td>September</td>
					  <td>$15,000</td>
					</tr>
					<tr>
					  <td>October</td>
					  <td>$20,000</td>
					</tr>
					<tr>
					  <td>November</td>
					  <td>$22,000</td>
					</tr>
					<tr>
					  <td>December</td>
					  <td>$30,000</td>
					</tr>
				  </tbody>
				</table>
			  </div>
			  better charts graphs for reports. 
			</div>
<!-- Profit reports-->		
			<div id="profit-selection" class="right hidden" >
			  <div>
			  <h2>Monthly Profit</h2>
			  <table>
				  <thead>
					<tr>
					  <th>Month</th>
					  <th>Sales</th>
					  <th>Expenses</th>
					  <th>Profit</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td>January</td>
					  <td>$10,000</td>
					  <td>$6,000</td>
					  <td>$4,000</td>
					</tr>
					<tr>
					  <td>February</td>
					  <td>$12,000</td>
					  <td>$7,000</td>
					  <td>$5,000</td>
					</tr>
					<tr>
					  <td>March</td>
					  <td>$15,000</td>
					  <td>$8,000</td>
					  <td>$7,000</td>
					</tr>
					<tr>
					  <td>April</td>
					  <td>$11,000</td>
					  <td>$5,000</td>
					  <td>$6,000</td>
					</tr>
				  </tbody>
				  <tfoot>
					<tr>
					  <td>Total</td>
					  <td>$48,000</td>
					  <td>$26,000</td>
					  <td>$22,000</td>
					</tr>
				  </tfoot>
				</table>
			  </div>
			</div>
<!-- Promo code data -->			
			<div id="promo-selection" class="right hidden" >
			  <div class="customer-buttons">
			  <h2>Promotion Codes</h2>
				<div class="promo-box">
				  <h2>Add Promo Code</h2>
				  <input type="text" placeholder="Enter promo code" />
				  <button  id="add-tab-btn"><a href="promo.html">Add</a></button>
				</div>
			
		
				<table>
				  <thead>
					<tr>
					  <th>Created</th>
					  <th>Name</th>
					  <th>Status</th>
					  <th>Redeemed</th>
					  <th>Amount</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td>2022-01-01</td>
					  <td>NEWYEAR</td>
					  <td>Active</td>
					  <td>0</td>
					  <td>10% off</td>
					</tr>
					<tr>
					  <td>2021-11-15</td>
					  <td>BLACKFRIDAY</td>
					  <td>Inactive</td>
					  <td>50</td>
					  <td>$50 off</td>
					</tr>
					<tr>
					  <td>2021-08-31</td>
					  <td>ENDOFSUMMER</td>
					  <td>Deleted</td>
					  <td>100</td>
					  <td>20% off</td>
					</tr>
				  </tbody>
				</table>
				</div>
				
<!-- Rental Configuration -->
			</div>
			<div id="rental-selection" class="right hidden" >
			  <div class="customer-buttons">
			  
					<button onclick="window.location.href='newrental.html'">+ New Rental</button>

					<table>
					  <thead>
						<tr>
						  <th>Product Name</th>
						  <th>Equipment</th>
						  <th>Widget</th>
						  <th>Edit</th>
						</tr>
					  </thead>
					  <tbody>
						<tr>
						  <td>Product 1</td>
						  <td>Equipment 1</td>
						  <td><a href="widget.html">Get Your Widget</a></td>
						  <td><a href="newrental.html">View/Edit</a></td>
						</tr>
						<tr>
						  <td>Product 2</td>
						  <td>Equipment 2</td>
						  <td><a href="widget.html">Get Your Widget</a></td>
						  <td><a href="newrental.html">View/Edit</a></td>
						</tr>
						<tr>
						  <td>Product 3</td>
						  <td>Equipment 3</td>
						  <td><a href="widget.html">Get Your Widget</a></td>
						  <td><a href="newrental.html">View/Edit</a></td>
						</tr>
					  </tbody>
					</table>
 
				</div>
			</div>
		</div>
	</div> 
</template>

<script>
export default {
  mounted() {
    function hideOtherSections() {
      var otherSections = document.querySelectorAll('.right:not(.hidden)');
      otherSections.forEach(function(section) {
        section.classList.add('hidden');
      });
    }

    // Get all buttons with dropdown menus
    var buttons = document.querySelectorAll('.nav-button-container button');

    // Add event listeners to each button
    buttons.forEach(function(button) {
      var menu = button.nextElementSibling;
      if (menu) {
        button.addEventListener('click', function() {
          menu.classList.toggle('hidden');
          if (button.id === 'nav-configuration-btn') {
            hideOtherSections();
            var customerSection = document.getElementById('customer-section');
            customerSection.classList.toggle('hidden');
          }
        });
      }
    });

    // Get all links in the dashboard menu
    var links = document.querySelectorAll('#nav-dashboard-menu a, #nav-calendar-menu a, #nav-customers-menu a, #nav-reports-menu a, #nav-marketing-menu a, #nav-products-menu a');

    // Add event listeners to each link
    links.forEach(function(link) {
      link.addEventListener('click', function(event) {
      
       if (link.getAttribute('href') === 'abandon.html') {
          // Allow the default link behavior
          return;
        }
        if (link.getAttribute('href') === 'addon.html') {
          // Allow the default link behavior
          return;
        }
        
        // Prevent the default link behavior
        event.preventDefault();

        // Stop the event from bubbling up to the button
        event.stopPropagation();

        hideOtherSections();

        if (link.id === 'nav-manifest-btn') {
          var manifestSection = document.getElementById('manafest-selection');
          manifestSection.classList.remove('hidden');
        } else if (link.id === 'nav-capacity-btn') {
          var capacitySection = document.getElementById('capacity-selection');
          capacitySection.classList.remove('hidden');
        } else if (link.id === 'nav-calrentals-btn') {
          var calrentalsSection = document.getElementById('calrentals-selection');
          calrentalsSection.classList.remove('hidden');
        } else if (link.id === 'nav-calavilablity-btn') {
          var calavilablitySection = document.getElementById('calavilablity-selection');
          calavilablitySection.classList.remove('hidden');
        } else if (link.id === 'nav-searchcustomers-btn') {
          var searchcustomers = document.getElementById('searchcustomers-selection');
          searchcustomers.classList.remove('hidden');
        } else if (link.id === 'nav-members-btn') {
          var members = document.getElementById('members-selection');
          members.classList.remove('hidden');
        } else if (link.id === 'nav-sales-btn') {
          var salesSelection = document.getElementById('sales-selection');
          salesSelection.classList.remove('hidden');
        } else if (link.id === 'nav-profit-btn') {
          var profitSelection = document.getElementById('profit-selection');
          profitSelection.classList.remove('hidden');
        } else if (link.id === 'nav-promocode-btn') {
          var promoSelection = document.getElementById('promo-selection');
          promoSelection.classList.remove('hidden');
        } else if (link.id === 'nav-rentals-btn') {
          var rentalSelection = document.getElementById('rental-selection');
          rentalSelection.classList.remove('hidden');
        }
      });
    });
  }
}
</script>

<style>
/* Body styles */
body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
  margin: 0px;
}

/* Header styles */
header {
  background-color: #4286f4;
  color: #fff;
  padding: 20px;
  text-align: center;
}
/* Container styles */
.container {
  display: flex;
  flex-direction: row;
  height: 100vh;
}

/* Left styles */
.leftnav {
  background-color: #4286f4;
  color: #fff;
  padding: 15px;
}

.leftnav h2 {
  margin-bottom: 10px;
  text-align: center;
}

.leftnav .nav-button-container {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.leftnav button {
display: inline-block;
outline: 0;
border: 0;
cursor: pointer;
will-change: box-shadow,transform;
background: radial-gradient( 100% 100% at 100% 0%, #89E5FF 0%, #5468FF 100% );
box-shadow: 0px 2px 4px rgb(45 35 66 / 40%), 0px 7px 13px -3px rgb(45 35 66 / 30%), inset 0px -3px 0px rgb(58 65 111 / 50%);
padding: 0 32px;
border-radius: 6px;
color: #fff;
height: 32px;
font-size: 18px;
text-shadow: 0 1px 0 rgb(0 0 0 / 40%);
transition: box-shadow 0.15s ease,transform 0.15s ease;
}

.leftnav button:hover {
  background-color: #1e3d6b;
}

.leftnav ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

.leftnav ul li {
  margin: 0;
  padding: 0;
}

.leftnav a {
  color: #fff;
  text-decoration: none;
}

.leftnav .hidden:not(.popupava) {
  display: none;
}

/* Right styles */
.right {
  padding: 20px;
}


.right .hidden:not(.popupava) {
  display: none;
}

.right h2 {
  margin-bottom: 10px;
}

.right p {
  line-height: 1.5;
  font-size: 16px;
  color: #555;
}

button{
  border: none;
  cursor: pointer;
  appearance: none;
  background-color: inherit;
  height: 70px;
}
img {
  width: 125px;
  height: 125px;
}

h2 {
  font-size: 24px;
  color: #01579b;
  margin-bottom: 20px;
}
#rental-selection { 
  background-color: #f8f8f8;
  border: 2px solid #ddd;
  border-radius: 5px;
  padding: 20px;
}

.customer-buttons {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

button {
  background-color: #356dad;
  color: #fff;
  padding: 10px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
  font-size: 1rem;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
  font-weight: bold;
}

a {
  color: #00a99d;
  text-decoration: none;
}




</style>

