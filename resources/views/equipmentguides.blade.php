<!DOCTYPE html>
<?php
// Start a PHP session
session_start();
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book It Dashboard</title>
  
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
  /* Body styles */
body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
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
  width: 8.6666667%; /* 1/6th of the screen */
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
:hover {
	box-shadow: 0px 4px 8px rgb(45 35 66 / 40%), 0px 7px 13px -3px rgb(45 35 66 / 30%), inset 0px -3px 0px #3c4fe0;
	transform: translateY(-2px);
}
:active{
	box-shadow: inset 0px 3px 7px #3c4fe0;
	transform: translateY(2px);
}
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
/* CSS for the popup modal */
.modal {
	display: none; /* Hidden by default */
	position: fixed; /* Stay in place */
	z-index: 1; /* Sit on top */
	left: 0;
	top: 0;
	width: 100%; /* Full width */
	height: 100%; /* Full height */
	overflow: auto; /* Enable scroll if needed */
	background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.modal-content {
  background-color: #fff;
  margin: 10% auto;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 5px;
  width: 60%;
}

/* Style for the entire right-content section */ 
.right-content {
  padding: 10px;
  border-radius: 30px;
}

/* Style for the welcome message */
.right-content h2 {
  font-size: 30px;
  text-align: center;
  margin-bottom: 20px;
  color: #214560;
}

/* Style for the new rental equipment button */
.right-content button {
  background-color: #214560;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  font-size: 18px;
  margin-bottom: 20px;
}

/* Style for the table */
.right-content table {
  border-collapse: collapse;
  width: 100%;
}

/* Style for the table header */
.right-content th {
  background-color: #214560;
  color: #fff;
  font-size: 18px;
  text-align: left;
  padding: 10px;
}

/* Style for the table body */
.right-content td {
  font-size: 16px;
  padding: 10px;
  border-bottom: 1px solid #ddd;
}

/* Style for the table actions column */
.right-content td:last-child {
  text-align: center;
}

/* Style for the edit button */
.right-content button[onclick="openModal()"] {
  background-color: #356dad;
  color: #fff;
  border: none;
  padding: 8px 16px;
  border-radius: 5px;
  cursor: pointer;
  transition: all 0.3s ease;
}

/* Style for the hover effect on the edit button */
.right-content button[onclick="openModal()"]:hover {
  background-color: #F1C40F;
}

/* Style for the checkbox */
.right-content input[type="checkbox"] {
  transform: scale(1.5);
  margin: 0 auto;
  display: block;
  cursor: pointer;
}

h2 {
  font-size: 24px;
  color: #01579b;
  margin-bottom: 20px;
}

form {
  display: flex;
  flex-direction: column;
}

label {
  font-size: 18px;
  color: #424242;
  margin-bottom: 5px;
}

input[type="text"],
input[type="number"],
textarea {
  font-size: 16px;
  padding: 8px;
  margin-bottom: 10px;
  border-radius: 3px;
  border: 1px solid #ccc;
}

input[type="color"] {
  width: 60px;
  height: 30px;
  margin-bottom: 10px;
  border-radius: 3px;
}

small {
  font-size: 12px;
  color: #757575;
  margin-bottom: 10px;
}

	</style>


</head>
<body>
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
					<li><a href="{{ route('dashboard') }}" id="nav-manifest-btn">Manifest</a></li>
					<li><a href="{{ route('dashboard') }}" id="nav-capacity-btn">Capacity Report</a></li>
				</ul>
				<button id="nav-calendar-btn">Calendar</button>
				<ul id="nav-calendar-menu" class="hidden">
					<li><a href="{{ route('dashboard') }}" id="nav-calrentals-btn">Rentals</a></li>
					<li><a href="{{ route('dashboard') }}" id="nav-calavilablity-btn">Availablity</a></li>
				</ul>
				<button id="nav-customers-btn">Customers</button>
				<ul id="nav-customers-menu" class="hidden">
					<li><a href="{{ route('dashboard') }}" id="nav-searchcustomers-btn">Search</a></li>
					<li><a href="{{ route('dashboard') }}" id="nav-members-btn">Members</a></li>
				</ul>
				<button id="nav-reports-btn">Reports</button>
				<ul id="nav-reports-menu" class="hidden">
					<li><a href="{{ route('dashboard') }}" id="nav-sales-btn">sales</a></li>
					<li><a href="{{ route('dashboard') }}" id="nav-profit-btn">profit</a></li>
				</ul>
				<button id="nav-marketing-btn">Marketing</button>
				<ul id="nav-marketing-menu" class="hidden">
					<li><a href="{{ route('dashboard') }}"id="nav-promocode-btn">PromoCode</a></li>
					<li><a href="{{ route('abandoned') }}" id="nav-abandoned-btn">Abandoned</a></li>
				</ul>
				<button id="nav-products-btn">Products</button>
			<ul id="nav-products-menu" class="hidden">
				<li><a href="{{ route('dashboard') }}" id="nav-rentals-btn">Rentals</a></li>
				<li><a href="{{ route('addon') }}" id="nav-addon-btn">Add-ons</a></li>
				<li><a href="{{ route('dashboard') }}" id="nav-membership-btn">Memberships</a></li>
			</ul>
				<button id="nav-configuration-btn">Configuration</button>
			<ul id="nav-configuration-menu" class="hidden">
			</ul>
			</div>
		</div>
<!-- Right side to show current equipment -->	
<div class="right-content">
    <h2>Welcome to your Dashboard!</h2>
    <button onclick="openModal()">New Rental Equipment Pool</button>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Resource Tracking</th>
                <th>Capacity per item</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
         @foreach ($equipments as $equip)
          <tr>
            <td>{{ $equip->name }}</td>
            <td>{{ $equip->quantity }}</td>
            <td><input type="checkbox" {{ $equip->resource_tracking ? 'checked' : '' }}></td>
            <td>{{ $equip->capacity }}</td>
            <td><button onclick="openModal(this)" data-equip-id="{{ $equip->id }}">Edit</button></td>
          </tr>
        @endforeach
        </tbody>
    </table>
</div>
			
	<!-- The popup modal -->
<div id="myModal" class="modal"> 
  <div class="modal-content">
    <h2>Edit Item</h2>
    <form method="POST" action="{{ route('equipmentguides.store') }}">
      @csrf
    <input type="hidden" id="equip-id" name="equip_id">
      <fieldset>
        <legend>Item Name</legend>
        <div>
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" required>
        </div>
        <div>
          <label for="short-name">Short Name:</label>
          <input type="text" id="short-name" name="short_name" maxlength="10" required>
          <small>10 characters max - used for availability calendar</small>
        </div>
        <div>
          <label for="color">Color:</label>
          <input type="color" id="color" name="color" required>
        </div>
      </fieldset>
      <fieldset>
        <legend>Item Details</legend>
        <div>
          <label for="quantity">How many <span id="name-label"></span> do you have:</label>
          <input type="number" id="quantity" name="quantity" min="0" required>
        </div>
        <div>
          <label for="capacity">Enter the capacity per <span id="name-label"></span>:</label>
          <input type="number" id="capacity" name="capacity" min="0" required>
        </div>
      </fieldset>
      <fieldset>
        <legend>Resource Tracking</legend>
        <div>
          <label>
            <input type="checkbox" name="resource_tracking"> Check for resource tracking
          </label>
        </div>
      </fieldset>
      <fieldset>
        <legend>Widget Description</legend>
        <div>
          <label for="description">Widget Description:<i>This is how equipment is described in widget</i></label><br>
          <textarea id="description" name="description" required></textarea>
        </div>
      </fieldset>
      <button type="submit">Save Changes</button>
    </form>
  </div>
</div>

		
			

	</div>
</header>
<!-- JavaScript to open and close the popup modal -->
	<script>
		var modal = document.getElementById("myModal");
        
function openModal(button) {
    // If the button parameter is defined, it means that the function was called
    // by clicking on the "Edit" button
    if (button) {
        // Retrieve the equipment ID from the button's data attribute
        var equipId = button.dataset.equipId;

        // Set the hidden input field with the equipment ID
        $('#equip-id').val(equipId);

        // Make an AJAX request to retrieve the equipment details
        $.ajax({
            url: '/equipmentguides/' + equipId,
            type: 'GET',
            success: function(response) {
                // Pre-populate the form fields with the retrieved data
                $('#name').val(response.name);
                $('#short-name').val(response.short_name);
                $('#color').val(response.color);
                $('#quantity').val(response.quantity);
                $('#capacity').val(response.capacity);
                $('#description').val(response.description);
                if (response.resource_tracking) {
                    $('input[name="resource_tracking"]').prop('checked', true);
                } else {
                    $('input[name="resource_tracking"]').prop('checked', false);
                }
                // Show the modal
                modal.style.display = "block";
            },
            error: function() {
                alert('Error retrieving equipment details');
            }
        });
    } else {
        // If the button parameter is not defined, it means that the function was
        // called by clicking on the "New Rental Equipment Pool" button

        // Set the form fields to their default values
        $('#name').val('');
        $('#short-name').val('');
        $('#color').val('#000000');
        $('#quantity').val(0);
        $('#capacity').val(0);
        $('#description').val('');
        $('input[name="resource_tracking"]').prop('checked', false);

        // Show the modal
        modal.style.display = "block";
    }
}



		function closeModal() {
			modal.style.display = "none";
		}
		
const nameInput = document.getElementById('name');
		const nameLabel = document.getElementById('name-label');
		nameInput.addEventListener('input', (event) => {
			nameLabel.textContent = event.target.value;
		});		

<!--JS for NAVAGATION-->

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


	</script>
</body>
</html>