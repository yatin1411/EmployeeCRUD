<?php
    // Sanitize input
    function sanitize($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    // Validate email
    function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Check if user is logged in
    function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    // Get current user
    function getCurrentUser() {
        return $_SESSION['user'] ?? null;
    }

    // Redirect to page
    function redirect($page) {
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $base = $_SERVER['HTTP_HOST'] . (defined('APP_BASE_PATH') ? APP_BASE_PATH : '/EmployeeCRUD/public/index.php');
        $url = $scheme . '://' . $base . '?url=' . $page;
        header('Location: ' . $url, true, 302);
        exit;
    }

    // Flash message
    function flash($name = '', $message = '', $delete = false) {
        if ($name != '') {
            if ($message != '') {
                $_SESSION[$name] = $message;
            } else if (isset($_SESSION[$name])) {
                $msg = $_SESSION[$name];
                if ($delete) {
                    unset($_SESSION[$name]);
                }
                return $msg;
            }
        }
        return '';
    }

    // Display flash message
    function displayFlash($name) {
        $message = flash($name, '', true);
        if ($message != '') {
            echo '<div class="alert alert-info">' . htmlspecialchars($message) . '</div>';
        }
    }

    // CSRF helpers
    function generate_csrf_token() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    function csrf_input_field() {
        $token = generate_csrf_token();
        return '<input type="hidden" name="csrf_token" value="' . $token . '" />';
    }

    function verify_csrf_token($token) {
        if (empty($_SESSION['csrf_token'])) return false;
        return hash_equals($_SESSION['csrf_token'], $token);
    }

    // Validate password strength
    function validatePassword($password) {
        return strlen($password) >= 6;
    }
