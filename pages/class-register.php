<!DOCTYPE html>
<html lang="en">
<head>
<?php
$page_title = 'Allegheny Eclipse - Spin Clinic Registration';
include '../inc/head.php';
?>
</head>
<body>
<?php
include '../inc/navbar.php';
?>
    <section id="subpage-content" class="subpage-content">
        <div class="container">
            <h1>Spin Clinic Registration</h1>
            <div class="content">
                <section id="register" class="register">
                    <div class="register-container">
                        <div style="background: var(--off-black-light); border-left: 5px solid var(--gold); padding: 20px; margin-bottom: 30px; border-radius: 5px;">
                            <h2 style="margin-bottom: 10px;">Let's Spin<br/>October 13, 7–9PM</h2>
                            <p>Join our beginner friendly spin clinic and learn the basics of flag spinning. We’ll cover technique, put together a simple routine, and help you discover a new passion. No experience necessary – spots are limited!</p>
                        </div>

                        <form action="submit.php" method="POST" class="register-form">
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
                                <label style="padding-top:2rem;">Do you have experience spinning?</label>
                                <div class="radio-options">
                                    <label><input type="radio" name="experience" value="yes" required> Yes</label>
                                    <label><input type="radio" name="experience" value="no"> No</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div data-sitekey="<?php echo $_ENV['CF_SITE_KEY']; ?>" class="cf-turnstile"></div>
                                <input type="hidden" name="type" value="class_registration"/>
                            </div>
                            <button type="submit" class="form-submit" style="margin-top:1.2rem;">Register</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>

<?php
include '../inc/footer.php';
?>
    <script src="js/toastr.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
