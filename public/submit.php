
<?php
/**
 * submit.php
 * Handles contact form submissions, validates input, and saves to a CSV file.
 * Designed for Allegheny Eclipse website.
 */


// Set headers for security and response
//header('Content-Type: application/json');

require '../inc/init.php';

$config = require '../config.php'; 


header('Content-Type: application/json');

// Initialize response array
$response = ['success' => false, 'message' => ''];

// Validate request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Invalid request method.';
    echo json_encode($response);
    exit;
}

if ($_ENV['CF_ENABLED']) {
    $captcha_response = filter_input(INPUT_POST, 'cf-turnstile-response', FILTER_SANITIZE_STRING);

    if (empty($captcha_response)) {
        $response['message'] = 'Captcha verification failed.';
        echo json_encode($response);
        exit;
    }

    $captcha_secret = $_ENV['CF_SECRET_KEY'];

    $captcha_url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $captcha_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'secret' => $captcha_secret,
        'response' => $captcha_response,
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($ch);
    curl_close($ch);

    $responseKeys = json_decode($curl_response, true);
    if (intval($responseKeys["success"]) !== 1) {
        $response['message'] = 'Captcha verification failed.';
        echo json_encode($response);
        exit;
    }
}

// Get form data
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);


// Server-side validation
if (empty($name)) {
    $response['message'] = 'Name is required.';
    echo json_encode($response);
    exit;
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response['message'] = 'A valid email is required.:';
    echo json_encode($response);
    exit;
}

if (!isset($_POST['type'])) {
    $response['message'] = 'Invalid form submission.';
    echo json_encode($response);
    exit;
} else {
    $formType = $_POST['type'];
}

if ($formType === 'contact') {
    $comments = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_STRING);
    $subject = "Comment Form";
    $body = "Name: $name\nEmail: $email\nComments: $comments\n"; 
    $formType = 'Message';
} elseif ($formType === 'class_registration') {
    $experience = filter_input(INPUT_POST, 'experience', FILTER_SANITIZE_STRING); 
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $subject = "Spin Clinic Registration";
    $body = "Name: $name\nEmail: $email\nPhone: $phone\nExperience: $experience\n";
    $formType = 'Spin Clinic Registration';
} elseif ($formType ==='sign_up_list') {
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $subject = "Sign Up List";
    $body = "Name: $name\nEmail: $email\nPhone: $phone\n";
    $formType = 'Sign Up List';
} else {
    $response['message'] = 'Invalid form type.';
    echo json_encode($response);
    exit;
}

if (isset($response['message']) && !empty($response['message'])) {
    echo json_encode($response);
    exit;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if ($_ENV['SMTP_ENABLED']) {
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['SMTP_USER'];
        $mail->Password = $_ENV['SMTP_PASS'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $_ENV['SMTP_PORT'];

        $mail->setFrom($_ENV['SMTP_FROM_EMAIL'], $_ENV['SMTP_FROM_NAME']);
        $mail->addAddress($_ENV['SMTP_TO_EMAIL']);
        $mail->isHTML(false);
        
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->send();
        $response['success'] = true;
        $response['message'] = 'Message sent successfully.';
        echo json_encode($response);
        exit;
    } catch (Exception $e) {
        $response['message'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        echo json_encode($response);
        exit;
    }
} else {
    $response['success'] = true;
    $response['message'] = 'Email sending is disabled in the configuration.';
    error_log($body,0); 
    echo json_encode($response);
    exit;
}

//header('Location: index.php');
exit;
?>
