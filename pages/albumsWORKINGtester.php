<html lang="HTML5">
<head>    <title>PHP Quick Start</title>  </head>
<body>
<?php

require __DIR__ . '/../vendor/autoload.php';

// Use the Configuration class 
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Search\SearchApi;
use Cloudinary\Api\Admin\AdminApi;
use Cloudinary\Asset\Media;

// Configure an instance of your Cloudinary cloud
Configuration::instance('cloudinary://419125728332653:lcsNjzJuTIIqUQecE902fqLIiF8@dgymss4md?secure=true');

$album = '2025 Season';

$search = new SearchApi();

$res = $search->expression('resource_type:image AND type:upload AND asset_folder="' . addslashes($album) . '"')
    ->withField('tags')
    ->withField('context')
    ->maxResults(500)
    ->execute();

$items = $res['resources'] ?? [];


foreach ($items as $r) {
    $displayName = $r['display_name'] ?? '';
    $caption     = $r['context']['caption'] ?? '';
    $tags        = $r['tags'] ?? [];

    echo "<pre>";
    echo "Display Name: {$displayName}\n";
    echo "Caption: {$caption}\n";
    echo "Tags: " . implode(', ', $tags) . "\n";
    echo "Image URL: {$r['secure_url']}\n";
    echo "</pre>";
}

exit;
