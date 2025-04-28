<?php

require '../vendor/autoload.php'; 

if (!file_exists(__DIR__ . '/../.env')) {
    throw new Exception('Missing .env file. Please create one based on the .env.example file.');
}

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/..');
$dotenv->load();




