
<?php
/**
 * submit.php
 * Handles contact form submissions, validates input, and saves to a CSV file.
 * Designed for Allegheny Eclipse website.
 */

// Set headers for security and response
header('Content-Type: application/json');

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
    $response['message'] = 'A valid email is required.';
    echo json_encode($response);
    exit;
}

if (empty($comments)) {
    $response['message'] = 'Comments are required.';
    echo json_encode($response);
    exit;
}

// Prepare data for CSV
$csvFile = 'data/submissions.csv';
$data = [
    date('Y-m-d H:i:s'), // Timestamp
    $name,
    $email,
    $comments
];

// Ensure CSV file exists and has headers
if (!file_exists($csvFile)) {
    $headers = ['Timestamp', 'Name', 'Email', 'Comments'];
    $file = fopen($csvFile, 'w');
    fputcsv($file, $headers);
    fclose($file);
}

// Append data to CSV
$file = fopen($csvFile, 'a');
fputcsv($file, $data);
fclose($file);

// Send success response
$response['success'] = true;
$response['message'] = 'Thank you for your message! We will get back to you soon.';
echo json_encode($response);
exit;
?>
