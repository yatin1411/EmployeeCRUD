<?php
    require "../app/models/UserModel.php";

    class Auth extends Controller {
        private $model;

        public function __construct() {
            $this->model = new UserModel();
        }

        // Show login form
        public function login() {
            if (isLoggedIn()) {
                redirect('home');
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // CSRF validation
                $token = $_POST['csrf_token'] ?? '';
                if (!verify_csrf_token($token)) {
                    flash('error_message', 'Invalid request (CSRF).');
                    redirect('auth/login');
                }

                $email = sanitize($_POST['email'] ?? '');
                $password = $_POST['password'] ?? '';

                if (empty($email) || empty($password)) {
                    flash('error_message', 'Email and password are required!');
                } else {
                    $user = $this->model->login($email, $password);
                    if ($user) {
                        // prevent session fixation
                        session_regenerate_id(true);
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['user'] = $user['name'];
                        flash('success_message', 'Login successful!');
                        redirect('home');
                    } else {
                        flash('error_message', 'Invalid email or password!');
                    }
                }
            }
            // prevent caching of the login page so browser back button requests server
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                header('Cache-Control: no-cache, no-store, must-revalidate');
                header('Pragma: no-cache');
                header('Expires: 0');
            }
            $this->view('auth/login');
        }

        // Show register form
        public function register() {
            if (isLoggedIn()) {
                redirect('home');
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // CSRF validation
                $token = $_POST['csrf_token'] ?? '';
                if (!verify_csrf_token($token)) {
                    flash('error_message', 'Invalid request (CSRF).');
                    redirect('auth/register');
                }
                $data = [
                    'name' => $_POST['name'] ?? '',
                    'email' => $_POST['email'] ?? '',
                    'password' => $_POST['password'] ?? '',
                    'password_confirm' => $_POST['password_confirm'] ?? ''
                ];

                // Validation
                if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
                    flash('error_message', 'All fields are required!');
                } else if (!validateEmail($data['email'])) {
                    flash('error_message', 'Invalid email format!');
                } else if (!validatePassword($data['password'])) {
                    flash('error_message', 'Password must be at least 6 characters!');
                } else if ($data['password'] !== $data['password_confirm']) {
                    flash('error_message', 'Passwords do not match!');
                } else if ($this->model->getUserByEmail($data['email'])) {
                    flash('error_message', 'Email already exists!');
                } else {
                    $this->model->register($data);
                    flash('success_message', 'Registration successful! Please login.');
                    redirect('auth/login');
                }
            }
            // prevent caching of the register page so browser back button requests server
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                header('Cache-Control: no-cache, no-store, must-revalidate');
                header('Pragma: no-cache');
                header('Expires: 0');
            }
            $this->view('auth/register');
        }

        // Logout
        public function logout() {
            session_destroy();
            redirect('home');
        }
    }
