<?php
require '../inc/init.php';
$config = require '../config.php'; 

// Alternate hero images
$img1 = 'hero.png';
$img2 = 'hero_b.png';

$selectedImage = (rand(0, 1) === 0) ? $img1: $img2;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php 
$page_title = 'Allegheny Eclipse - Warren, Pennsylvania Adult Color Guard';
include '../inc/head.php';
?>
    <style>
        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0); }
        }
    </style>
</head>
<body>
<?php
include '../inc/navbar.php';
?>
    <!-- Hero Section -->
    <section id="hero" class="hero">
        <img src="img/logo.png" alt="Allegheny Eclipse logo" class="hero-logo">
        <div class="hero-content">
<!--            <h1 class="hero-text" style="animation: float 3s ease-in-out infinite;">Allegheny Eclipse</h1>-->
                <img src="img/spin_clinic_promo.png" alt="Spin Clinic" class="hero-text" style="max-height:300px; margin-top:200px; animation: float 3s ease-in-out infinite;">
        </div>
        <img src="img/<?= htmlspecialchars($selectedImage) ?>" alt="WE ARE ALLEGHENY ECLIPSE!" class="hero-bg">
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="event-container">
            <img src="img/spin_clinic_promo.png" alt="Spin Clinic Promo" class="event-img">
            <div class="event-text">
                <h2>Spin Clinic: Let's Spin!</h2>
                <p>Join us on <strong>October 13, 7-9PM</strong> for a fun and beginner friendly spin clinic! You'll learn basic techniques, put together a simple routine and explore the art of flag spinning. No experience necessary, just bring your energy and curiosity!</p>
                <p class="event-cta">
                    <a href="/class-register.php" class="btn event-link form-submit" onclick="gtag('event', 'click', { 'event_category': 'Internal Link', 'event_label': 'Spin Clinic Registration Click', 'value': 1 });">Register Now</a>
                </p>
            </div>
        </div>
        <div class="about-container">
            <img src="img/we_are.jpg" alt="We are Allegheny Eclipse" class="about-img">
            <div class="about-text">
                <h2>About Us</h2>
                <p>Founded in 2025, our color guard was created for adults who never stopped loving the art of performance. What started as a small dream quickly grew into a vibrant space for movers, dancers, spinners, and storytellers of all backgrounds. Our members bring their experience, passion, and dedication together to celebrate the athleticism, artistry, and spirit of color guard.</p>
                <p>Our mission is to foster a supportive and challenging environment where members can refine their skills, connect with others, and continue to perform with pride and creativity. Whether under the bright lights of a stadium or in the soft spotlight of a local performance, we aim to share the joy, power, and beauty of our art form with every audience we meet. We believe color guard is for everyone — at every stage of life.</p>
                <p>Join us as we continue to grow, learn, and inspire one another. Together, we are Allegheny Eclipse!</p>
            </div>
        </div><!-- Hide Video
        <div class="about-video">
            <iframe 
                src="https://www.youtube.com/embed/6HMWCQlUL5o"
                title="Allegheny Eclipse – Intro" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                referrerpolicy="strict-origin-when-cross-origin"
                allowfullscreen>
            </iframe>
        </div>-->
    </section>

    <!-- Calendar Section -->
    <section id="calendar" class="calendar">
        <div class="calendar-container">
            <h2>Upcoming Events</h2>
            <iframe src="https://calendar.google.com/calendar/embed?height=800&wkst=1&ctz=America%2FNew_York&showPrint=0&showTitle=0&showCalendars=0&title=Allegheny%20Eclipse&mode=AGENDA&src=MGZlMDUxOGIzNmNjZTIxMzcwNGJjM2ZhOTlhMTVjNmI2NDE5ZjIzOTBiMTQ5MzI3MmM0YzNhMWQzNzZiZmNkNEBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&color=%239E69AF" class="calendar-iframe" frameborder="0" scrolling="no"></iframe>
        </div>
    </section>
    <!-- Support Us Section -->
    <section id="support" class="support">
        <div class="support-container">
            <div class="support-text">
                <h2>Support Our Journey</h2>
                <p>We’re building something special, a place where adults can rediscover the joy of color guard, connect through movement and music, and bring performance back into their lives. As we launch this new chapter, we’re raising funds to help cover the basics: flags, poles, equipment bags, and other essentials that make our practices and performances possible. If you believe in creativity, community, and second chances to do what you love, we invite you to support our journey. Every contribution helps us shine a little brighter.</p>
                <p><a href="https://gofund.me/9b33c1c5" onclick="gtag('event', 'click', { 'event_category': 'External Link', 'event_label': 'GoFundMe Campaign Click', 'value': 1 });" target="_blank" class="btn support-link">Donate on GoFundMe</a></p>
            </div>
            <img src="img/eclipse_support.png" alt="Support Allegheny Eclipse" class="support-img">
        </div>
    </section>
    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="contact-container">
            <h2>Contact Us</h2>
            <form action="submit.php" method="POST" class="contact-form">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="comments">Comments</label>
                    <textarea id="comments" name="comments" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <div data-sitekey="<?php echo $_ENV['CF_SITE_KEY']; ?>" class="cf-turnstile"></div>
                    <input type="hidden" name="type" value="contact"/>
                </div>
                <button type="submit" class="form-submit">Send Message</button>
            </form>
        </div>
    </section>
<?php
include '../inc/footer.php';
?>
<script src="js/toastr.js"></script>
<script src="js/scripts.js"></script>
<script>

</script>
</body>
</html>
