<?php
require '../inc/init.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allegheny Eclipse - Spin Class Registration</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Merriweather:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
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
    <script src="js/scripts.js"></script>
</body>
</html>
