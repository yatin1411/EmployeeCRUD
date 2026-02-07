<?php
    require "../app/core/config.php";

    // Error reporting based on environment
    if (defined('APP_HAS_ERRORS') && APP_HAS_ERRORS) {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    } else {
        ini_set('display_errors', 0);
        error_reporting(0);
    }

    // Security headers
    header('X-Frame-Options: DENY');
    header('X-Content-Type-Options: nosniff');
    header('Referrer-Policy: same-origin');
    header("Permissions-Policy: geolocation=()");

    // Enforce HTTPS in production if available
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        $secure = true;
    } else {
        $secure = false;
    }

    // Secure session settings
    session_name('mvc_session');
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => $_SERVER['HTTP_HOST'],
        'secure' => $secure,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();

    require "../app/core/init.php";
    $app = new App();
    $app->loadController();
    