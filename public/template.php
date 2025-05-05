<?php
require '../inc/init.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allegheny Eclipse - [Subpage Title]</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Merriweather:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>
<body>
<?php
include '../inc/navbar.php';
?>
    <section id="subpage-content" class="subpage-content">
        <div class="container">
            <h1>[Subpage Title]</h1>
            <div class="content">
                <!-- Add your subpage-specific content here -->
                <p>This is a placeholder for your subpage content. Replace this with your actual content, which can be hardcoded or dynamically loaded via JSON in the future.</p>
            </div>
        </div>
    </section>

<?php
include '../inc/footer.php';
?>
    <script src="js/scripts.js"></script>
</body>
</html>
