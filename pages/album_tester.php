<html lang="HTML5">
<head>    <title>PHP Quick Start</title>  </head>
<body>
<?php

require __DIR__ . '/../vendor/autoload.php';

// Use the Configuration class 
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Admin\AdminApi;
use Cloudinary\Asset\Media;

// Configure an instance of your Cloudinary cloud
Configuration::instance('cloudinary://419125728332653:lcsNjzJuTIIqUQecE902fqLIiF8@dgymss4md?secure=true');

$admin = new AdminApi();

$result = $admin->assets([
  'type'          => 'upload',
  'resource_type' => 'image',
  'max_results'   => 50,
]);

$data = $result->getArrayCopy();              // <-- works with your ApiResponse
$items = $data['resources'] ?? [];

echo "<pre>";
var_dump($items);
/*foreach ($items as $r) {
  echo $r['public_id'] . "\n";
}*/
echo "</pre>";
exit;
