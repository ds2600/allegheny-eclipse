<?php
require '../inc/init.php';
$config = require '../config.php'; 

if ($_ENV['MAINTENANCE_MODE'] === 'true') {
    header('Location: /maintenance.html');
    exit;
}

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
switch ($url) {
    case '':
        require '../pages/home.php';
        break;
    case 'class-register':
        require '../pages/class-register.php';
        break;
    case 'signup':
        require '../pages/signup.php';
        break;
    case 'error':
        require '../pages/error.php';
        break;
    default:
        header('Location: /index.php?url=error&code=404');
        exit;
}
