<?php
// Get error code and message from query parameters, with defaults
$errorCode = isset($_GET['code']) ? (int)$_GET['code'] : 500;
$errorMessage = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : 'An unexpected error occurred.';

// Common error messages
$messages = [
    404 => 'Page Not Found',
    500 => 'Internal Server Error',
];
$displayMessage = isset($messages[$errorCode]) ? $messages[$errorCode] : $errorMessage;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error <?php echo $errorCode; ?> - Allegheny Eclipse</title>
    <style>
        :root {
            --primary-purple: #85598E;
            --dark-purple: #220F28;
            --gold: #C08E2D;
            --text-light: #E0E0E0;
            --white: #FFFFFF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Merriweather', serif;
            color: var(--text-light);
            background: linear-gradient(to bottom, var(--primary-purple), var(--dark-purple));
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            line-height: 1.6;
        }

        .error-container {
            max-width: 600px;
            padding: 20px;
            margin: 20px;
        }

        h1 {
            font-family: 'Poppins', sans-serif;
            color: var(--gold);
            font-size: 2.5rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: var(--text-light);
        }

        .logo {
            max-width: 200px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .home-link {
            display: inline-block;
            padding: 12px 24px;
            background: var(--gold);
            color: var(--dark-purple);
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .home-link:hover {
            background: var(--white);
            color: var(--primary-purple);
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 2rem;
            }
            p {
                font-size: 1rem;
            }
            .logo {
                max-width: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <img src="/img/logo.png" alt="Allegheny Eclipse Logo" class="logo">
        <h1>Error <?php echo $errorCode; ?></h1>
        <p><?php echo $displayMessage; ?></p>
        <p>Sorry for the inconvenience. Let's get you back on track!</p>
        <a href="/" class="home-link">Return to Home</a>
    </div>
</body>
</html>
