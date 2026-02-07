<?php
    require "../app/models/EmployeeModel.php";

    class Employees extends Controller {
        private $model;

        public function __construct() {
            $this->model = new EmployeeModel();
            // Check if user is logged in
            if (!isLoggedIn()) {
                flash('error_message', 'You must be logged in to access this page!');
                redirect('auth/login');
            }
        }

        // Display all employees
        public function index() {
            $employees = $this->model->getAllEmployees();
            $this->view('employees/index', ['employees' => $employees, 'user' => getCurrentUser()]);
        }

        // Show add employee form
        public function add() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = [
                    'name' => $_POST['name'] ?? '',
                    'email' => $_POST['email'] ?? '',
                    'position' => $_POST['position'] ?? '',
                    'salary' => $_POST['salary'] ?? 0
                ];

                // Validate inputs
                if (empty($data['name']) || empty($data['email'])) {
                    flash('error_message', 'Name and Email are required!');
                } else if (!validateEmail($data['email'])) {
                    flash('error_message', 'Invalid email format!');
                } else {
                    $this->model->addEmployee($data);
                    flash('success_message', 'Employee added successfully!');
                    redirect('employees');
                }
            }
            $this->view('employees/add');
        }

        // Show edit employee form
        public function edit() {
            $id = $_GET['id'] ?? 0;
            $employee = $this->model->getEmployeeById($id);

            if (!$employee) {
                redirect('employees');
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = [
                    'name' => $_POST['name'] ?? '',
                    'email' => $_POST['email'] ?? '',
                    'position' => $_POST['position'] ?? '',
                    'salary' => $_POST['salary'] ?? 0
                ];

                if (empty($data['name']) || empty($data['email'])) {
                    flash('error_message', 'Name and Email are required!');
                } else if (!validateEmail($data['email'])) {
                    flash('error_message', 'Invalid email format!');
                } else {
                    $this->model->editEmployee($id, $data);
                    flash('success_message', 'Employee updated successfully!');
                    redirect('employees');
                }
            }

            $this->view('employees/edit', ['employee' => $employee]);
        }

        // Delete employee
        public function delete() {
            $id = $_GET['id'] ?? 0;
            $employee = $this->model->getEmployeeById($id);

            if ($employee) {
                $this->model->deleteEmployee($id);
                flash('success_message', 'Employee deleted successfully!');
            }

            redirect('employees');
        }

        // Search employees
        public function search() {
            $keyword = $_GET['keyword'] ?? '';
            $employees = [];

            if (!empty($keyword)) {
                $employees = $this->model->searchEmployees($keyword);
            }

            $this->view('employees/search', ['employees' => $employees, 'keyword' => $keyword]);
        }
    }