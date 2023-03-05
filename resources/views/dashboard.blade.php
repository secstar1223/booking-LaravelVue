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
  <link rel="stylesheet" href="CSS/Dashboardcss.css">
</head>
<body>
  <header>
    <h1>Book It Dashboard</h1>
  </header>
  <div class="container">
    <div class="left">
      <h2>Navigation</h2>
      <div class="button-container">
        <button><a href="#">Dashboard</a></button>
        <button><a href="#">Calendar</a></button>
        <button><a href="#">Customers</a></button>
        <button><a href="#">Reports</a></button>
        <button><a href="#">Marketing</a></button>
        <button id="products-btn"><a href="#">Products</a></button>
		        <?php
          if (isset($_GET['page']) && $_GET['page'] == 'products') {
            echo '
              <ul>
                <li><a href="#">Rentals</a></li>
                <li><a href="#">Add-ons</a></li>
              </ul>
            ';
          }
        ?>
        <button><a href="#">Configuration</a></button>
        

        
      </div>
    </div>
    <div class="right">
      <h2>Welcome to your Dashboard!</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet semper tortor, ac vestibulum metus rhoncus a. Sed eleifend, arcu vel laoreet efficitur, nisl metus sollicitudin ante, in euismod erat orci nec quam. Donec nec quam ut urna pellentesque interdum. Nullam consectetur felis ut libero mollis suscipit. Vestibulum non semper velit. Cras venenatis, quam eu finibus interdum, mi ex pharetra orci, eget aliquet velit nisi eu est. Praesent ullamcorper eros quis lorem maximus efficitur. Donec vitae nisi a metus convallis vestibulum. Suspendisse potenti. Maecenas vel tristique odio.</p>
    </div>
  </div>
  <footer>
    <p>&copy; 2023 BookIt.com</p>
  </footer>
  
  <script>
    var productsBtn = document.getElementById('products-btn');
    productsBtn.addEventListener('click', function() {
      window.location.href = '?page=products';
    });
  </script>
</body>
</html>



