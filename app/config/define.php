<?php

// Load config
require_once __DIR__ . '/config.php';

// URL
define('ROOT', $rootdoc);
define('ROOTURL', $protocol . $host);
define('BASEURL', $protocol . $host . $path);
define('USERURL', $protocol . $host . $path . $rootuser);

// Method dan Index Default
define('HOME', $ENV['METHOD_URL']); //method
define('INDEX', $ENV['INDEX_URL']); //index

// Database
define('DB_HOST', $ENV['DB_HOST']);
define('DB_USER', $ENV['DB_USER']);
define('DB_PASS', $ENV['DB_PASS']);
define('DB_NAME', $ENV['DB_NAME']);

// SALT
// define('SALT_TOKEN', $ENV['SALT_TOKEN']);
define('SALT_API', $ENV['SALT_API']);

// API
define('SERVER_API_KEY', $ENV['SERVER_API_KEY']);
