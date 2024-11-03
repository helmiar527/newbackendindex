<?php
// Load semua define
require_once 'config/define.php';

// Auto load semua class dengan namespace
spl_autoload_register(function ($class) {
    // Ubah namespace separator ke directory separator
    $class = str_replace('\\', '/', $class);

    // Base directory untuk class
    $base_dir = __DIR__ . '/';

    // Path lengkap ke file class
    $file = $base_dir . $class . '.php';

    // Jika file exists, load file tersebut
    if (file_exists($file)) {
        require_once $file;
    }
});
