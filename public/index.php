<?php
require '../inc/init.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-RKW74QFNX7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo $_ENV['GA_TRACKING_ID']; ?>');
</script>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allegheny Eclipse - Warren, Pennsylvania Adult Color Guard</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Merriweather:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <style>
        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0); }
        }
    </style>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
</head>
<body>
<?php
include '../inc/navbar.php';
?>
    <!-- Hero Section -->
    <section id="hero" class="hero">
        <img src="img/logo.png" alt="Allegheny Eclipse logo" class="hero-logo">
        <div class="hero-content">
            <h1 class="hero-text" style="animation: float 3s ease-in-out infinite;">Allegheny Eclipse</h1>
        </div>
        <img src="img/hero.png" alt="Color guard performers having a blast" class="hero-bg">
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="about-container">
            <img src="img/about.png" alt="Allegheny Eclipse color guard in action" class="about-img">
            <div class="about-text">
                <h2>About Us</h2>
                <p>Founded in 2025, our color guard was created for adults who never stopped loving the art of performance. What started as a small dream quickly grew into a vibrant space for movers, dancers, spinners, and storytellers of all backgrounds. Our members bring their experience, passion, and dedication together to celebrate the athleticism, artistry, and spirit of color guard.</p>
                <p>Our mission is to foster a supportive and challenging environment where members can refine their skills, connect with others, and continue to perform with pride and creativity. Whether under the bright lights of a stadium or in the soft spotlight of a local performance, we aim to share the joy, power, and beauty of our art form with every audience we meet. We believe color guard is for everyone — at every stage of life.</p>
                <p>Join us as we continue to grow, learn, and inspire one another. Together, we are Allegheny Eclipse!</p>
            </div>
        </div>
    </section>

    <!-- Calendar Section -->
    <section id="calendar" class="calendar">
        <div class="calendar-container">
            <h2>Upcoming Events</h2>
            <!-- Replace the src URL with your Google Calendar embed link -->
            <iframe src="https://calendar.google.com/calendar/embed?height=800&wkst=1&ctz=America%2FNew_York&showPrint=0&showTitle=0&showCalendars=0&title=Allegheny%20Eclipse&mode=AGENDA&src=MGZlMDUxOGIzNmNjZTIxMzcwNGJjM2ZhOTlhMTVjNmI2NDE5ZjIzOTBiMTQ5MzI3MmM0YzNhMWQzNzZiZmNkNEBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&color=%239E69AF" class="calendar-iframe" frameborder="0" scrolling="no"></iframe>
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
                </div>
                <button type="submit" class="form-submit">Send Message</button>
            </form>
        </div>
    </section>
<?php
include '../inc/footer.php';
?>
    <script src="js/scripts.js"></script>
</body>
</html>
