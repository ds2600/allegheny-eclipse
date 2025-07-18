<?php
require '../inc/init.php';
$config = require '../config.php';

// Load environment variables safely
$maintenanceMode = $_ENV['MAINTENANCE_MODE'] === 'true';

if ($maintenanceMode) {
    header('Location: /maintenance.html');
    exit;
}

//$url = isset($_GET['url']) ? trim(filter_var($_GET['url'], FILTER_SANITIZE_URL), '/') : '';
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url = trim($uri, '/');
$segments = $url !== '' ? explode('/', $url) : [];

// Define route structure
$routes = [
    '' => ['file' => 'home.php'],
    'signup' => ['file' => 'signup.php'],
    'class-register' => ['file' => 'class-register.php'],
    'error' => ['file' => 'error.php'],

    // Dynamic routes
    'profile' => ['file' => 'profile.php', 'params' => ['name']],
    'event' => ['file' => 'event.php', 'params' => ['id']],
];

$dashRoutes = [
    '' => ['file' => 'home.php'],
    'login' => ['file' => 'login.php'],
    'logout' => ['file' => 'logout.php']
];



// Get the first segment as route key
$routeKey = $segments[0] ?? '';

// Handle known route
if (isset($routes[$routeKey]) && $routeKey !== 'dash') {
    $route = $routes[$routeKey];
    $filePath = "../pages/{$route['file']}";

    if (file_exists($filePath)) {
        // Extract dynamic parameters, if any
        $params = [];
        if (!empty($route['params'])) {
            foreach ($route['params'] as $i => $paramName) {
                $params[$paramName] = $segments[$i + 1] ?? null;
            }
        }

        // Pass parameters to included page
        require $filePath;
        exit;
    }
}

if ($routeKey === 'dash') {
    $dashSubKey = $segments[1] ?? '';

    if (isset($dashRoutes[$dashSubKey])) {
        $route = $dashRoutes[$dashSubKey];
        $filePath = "../pages/dash/{$route['file']}";

        if (file_exists($filePath)) {
            $params = [];
            if (!empty($route['params'])) {
                foreach ($route['params'] as $i => $paramName) {
                    $params[$paramName] = $segments[$i + 2] ?? null; 
                }
            }

            require $filePath;
            exit;
        }
    }
}

// Fallback: 404
http_response_code(404);
require '../pages/error.php';
exit;

