<?php
require '../inc/init.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php
$page_title = 'Allegheny Eclipse - Sign Up';
include '../inc/head.php';
?>
</head>
<body>
<?php
include '../inc/navbar.php';
?>
    <section id="subpage-content" class="subpage-content">
        <div class="container">
            <h1>Sign Up</h1>
            <h2>Sign ups for the 2025 season are currently closed</h2>
            <div class="content" style="text-align: center;">
                <p>If you are interested in joining, please fill out the form below and we will notify you when sign ups reopen.</p>
                <p>
                    <form action="submit.php" method="POST" class="signup-form">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <div data-sitekey="<?php echo $_ENV['CF_SITE_KEY']; ?>" class="cf-turnstile"></div>
                            <input type="hidden" name="type" value="sign_up_list"/>
                        </div>
                        <button type="submit" class="form-submit">Notify Me!</button>
                    </form>
                </p>
                <h2 style="margin-top:2rem;">Don't forget to sign up for our <strong>Spin Clinic</strong>!</h2>
                <p>Join us on <strong>October 13, 7-9PM</strong> for a fun and beginner friendly spin clinic! You'll learn basic techniques, put together a simple routine and explore the art of flag spinning. No experience necessary, just bring your energy and curiosity!</p>
                <p class="event-cta">
                    <a href="/class-register.php" class="btn event-link form-submit" onclick="gtag('event', 'click', { 'event_category': 'Internal Link', 'event_label': 'Spin Clinic Registration Click', 'value': 1 });">Register Now</a>
                </p>


            </div>
        </div>
    </section>

<?php
include '../inc/footer.php';
?>
    <script src="js/scripts.js"></script>
</body>
</html>
