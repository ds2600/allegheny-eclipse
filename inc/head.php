<?php
$page_title     = $page_title     ?? 'Allegheny Eclipse - Warren, Pennsylvania Adult Color Guard';
$page_desc      = $page_desc      ?? 'Allegheny Eclipse is an adult color guard based in Warren, PA. Join us and experience the excitement, creativity, and energy of performance art.';
$canonical      = $canonical      ?? 'https://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'], '?');
$theme_color    = $theme_color    ?? '#85598E'; // Primary purple
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo htmlspecialchars($page_title); ?></title>
<meta name="description" content="<?php echo htmlspecialchars($page_desc); ?>">
<link rel="canonical" href="<?php echo htmlspecialchars($canonical); ?>">

<!-- Standard Meta -->
<meta name="robots" content="index, follow">
<meta name="author" content="Allegheny Eclipse">
<meta name="theme-color" content="<?php echo htmlspecialchars($theme_color); ?>">

<!-- Styles -->
<link rel="stylesheet" href="/css/styles.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Merriweather:wght@400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-papOY1xwKAV3qvR3rKXyUjkM51FgNmjV+e5OB/aDncckGiAvkC+z8a+pgbzhm8qZKhTe2bPaDPlN+QXnS6Ut/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

<!-- Favicons -->
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">

<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $_ENV['GA_TRACKING_ID']; ?>"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', '<?php echo $_ENV['GA_TRACKING_ID']; ?>');
</script>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

