<!DOCTYPE html>
<?php
// Start a PHP session
session_start();
?>

<html lang="en">
<head>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book It Dashboard</title>
  
<style>
.hidden {
  display: none;
}

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

/* Right styles */
.right {
  background-color: #fff;
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
.rental-options{
display: flex;
flex-direction: column;
align-items: center;
}

.rental-options__title{
margin-top: 0;
}

.left-menu{
list-style: none;
margin: 0;
padding: 0;
}

.left-menu li{
margin-bottom: 10px;
list-style: none;
}

.left-menu a{
display: block;
padding: 10px;
border: 1px solid #ccc;
border-radius: 5px;
text-align: center;
text-decoration: none;
color: #333
}

.left-menu a:hover {
background-color: #4286f4;
}

.subhead{
text-decoration: underline;
}

.right-content {
  width: 500px;
  margin: 7px auto;
  padding: 20px;
  background-color: #f8f8f8;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}
.equipment-content {
  width: 800px;
  margin: 7px auto;
  padding: 20px;
  background-color: #f8f8f8;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.edit-product-heading {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
}

.product-form {
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 20px;
}

.form-label {
  display: block;
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

.form-input {
  display: block;
  width: 80%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.change-image-button {
  display: inline-block;
  padding: 10px 20px;
  font-size: 16px;
  font-weight: bold;
  color: #fff;
  background-color: #2196f3;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.change-image-button:hover {
  background-color: #0c7cd5;
}

.delete-product-button {
  display: inline-block;
  padding: 10px 20px;
  font-size: 16px;
  font-weight: bold;
  color: #fff;
  background-color: #f44336;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.delete-product-button:hover {
  background-color: #d32f2f;
}


.equipment-content button {
  background-color: #214560;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  font-size: 18px;
  margin-bottom: 20px;
}

.green button{
  background-color: #80FF00;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  font-size: 18px;
  margin-bottom: 20px;
}

.equipment-content table {
  border-collapse: collapse;
  width: 100%;
}

.equipment-content th {
  background-color: #214560;
  color: #fff;
  font-size: 18px;
  text-align: left;
  padding: 10px;
}

.equipment-content td {
  font-size: 16px;
  padding: 10px;
  border-bottom: 1px solid #ddd;
}


.equipment-content td:last-child {
  text-align: center;
}


.equipment-content button[onclick="openModal()"] {
  background-color: #356dad;
  color: #fff;
  border: none;
  padding: 8px 16px;
  border-radius: 5px;
  cursor: pointer;
  transition: all 0.3s ease;
}


.equipment-content button[onclick="openModal()"]:hover {
  background-color: #F1C40F;
}


.equipment-content input[type="checkbox"] {
  transform: scale(1.5);
  margin: 0 auto;
  display: block;
  cursor: pointer;
}

.equipment-content a {
  color: #d32f2f;
  text-decoration: none;
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
					<li><a href="{{ route('dashboard') }}" id="nav-promocode-btn">PromoCode</a></li>
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
	
<section class="rental-options">
<div class="right">
  <h2>Rental Options</h2>
  <div class="right-side">
    <nav class="left-menu">
      <ul>
        <li><a href="#" data-content="details">Details</a></li>
        <li><a href="#" data-content="equipment">Equipment</a></li>
        <li><a href="#" id="seasonbtn">Season</a></li>
        <li><a href="#" data-content="durations">Durations</a></li>
        <li><a href="#" data-content="prices">Prices</a></li>
        <li><a href="#" data-content="availability">Availability</a></li>
        <li><a href="#" data-content="manage-seasons">Manage Seasons</a></li>
        <li class="subhead"><b>Optional</b></li>
        <li><a href="#" data-content="questions">Questions</a></li>
        <li><a href="#" data-content="taxes-fees">Taxes and Fees</a></li>
        <li><a href="#" data-content="advance">Advance</a></li>
        <li><a href="#" data-content="smart-reviews">Smart Reviews</a></li>
        <li><a href="#" data-content="variants">Variants</a></li>
      </ul>
    </nav>
  </div>
</div>
</section>
<!--  pop up  -->
<!-- Season POP UP -->
<div id="season-popup" class="popup">
  <div class="popup-content">
	<div class="hidden">
    <span class="close">&times;</span>
    <h3>Select a season:</h3>
    <select>
      <option value="spring">Spring</option>
      <option value="summer">Summer</option>
      <option value="fall">Fall</option>
      <option value="winter">Winter</option>
    </select>
    <button id="save-btn">Save</button>
	</div>
  </div>
</div>
<!-- availability pop up -->
<div id="ava-popup" class="popup">
	<div class="popup-content">
	<div class="hidden">
    <span class="close">&times;</span>
		<h2>New Availability Form</h2>
		<form>
		  <label for="repeats">Repeats:</label>
			<div id="repeat-options">
			  <button id="daily-btn" class="active">Daily</button>
			  <button id="weekly-btn" >Weekly</button>
			</div>

			<div id="weekly-options" class="hidden">
			  <label>Repeat on:</label>
			  <div>
				<input type="checkbox" name="repeat-day" id="sunday" value="sunday">
				<label for="sunday">Sunday</label>
			  </div>
			  <div>
				<input type="checkbox" name="repeat-day" id="monday" value="monday">
				<label for="monday">Monday</label>
			  </div>
			  <div>
				<input type="checkbox" name="repeat-day" id="tuesday" value="tuesday">
				<label for="tuesday">Tuesday</label>
			  </div>
			  <div>
				<input type="checkbox" name="repeat-day" id="wednesday" value="wednesday">
				<label for="wednesday">Wednesday</label>
			  </div>
			  <div>
				<input type="checkbox" name="repeat-day" id="thursday" value="thursday">
				<label for="thursday">Thursday</label>
			  </div>
			  <div>
				<input type="checkbox" name="repeat-day" id="friday" value="friday">
				<label for="friday">Friday</label>
			  </div>
			  <div>
				<input type="checkbox" name="repeat-day" id="saturday" value="saturday">
				<label for="saturday">Saturday</label>
			  </div>
			</div>
			<label>Start Time:</label>
			<button id="repeating-btn">Repeating</button>
			<button id="specific-btn">Specific</button><br><br>

			<div id="repeating-options">
			  <div>
				<label>Rental Starts Every:</label>
				<div id="Time-btn-Group">
				  <button class="interval-btn active" data-interval="15">15</button>
				  <button class="interval-btn" data-interval="30">30</button>
				  <button class="interval-btn" data-interval="60">60</button>
				</div>
			  </div>
			  <div>
				<label>Between:</label>
				<input type="time" id="start-time">
				<label>and</label>
				<input type="time" id="end-time">
			  </div>
			</div>

			<div id="specific-options">
			  <div>
				<label>Starts At:</label>
				<input type="time" id="specific-time">
			  </div>
			  <div>
				<a href="#" id="add-time-link">+ Add another time</a>
			  </div>
			</div>
		  <label for="duration">Applies To:</label>
			<div id="duration">
			  <input type="radio" id="all" name="duration" value="all" checked>
			  <label for="all">All Durations</label>
			  <input type="radio" id="specific" name="duration" value="specific">
			  <label for="specific">Specific Durations</label>
			</div>
		  <button type="submit">Save</button>
		</form>
		</div>
	</div>	
</div>
<!-- Details option stuff -->
    <div class="contentrental">
	  <div id="details" class="hidden">
		<div class="right-content">
          <h2 class="edit-product-heading">Edit Product</h2>
          <form class="product-form" action="/newrental" method="POST" enctype="multipart/form-data">
             @csrf
              <div class="form-group">
                <label for="product-name" class="form-label">Product Name:</label>
                <input type="text" id="product-name" name="product-name" class="form-input">
              </div>
              <div class="form-group">
                <label for="description" class="form-label">Description:</label>
                <input type="text" id="description" name="description" class="form-input">
              </div>
              <div class="form-group">
                 <label for="widget-image" class="form-label">Widget Image:</label>
                 <input type="file" name="widget-image" id="widget-image">
              </div>
              <button class="delete-product-button">Delete this product</button>
              <button type="submit" class="submit-product-button">Submit</button>
            </form>
        </div>
    </div>

<!--Equipment button on menu -->
      <div id="equipment" class="hidden">
	  <div class="equipment-content">
		<table>
		  <thead>
		  <tr>
			  <td colspan="3">
				<button><a id="addmore" href="#">+ Add equipment type</a></button>
			  </td>
			</tr>
			<tr>
			  <th>Display Name</th>
			  <th>Equipment Pool</th>
			  <th>Actions</th>
			</tr>
		  </thead>
		  <tbody>
			<tr>
			  <td>
				<input type="text" id="my-edit-box" value="Sport">
			  </td>
			  <td>
				<select>
				  <option value="pool1">sport</option>
				  <option value="pool2">deluxe</option>
				  <option value="pool3">high output</option>
				</select>
			  </td>
			  <td>
				<button id="advance-btn">Advance</button>
				<button>Save</button>
				<a href="#">Remove</a>
			  </td>
			</tr>
			<tr>
			  <td>
				<input type="text" id="my-edit-box" value="deluxe">
			  </td>
			  <td>
				<select>
				  <option value="pool1">sport</option>
				  <option value="pool2">deluxe</option>
				  <option value="pool3">high output</option>
				</select>
			  </td>
			  <td>
				<button id="advance-btn2">Advance</button>
				<button>Save</button>
				<a href="#">Remove</a>
			  </td>
			</tr>
		  </tbody>
		</table>
		</div>
	</div>
	
		
		<div id="popup-container">
		  <div id="popup">
			<h2>Advance</h2>
			<form>
			  <div>
				<label for="description">Description:</label>
				<input type="text" id="description" name="description">
			  </div>
			  <div>
				<label for="widget-image">Widget image:</label>
				<input type="file" id="widget-image" name="widget-image">
				<img id="image-placeholder" src="#" alt="Widget image">
			  </div>
			  <div>
				<label for="widget-display">Widget display:</label>
				<input type="checkbox" id="widget-display" name="widget-display">
				<label for="widget-display">Hide</label>
			  </div>
			  <div>
				<label for="min-value">Min value:</label>
				<input type="number" id="min-value" name="min-value">
			  </div>
			  <div>
				<label for="max-value">Max value:</label>
				<input type="number" id="max-value" name="max-value">
			  </div>
			  <div>
				<input type="checkbox" id="require-min" name="require-min">
				<label for="require-min">Require min</label>
			  </div>
			  <div>
				<label for="category">Category:</label>
				<select id="category" name="category">
				  <option value="adult">Adult</option>
				  <option value="child">Child</option>
				  <option value="other">Other</option>
				</select>
			  </div>
			  <button type="button" id="save-btn">Save</button>
			</form>
			<a href="#" id="close-btn">Close</a>
		  </div>
		</div>



      <div id="durations" class="hidden">
        <table>
		  <thead>
			<tr>
			  <th>Duration Name</th>
			  <th>Rental Duration</th>
			  <th></th>
			</tr>
		  </thead>
		  <tbody>
			<tr>
			  <td><input type="text" value="1 day"></td>
			  <td>
				<span class="counter">
				  <input type="number" value="0" min="0"> hours
				</span>
				<span class="counter">
				  <input type="number" value="0" min="0"> minutes
				</span>
			  </td>
			  <td>
				  <div class="actions">
					<a href="#" class="save-link">Save</a>
					<a href="#" class="remove-link">Remove</a>
					<a href="#" class="advance-link">Advance</a>
					<div class="advance-options hidden">
					 <div class="advance-options">
				  <label>
					<input type="checkbox"> Hide<br><br>
				  </label>
				  <span class="counter">
					Buffer before:
					<input type="number" value="0" min="0"> minutes<br><br>
				  </span>
				  <span class="counter">
					Buffer after:
					<input type="number" value="0" min="0"> minutes<br><br>
				  </span>
				</div>
					</div>
				  </div>

				</td>
				
			</tr>
			<tr>
			  <td><input type="text" value="4 hours"></td>
			  <td>
				<span class="counter">
				  <input type="number" value="4" min="0"> hours
				</span>
				<span class="counter">
				  <input type="number" value="0" min="0"> minutes
				</span>
			  </td>
			  <td>
				<div class="actions">
					<a href="#" class="save-link">Save</a>
					<a href="#" class="remove-link">Remove</a>
					<a href="#" class="advance-link">Advance</a>
					<div class="advance-options hidden">
					 <div class="advance-options">
				  <label>
					<input type="checkbox"> Hide<br><br>
				  </label>
				  <span class="counter">
					Buffer before:
					<input type="number" value="0" min="0"> minutes<br><br>
				  </span>
				  <span class="counter">
					Buffer after:
					<input type="number" value="0" min="0"> minutes<br><br>
				  </span>
				</div>
					</div>
				  </div>
				</td>

				
				
			  </td>
			</tr>
		  </tbody>
		</table>

      </div>
      <div id="prices" class="hidden">
        <table>
		  <thead>
			<tr>
			  <th></th>
			  <th>Total price</th>
			  <th>Deposit price</th>
			  <th>Action</th>
			</tr>
		  </thead>
		  <tbody>
			<tr>
			  <th colspan="3">Yamaha Wave Runner High Output</th>
			</tr>
			<tr>
			  <td>5 Days</td>
			  <td>$<input type="text" value="2099.99" onchange="showSaveButton(this)"></td>
			  <td>$<input type="text" value="1050.00" onchange="showSaveButton(this)"></td>
			  <td><button class="hidden" onclick="saveChanges(this)">Save</button></td>
		  </tr>
		  <tr>
			<td>4 Days</td>
			<td>$<input type="text" value="1699.99" onchange="showSaveButton(this)"></td>
			<td>$<input type="text" value="850.00" onchange="showSaveButton(this)"></td>
			<td><button class="hidden" onclick="saveChanges(this)">Save</button></td>
		  </tr>
		  <tr>
			<td>3 Days</td>
			<td>$<input type="text" value="1299.99" onchange="showSaveButton(this)"></td>
			<td>$<input type="text" value="650.00" onchange="showSaveButton(this)"></td>
			<td><button class="hidden" onclick="saveChanges(this)">Save</button></td>
		  </tr>
		  <tr>
			<td>2 Days</td>
			<td>$<input type="text" value="899.99" onchange="showSaveButton(this)"></td>
			<td>$<input type="text" value="450.00" onchange="showSaveButton(this)"></td>
			<td><button class="hidden" onclick="saveChanges(this)">Save</button></td>
		  </tr>
		  <tr>
			<td>1 Day</td>
			<td>$<input type="text" value="449.99" onchange="showSaveButton(this)"></td>
			<td>$<input type="text" value="275.00" onchange="showSaveButton(this)"></td>
			<td><button class="hidden" onclick="saveChanges(this)">Save</button></td>
		  </tr>
		  <tr>
			<td>Half Day | 4 Hours</td>
			<td>$<input type="text" value="340.00" onchange="showSaveButton(this)"></td>
			<td>$<input type="text" value="160.00" onchange="showSaveButton(this)"></td>
			<td><button class="hidden" onclick="saveChanges(this)">Save</button></td>
		  </tr>
		  <tr>
			<td>Day | 8 Hours</td>
			<td>$<input type="text" value="399.99" onchange="showSaveButton(this)"></td>
			<td>$<input type="text" value="200.00" onchange="showSaveButton(this)"></td>
			<td><button class="hidden" onclick="saveChanges(this)">Save</button></td>
		  </tr>
		  <tr>
			<th colspan="3">Yamaha Wave Runner Deluxe</th>
		  </tr>
		  <tr>
			<td>5 Days</td>
			<td>$<input type="text" value="1849.99" onchange="showSaveButton(this)"></td>
			<td>$<input type="text" value="900.00" onchange="showSaveButton(this)"></td>
			<td><button class="hidden" onclick="saveChanges(this)">Save</button></td>
		  </tr>
		  <tr>
			<td>4 Days</td>
			<td>$<input type="text" value="1499.99" onchange="showSaveButton(this)"></td>
			<td>$<input type="text" value="750.00" onchange="showSaveButton(this)"></td>
			<td><button class="hidden" onclick="saveChanges(this)">Save</button></td>
		  </tr>
		  <tr>
			<td>3 Days</td>
			<td>$<input type="text" value="1199.99" onchange="showSaveButton(this)"></td>
			<td>$<input type="text" value="600.00" onchange="showSaveButton(this)"></td>
			<td><button class="hidden" onclick="saveChanges(this)">Save</button></td>
		  </tr>
		  <tr>
			<td>2 Days</td>
			<td>$<input type="text" value="799.99" onchange="showSaveButton(this)"></td>
			<td>$<input type="text" value="400.00" onchange="showSaveButton(this)"></td>
			<td><button class="hidden" onclick="saveChanges(this)">Save</button></td>
		  </tr>
		  <tr>
			<td>1 Day</td>
			<td>$<input type="text" value="399.99" onchange="showSaveButton(this)"></td>
			<td>$<input type="text" value="150.00" onchange="showSaveButton(this)"></td>
			<td><button class="hidden" onclick="saveChanges(this)">Save</button></td>
		  </tr>
		  <tr>
			<td>Half Day | 4 Hours</td>
			<td>$<input type="text" value="340.00" onchange="showSaveButton(this)"></td>
			  <td>$<input type="text" value="4160.00" onchange="showSaveButton(this)" ></td>
			  <td><button class="hidden" onclick="saveChanges(this)">Save</button></td>
			</tr>
			<tr>
			  <td>Day | 8 Hours</td>
			  <td>$<input type="text" value="4399.99" onchange="showSaveButton(this)" ></td>
			  <td>$<input type="text" value="4200.00" onchange="showSaveButton(this)" ></td>
			  <td><button class="hidden" onclick="saveChanges(this)">Save</button></td>
			</tr>
		</tbody>
	</table>
      </div>
      <div id="availability" class="hidden" >
        <button id="new-availability-button">+ New Availability</button>
			
		<table>
		  <thead>
			<tr>
			  <th>Repeats</th>
			  <th>Times</th>
			  <th>Applies to</th>
			  <th></th>
			</tr>
		  </thead>
		  <tbody>
			<tr>
			  <td>Daily</td>
			  <td>Every 60mins from 10am to 3pm</td>
			  <td>4 hour</td>
			  <td><a href="#">View/Edit</a></td>
			</tr>
			<tr>
			  <td>Daily</td>
			  <td>10am</td>
				<td>1day 2day 3day</td>
			  <td><a href="#">View/Edit</a></td>
			</tr>
		  </tbody>
		</table>
      </div>
<script>
  function SeasonOpenTab(evt, tabName) {
  // Declare all variables
  let i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them, except the current tab content
  tabcontent = document.querySelectorAll(".SeasonTab .tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    if (tabcontent[i].id === tabName) {
      tabcontent[i].classList.add("active");
      console.log("Show tab content");
    } else {
      tabcontent[i].classList.remove("active");
      console.log("Hide tab content");
    }
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.querySelectorAll(".SeasonTab .tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].classList.remove("active");
    console.log("Hide active on tablinks");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(tabName).classList.add("active");
  evt.currentTarget.classList.add("active");
  console.log("show current tab and make button active");
}

  
  </script>
      <div id="manage-seasons" class="hidden">
			<div class="SeasonTab">
    <div class="tab">
      <button class="tablinks active" onclick="SeasonOpenTab(event, 'current')">Current Seasons</button>
      <button class="tablinks" onclick="SeasonOpenTab(event, 'past')">Past Seasons</button>
    </div>

    <div id="current" class="tabcontent active">
      <!-- Content for the "Current Seasons" tab goes here -->
      <table class="table-seasons">
  <thead>
    <tr>
      <th>Season</th>
      <th>Dates</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Fall 2023</td>
      <td>Sept 22 - Dec 21</td>
      <td>
        <a href="#">Split Season</a>&nbsp;&nbsp;&nbsp;
        <button id="edit-btn">Edit</button>
			<div class="popup-wrapper">
			  <div class="popup-container SeasonEdit">
				<h2>Edit 2023</h2>
				<label for="season-name">Season Name:</label>
				<input type="text" id="season-name" name="season-name"><br>

				<label for="season-start">Season Start:</label>
				<a href="#" id="season-start">January 5th 2023</a><br>

				<label for="season-end">Season End:</label>
				<a href="#" id="season-end">October 5th 2023</a><br>

				<button id="season-save-btn">Save</button>
			  </div>
			</div>
      </td>
    </tr>
    <tr>
      <td>Summer 2023</td>
      <td>June 21 - Sept 21</td>
      <td>
        <a href="#">Split Season</a>&nbsp;&nbsp;&nbsp;
        <button id="edit-btn">Edit</button>
			<div class="popup-wrapper">
			  <div class="popup-container SeasonEdit">
				<h2>Edit 2023</h2>
				<label for="season-name">Season Name:</label>
				<input type="text" id="season-name" name="season-name"><br>

				<label for="season-start">Season Start:</label>
				<a href="#" id="season-start">January 5th 2023</a><br>

				<label for="season-end">Season End:</label>
				<a href="#" id="season-end">October 5th 2023</a><br>

				<button id="season-save-btn">Save</button>
			  </div>
			</div>
      </td>
    </tr>
  </tbody>
</table>
    </div>

    <div id="past" class="tabcontent">
      <!-- Content for the "Past Seasons" tab goes here -->
     <table class="table-seasons"> 
  <thead>
    <tr>
      <th>Season</th>
      <th>Dates</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Fall 2022</td>
      <td>September 22 - December 21</td>
    </tr>
    <tr>
      <td>Winter 2022</td>
      <td>December 22 - March 19</td>
    </tr>
    <tr>
      <td>Spring 2022</td>
      <td>March 20 - June 20</td>
    </tr>
    <tr>
      <td>Summer 2022</td>
      <td>June 21 - September 21</td>
    </tr>
  </tbody>
</table>
    </div>
  </div>
      </div>
	  <div id="questions" class="hidden">
<table>
  <thead>
    <tr>
      <th>Question</th>
      <th>Question Type</th>
      <th>Settings</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>I certify I am 18 yrs or older</td>
      <td>Checkbox</td>
      <td>
        <input type="checkbox" checked> Required<br>
        <input type="checkbox"> Internal only<br>
        <input type="checkbox" checked> Do not display in confirmation email
      </td>
      <td><a href="#">Remove</a></td>
    </tr>
    <tr>
      <td>Fort Loundon lake</td>
      <td>Multiple Choice</td>
      <td>
        <input type="checkbox" checked> Required<br>
        <input type="checkbox"> Internal only<br>
        <input type="checkbox" checked> Do not display in confirmation email
      </td>
      <td><a href="#">Remove</a><br><br><a href="#">has follow up question</a></td>
	  
    </tr>
  </tbody>
</table>
<a href="#">+ Apply Question</a>
      </div>
	  <div id="taxes-fees" class="hidden">
        <h2>taxes-fees</h2>
        <p>This is now part of configure</p>
      </div>
	  <div id="advance" class="hidden">
        <label for="cancel-policy">Cancellation Policy:</label>
		<input type="text" id="cancel-policy" placeholder="Enter your cancellation policy here" style="width: 400px; height: 100px;"><br>

		<label for="pickup-location">Pickup Location:</label>
		<input type="text" id="pickup-location" placeholder="Enter where to pick up"style="width: 400px; height: 100px;"><br>

		<h3>Email Variables</h3>

		<label for="whats-included">What's Included:</label>
		<input type="text" id="whats-included" placeholder="Tell customers what all is included in this package"style="width: 400px; height: 100px;"><br>

		<label for="what-to-know">What to Know:</label>
		<input type="text" id="what-to-know" placeholder="Tell customers what they need to know"style="width: 400px; height: 100px;"><br>

		<label for="what-to-bring">What to Bring:</label>
		<input type="text" id="what-to-bring" placeholder="Tell customers what to bring"style="width: 400px; height: 100px;"><br>

		<h3>When Do You Stop Bookings</h3>

		<label><input type="radio" name="stop-bookings" value="hours-before" checked> I stop bookings <input type="number" id="stop-hours" value="24"> Hrs before start time</label><br>
		<label><input type="radio" name="stop-bookings" value="midnight"> I stop accepting bookings at midnight the night before</label><br>

		<h3>Booking Confirmation</h3>

		<button type="button" class="btn-auto-confirm active">Auto-Confirm</button>
		<button type="button" class="btn-manual">Manual</button><br>

		<label for="currency">Currency:</label>
		<select id="currency">
		  <option value="us">US</option>
		  <option value="euro">Euro</option>
		</select>

      </div>
	  <div id="smart-reviews" class="hidden">
        <label for="smart-review-link">Smart Review Link:</label>
<input type="text" id="smart-review-link" name="smart-review-link"><br>

<label for="redirect-for">Redirect for:</label>
<select id="redirect-for" name="redirect-for">
  <option value="5-star-only">5 Star Only</option>
  <option value="4-or-5-star">4 or 5 Star</option>
  <option value="3-to-5-star">3 to 5 Star</option>
  <option value="2-to-5-star">2 to 5 Star</option>
  <option value="any-review">Any Review</option>
</select>
      </div>
	  <div id="variants" class="hidden">
        <h2>variants</h2>
        <p>do not need right now. </p>
      </div>
    </div>
  </div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // Your JavaScript code here

const links = document.querySelectorAll('.left-menu a');
const contents = document.querySelectorAll('.contentrental > div');

// Hide all content elements except the first one
for (let i = 1; i < contents.length; i++) {
  if (contents[i].id !== 'popup-availability') {
    contents[i].classList.add('hidden');
  }
}

for (let i = 0; i < links.length; i++) {
  links[i].addEventListener('click', (event) => {
    event.preventDefault();
    const contentId = event.target.getAttribute('data-content');
    const content = document.getElementById(contentId);
    // Show the clicked link's content, and hide all other content elements
    for (let j = 0; j < contents.length; j++) {
      if (contents[j].id === contentId) {
        contents[j].classList.remove('hidden');
      } else if (contents[j].id !== 'popup-availability') {
        contents[j].classList.add('hidden');
      }
    }
  });
}

const popupContainer = document.getElementById('popup-container');
const popup = document.getElementById('popup');
const closeBtn = document.getElementById('close-btn');
const saveBtn = document.getElementById('save-btn');
const imageInput = document.getElementById('widget-image');
const imagePlaceholder = document.getElementById('image-placeholder');
const advanceBtn = document.getElementById('advance-btn');
const advanceBtn2 = document.getElementById('advance-btn2');
const newAvailabilityBtn = document.getElementById('new-availability-button');
const availabilityPopup = document.getElementById('ava-popup');

function showPopup() {
  popupContainer.style.display = 'block';
}

function hidePopup() {
  popupContainer.style.display = 'none';
}

// Show availability pop up when "New Availability" button is clicked
newAvailabilityBtn.addEventListener('click', () => {
  availabilityPopup.style.display = 'block';
  console.log("new avilability button was clicked");
});

// Hide availability pop up when its close button is clicked
const closeAvailabilityPopupBtn = availabilityPopup.querySelector('.close');
closeAvailabilityPopupBtn.addEventListener('click', () => {
  availabilityPopup.style.display = 'none';
  console.log("thinks close button was clicked");
});

const availabilityForm = availabilityPopup.querySelector('form');
availabilityForm.addEventListener('submit', function(event) {
  event.preventDefault();
  if (event.submitter && event.submitter.getAttribute('type') === 'submit') {
    // Code to save the form data goes here
    availabilityPopup.style.display = 'none';
    console.log("Save button was clicked");
  }
});



function handleImageInputChange() {
  const file = this.files[0];
  const reader = new FileReader();

  reader.onload = (e) => {
    imagePlaceholder.src = e.target.result;
  }

  reader.readAsDataURL(file);
}

// Attach event listeners
closeBtn.addEventListener('click', hidePopup);
saveBtn.addEventListener('click', hidePopup);
imageInput.addEventListener('change', handleImageInputChange);
advanceBtn.addEventListener('click', showPopup);
advanceBtn2.addEventListener('click', showPopup);

// Hide popup on page load
//popupContainer.style.display = 'none';



const addEquipmentTypeLink = document.getElementById('addmore');
const tableBody = document.querySelector('table tbody');
let rowCount = 2; // number of existing rows

addEquipmentTypeLink.addEventListener('click', () => {
  // create new row
  const newRow = document.createElement('tr');
  const displayNameCell = document.createElement('td');
  const displayNameInput = document.createElement('input');
  displayNameInput.type = 'text';
  displayNameInput.id = `my-edit-box-${rowCount}`;
  displayNameInput.value = '';
  displayNameCell.appendChild(displayNameInput);

  const equipmentPoolCell = document.createElement('td');
  const equipmentPoolSelect = document.createElement('select');
  equipmentPoolSelect.innerHTML ='<option value="pool1">sport</option><option value="pool2">deluxe</option><option value="pool3">high output</option>';
  equipmentPoolCell.appendChild(equipmentPoolSelect);

  const actionsCell = document.createElement('td');
  const advanceBtn = document.createElement('button');
  advanceBtn.id = `advance-btn-${rowCount}`;
  advanceBtn.innerText = 'Advance';
  const saveBtn = document.createElement('button');
  saveBtn.innerText = 'Save';
  const removeLink = document.createElement('a');
  removeLink.href = '#';
  removeLink.innerText = 'Remove';
  actionsCell.appendChild(advanceBtn);
  actionsCell.appendChild(saveBtn);
  actionsCell.appendChild(removeLink); 

  // add new row to table
  newRow.appendChild(displayNameCell);
  newRow.appendChild(equipmentPoolCell);
  newRow.appendChild(actionsCell);
  <!-- tableBody.insertBefore(newRow, addEquipmentTypeLink.parentNode); -->
  tableBody.appendChild(newRow);
  <!-- newRow.style.display = 'table-row'; -->

  rowCount++; // increment the row count
});

// Get the season link, pop-up, select element, and save button
var seasonLink = document.getElementById("seasonbtn");
var seasonPopup = document.getElementById("season-popup");
var selectElement = seasonPopup.querySelector("select");
var saveButton = seasonPopup.querySelector("#save-btn");

// When the season link is clicked, show the pop-up
seasonLink.addEventListener("click", function() {
  seasonPopup.style.display = "block";
});



// When the save button is clicked, save the selected season and close the pop-up
saveButton.addEventListener("click", function() {
  // Get the selected season from the select element
  var selectedSeason = selectElement.value;
  
  // Save the selected season (add your own code here to save the season)
  console.log("Selected season: " + selectedSeason);
  
  // Close the pop-up
  seasonPopup.style.display = "none";
});

// When any other link is clicked, close the pop-up
document.addEventListener("click", function(event) {
  // Check if the target element is inside the pop-up or the season link
  if (!seasonPopup.contains(event.target) && event.target !== seasonLink) {
    seasonPopup.style.display = "none";
  }
});

// get all advance links
var advanceLinks = document.querySelectorAll('.advance-link');

// add event listener to each advance link
advanceLinks.forEach(function(link) {
  link.addEventListener('click', function(event) {
    event.preventDefault(); // prevent default link behavior
    var options = this.nextElementSibling; // get the next sibling element
    options.classList.toggle('hidden'); // toggle the "hidden" class
  });
});

function showSaveButton(input) {
    var row = input.parentNode.parentNode;
    var saveButton = row.querySelector('button');
    saveButton.classList.remove('hidden');
  }

  function saveChanges(button) {
    var row = button.parentNode.parentNode;
    var input = row.querySelector('input');
    var saveButton = row.querySelector('button');
    saveButton.classList.add('hidden');
    input.setAttribute('readonly', true);
  }
  
 
const dailyBtn = document.getElementById('daily-btn');
const weeklyBtn = document.getElementById('weekly-btn');
const weeklyOptions = document.getElementById('weekly-options');

// Show weekly options when weekly button is clicked
weeklyBtn.addEventListener('click', () => {
  weeklyOptions.classList.remove('hidden');
  dailyBtn.classList.remove('active');
  weeklyBtn.classList.add('active');
});

// Hide weekly options when daily button is clicked
dailyBtn.addEventListener('click', () => {
  weeklyOptions.classList.add('hidden');
  weeklyBtn.classList.remove('active');
  dailyBtn.classList.add('active');
});

const repeatingBtn = document.getElementById('repeating-btn');
const specificBtn = document.getElementById('specific-btn');
const repeatingOptions = document.getElementById('repeating-options');
const specificOptions = document.getElementById('specific-options');
const addTimeLink = document.getElementById('add-time-link');
const specificTimeInput = document.getElementById('specific-time');

repeatingBtn.addEventListener('click', () => {
  repeatingBtn.classList.add('active');
  specificBtn.classList.remove('active');
  repeatingOptions.style.display = 'block';
  specificOptions.style.display = 'none';
});

specificBtn.addEventListener('click', () => {
  specificBtn.classList.add('active');
  repeatingBtn.classList.remove('active');
  repeatingOptions.style.display = 'none';
  specificOptions.style.display = 'block';
});

addTimeLink.addEventListener('click', (e) => {
  e.preventDefault();
  const newTimeDiv = document.createElement('div');
  newTimeDiv.innerHTML = '<div><label>Starts At:</label><input type="time"></div>';
  specificOptions.insertBefore(newTimeDiv, addTimeLink.parentNode);
});

    document.getElementById('repeating-btn').classList.add('active');

  const intervalBtns = document.querySelectorAll('#Time-btn-Group .interval-btn');
  const activeBtn = document.querySelector('#Time-btn-Group .active');

  intervalBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      intervalBtns.forEach(btn => btn.classList.remove('active'));
      btn.classList.add('active');
    });
  });

  activeBtn.classList.add('active');
  
const editBtn = document.getElementById("edit-btn");
const popupWrapper = document.querySelector(".popup-wrapper");
const seasonSaveBtn = popupWrapper.querySelector("#season-save-btn");
const seasonNameInput = popupWrapper.querySelector("#season-name");

editBtn.addEventListener("click", () => {
  popupWrapper.style.display = "flex";
});

seasonSaveBtn.addEventListener("click", (e) => {
  e.preventDefault();
  const seasonName = seasonNameInput.value;
  console.log(`Season name: ${seasonName}`);
  popupWrapper.style.display = "none";
});


// Get the season start and end link elements
const seasonStartLink = document.getElementById('season-start');
const seasonEndLink = document.getElementById('season-end');

// Add a click event listener to the links
seasonStartLink.addEventListener('click', showCalendar);
seasonEndLink.addEventListener('click', showCalendar);

// Function to show the calendar
function showCalendar(event) {
  event.preventDefault(); // Prevent the default link behavior
  
  // Get the link element that was clicked
  const link = event.target;
  
  // Get the input element to update based on the clicked link
  const input = link.previousElementSibling;
  
  // Show the calendar using the Datepicker library
  $(input).datepicker({
    dateFormat: 'MM d, yy',
    onSelect: function(dateText) {
      $(this).val(dateText);
      $(this).datepicker('hide');
    }
  }).datepicker('show');
}

const btnAutoConfirm = document.querySelector('.btn-auto-confirm');
const btnManual = document.querySelector('.btn-manual');

btnAutoConfirm.addEventListener('click', () => {
  btnAutoConfirm.classList.add('active');
  btnManual.classList.remove('active');
});

btnManual.addEventListener('click', () => {
  btnAutoConfirm.classList.remove('active');
  btnManual.classList.add('active');
});



});

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

</script>
</body>
</html>