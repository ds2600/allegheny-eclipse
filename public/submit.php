
<?php
/**
 * submit.php
 * Handles contact form submissions, validates input, and saves to a CSV file.
 * Designed for Allegheny Eclipse website.
 */


// Set headers for security and response
//header('Content-Type: application/json');

$config = require '../config.php'; 
error_log($config['sendTo']);
require '../vendor/autoload.php'; 
use PHPMailer\PHPMailer\PHPMailer;

// Initialize response array
$response = ['success' => false, 'message' => ''];

// Validate request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Invalid request method.';
    echo json_encode($response);
    exit;
}

// Get form data
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$comments = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_STRING);

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

if (empty($comments)) {
    $response['message'] = 'Comments are required.';
    echo json_encode($response);
    exit;
}

$mail = new PHPMailer(true);
try {
    $mail->isMail();
    $mail->setFrom($email, $name);
    $mail->addAddress($config['sendTo']);
    $mail->isHTML(false);
    $mail->Subject = 'Contact Form Submission';
    $mail->Body = "Name: $name\nEmail: $email\nComments: $comments";
    $mail->send();
    $response['success'] = true;
    $response['message'] = 'Message sent successfully.';
} catch (Exception $e) {
    $response['message'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    echo json_encode($response);
    exit;
}

header('Location: index.php');
exit;
?>
