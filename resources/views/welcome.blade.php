


<div class="landing-page">
    <div class="container">
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
    </div>
    <section class="testimonials">
        <h2>What Our Customers Say</h2>
        <div class="testimonial-wrapper">
            @foreach($testimonials as $testimonial)
                <div class="testimonial">
                    <p>"{{ $testimonial['quote'] }}"</p>
                    <p class="author">- {{ $testimonial['author'] }}, {{ $testimonial['job'] }}</p>
                </div>
            @endforeach
        </div>
    </section>
</div>

<footer>
    <p>&copy; 2023 Booking 24/7. All rights reserved.</p>
</footer>



<script>
let app = new Vue({
el: '#app',
data: {
canLogin: {{ $canLogin }},
canRegister: {{ $canRegister }},
laravelVersion: '{{ App::version() }}',
phpVersion: '{{ PHP_VERSION }}',
testimonials: {!! json_encode($testimonials) !!}
}
});
</script>
