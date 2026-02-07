<?php
    require "../app/models/EmployeeModel.php";
    require "../app/models/UserModel.php";

    class Api extends Controller {
        private $employeeModel;
        private $userModel;

        public function __construct() {
            $this->employeeModel = new EmployeeModel();
            $this->userModel = new UserModel();
            header('Content-Type: application/json');
        }

        // Set response status and send JSON
        private function response($data, $status = 200) {
            http_response_code($status);
            echo json_encode($data);
            exit;
        }

        // Login API
        public function login() {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                $this->response(['message' => 'Method not allowed'], 405);
            }

            $input = json_decode(file_get_contents('php://input'), true);
            $email = $input['email'] ?? '';
            $password = $input['password'] ?? '';

            if (empty($email) || empty($password)) {
                $this->response(['message' => 'Email and password are required'], 400);
            }

            $user = $this->userModel->login($email, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user'] = $user['name'];
                $this->response(['message' => 'Login successful', 'user' => $user], 200);
            } else {
                $this->response(['message' => 'Invalid credentials'], 401);
            }
        }

        // Get all employees
        public function employees() {
            if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
                $this->response(['message' => 'Method not allowed'], 405);
            }

            // Check authentication
            if (!isLoggedIn()) {
                $this->response(['message' => 'Unauthorized. Please login first.'], 401);
            }

            $employees = $this->employeeModel->getAllEmployees();
            $this->response(['data' => $employees, 'count' => count($employees)], 200);
        }

        // Get single employee
        public function getEmployee() {
            if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
                $this->response(['message' => 'Method not allowed'], 405);
            }

            // Check authentication
            if (!isLoggedIn()) {
                $this->response(['message' => 'Unauthorized. Please login first.'], 401);
            }

            $id = $_GET['id'] ?? 0;
            if (empty($id)) {
                $this->response(['message' => 'Employee ID is required'], 400);
            }

            $employee = $this->employeeModel->getEmployeeById($id);
            if (!$employee) {
                $this->response(['message' => 'Employee not found'], 404);
            }

            $this->response(['data' => $employee], 200);
        }

        // Create employee
        public function addEmployee() {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                $this->response(['message' => 'Method not allowed'], 405);
            }

            // Check authentication
            if (!isLoggedIn()) {
                $this->response(['message' => 'Unauthorized. Please login first.'], 401);
            }

            $input = json_decode(file_get_contents('php://input'), true);
            $name = $input['name'] ?? '';
            $email = $input['email'] ?? '';
            $position = $input['position'] ?? '';
            $salary = $input['salary'] ?? 0;

            if (empty($name) || empty($email)) {
                $this->response(['message' => 'Name and email are required'], 400);
            }

            if (!validateEmail($email)) {
                $this->response(['message' => 'Invalid email format'], 400);
            }

            $id = $this->employeeModel->addEmployee([
                'name' => $name,
                'email' => $email,
                'position' => $position,
                'salary' => $salary
            ]);

            $this->response(['message' => 'Employee created successfully', 'id' => $id], 201);
        }

        // Update employee
        public function updateEmployee() {
            if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
                $this->response(['message' => 'Method not allowed'], 405);
            }

            // Check authentication
            if (!isLoggedIn()) {
                $this->response(['message' => 'Unauthorized. Please login first.'], 401);
            }

            $input = json_decode(file_get_contents('php://input'), true);
            $id = $input['id'] ?? 0;
            $name = $input['name'] ?? '';
            $email = $input['email'] ?? '';
            $position = $input['position'] ?? '';
            $salary = $input['salary'] ?? 0;

            if (empty($id)) {
                $this->response(['message' => 'Employee ID is required'], 400);
            }

            $employee = $this->employeeModel->getEmployeeById($id);
            if (!$employee) {
                $this->response(['message' => 'Employee not found'], 404);
            }

            if (!validateEmail($email)) {
                $this->response(['message' => 'Invalid email format'], 400);
            }

            $this->employeeModel->editEmployee($id, [
                'name' => $name,
                'email' => $email,
                'position' => $position,
                'salary' => $salary
            ]);

            $this->response(['message' => 'Employee updated successfully'], 200);
        }

        // Delete employee
        public function deleteEmployee() {
            if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
                $this->response(['message' => 'Method not allowed'], 405);
            }

            // Check authentication
            if (!isLoggedIn()) {
                $this->response(['message' => 'Unauthorized. Please login first.'], 401);
            }

            $input = json_decode(file_get_contents('php://input'), true);
            $id = $input['id'] ?? 0;

            if (empty($id)) {
                $this->response(['message' => 'Employee ID is required'], 400);
            }

            $employee = $this->employeeModel->getEmployeeById($id);
            if (!$employee) {
                $this->response(['message' => 'Employee not found'], 404);
            }

            $this->employeeModel->deleteEmployee($id);
            $this->response(['message' => 'Employee deleted successfully'], 200);
        }

        // Search employees
        public function search() {
            if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
                $this->response(['message' => 'Method not allowed'], 405);
            }

            // Check authentication
            if (!isLoggedIn()) {
                $this->response(['message' => 'Unauthorized. Please login first.'], 401);
            }

            $keyword = $_GET['keyword'] ?? '';
            if (empty($keyword)) {
                $this->response(['message' => 'Keyword is required'], 400);
            }

            $results = $this->employeeModel->searchEmployees($keyword);
            $this->response(['data' => $results, 'count' => count($results)], 200);
        }
    }
