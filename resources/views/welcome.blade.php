<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book It Dashboard</title>
  <link rel="stylesheet" href="css/dashboardcss.css">
</head>
<body>

@if($canLogin)
  <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
    @if(isset($auth['user']))
      <a href="{{ route('dashboard.index') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
    @else
      <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
      @if($canRegister)
        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
      @endif
    @endif
  </div>
@endif

<style>
/* Set background color and font */
body {
  background-color: #87CEEB; /* light blue */
  font-family: 'Roboto', sans-serif;
}

/* Style the header section */
header {
  text-align: center;
  margin-top: 100px;
}

h1 {
  font-size: 64px;
  color: #FFFFFF; /* white */
  text-shadow: 2px 2px 5px #000000; /* add shadow */
}

p {
  font-size: 24px;
  color: #FFFFFF; /* white */
  margin-bottom: 50px;
}

.cta-btn {
  display: inline-block;
  background-color: #F08080; /* coral */
  color: #FFFFFF; /* white */
  font-size: 20px;
  padding: 20px 40px;
  border-radius: 50px;
  text-decoration: none;
  transition: background-color 0.3s ease-in-out;
}

.cta-btn:hover {
  background-color: #FFA07A; /* light salmon */
}

/* Style the benefits section */
.benefits {
  text-align: center;
  margin-top: 100px;
}

h2 {
  font-size: 48px;
  color: #FFFFFF; /* white */
  text-shadow: 2px 2px 5px #000000; /* add shadow */
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

li {
  font-size: 24px;
  color: #FFFFFF; /* white */
  margin-bottom: 20px;
}

/* Style the testimonials section */
.container {
  max-width: 960px;
  margin: 0 auto;
}

.testimonial-wrapper {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.testimonial {
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
  padding: 20px;
  margin: 20px;
  max-width: 400px;
}

.testimonial p {
  font-size: 1.2rem;
  line-height: 1.5;
  color: #000;
}

.author {
  text-align: right;
  font-style: italic;
}

/* Style the footer */
footer {
  text-align: center;
  margin-top: 100px;
  color: #FFFFFF; /* white */
}

/* Set link styles */
a {
  color: #FFFFFF; /* white */
  text-decoration: none;
  transition: color 0.3s ease-in-out;
}

a:hover {
  color: #FFA07A; /* light salmon */
}

</style>



<div class="landing-page">
  <div class="container">
    <header>
      <h1>Booking 24/7</h1>
      <p>The Online Booking Solution</p>
      <a href="#" class="cta-btn">Contact Us </a>
    </header>
    <section class="benefits">
      <h2>Why Choose Booking 24/7?</h2>
      <ul>
        <li>24/7 availability</li>
        <li>Easy booking process</li>
        <li>Resource Tracking</li>
        <li>Customizable booking forms</li>
      </ul>
    </section>
    </div>
</div>

<footer>
    <p>&copy; 2023 Booking 24/7. All rights reserved.</p>
</footer>



<script>
  const canLogin = {{ $canLogin }};
  const canRegister = {{ $canRegister }};
  const laravelVersion = '{{ App::version() }}';
  const phpVersion = '{{ PHP_VERSION }}';
</script>
</body>
</html>
