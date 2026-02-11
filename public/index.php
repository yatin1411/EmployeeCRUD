<?php
    require "../app/core/config.php";

    // Error handling
    if (defined('APP_HAS_ERRORS') && APP_HAS_ERRORS) {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    } else {
        ini_set('display_errors', 0);
        error_reporting(0);
    }
    
    // Start secure session for user login
    session_name('employee_session');
    session_set_cookie_params([
        'lifetime' => 0,          // Session expires when browser closes
        'path' => '/',            // Cookie available everywhere on this site
        'httponly' => true,       // Prevent JavaScript from accessing session
        'samesite' => 'Lax'       // CSRF protection
    ]);
    session_start();

    // Load app
    require "../app/core/init.php";
    $app = new App();
    $app->loadController();
    