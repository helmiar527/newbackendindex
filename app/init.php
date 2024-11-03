<?php
// Load semua define
require_once __DIR__ . '/config/define.php';
// Auto load semua class yang ada di core
spl_autoload_register(function ($class) {
    $class = explode('\\', $class);
    $class = end($class);
    require_once __DIR__ . '/systems/' . $class . '.php';
});
