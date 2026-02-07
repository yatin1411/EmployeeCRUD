<?php
    class EmployeeModel extends Model {
        protected $table = 'employees';

        public function getAllEmployees() {
            return $this->selectAll($this->table);
        }

        public function getEmployeeById($id) {
            return $this->selectOne($this->table, $id);
        }

        public function searchEmployees($keyword) {
            $query = "SELECT * FROM {$this->table} WHERE name LIKE ? OR email LIKE ? OR position LIKE ? OR id LIKE ?";
            $params = ["%$keyword%", "%$keyword%", "%$keyword%", "%$keyword%"];
            return $this->db->select($query, $params);
        }

        public function addEmployee($data) {
            $data['name'] = sanitize($data['name']);
            $data['email'] = sanitize($data['email']);
            $data['position'] = sanitize($data['position']);
            return $this->insert($this->table, $data);
        }

        public function editEmployee($id, $data) {
            $data['name'] = sanitize($data['name']);
            $data['email'] = sanitize($data['email']);
            $data['position'] = sanitize($data['position']);
            $this->update($this->table, $id, $data);
        }

        public function deleteEmployee($id) {
            $this->delete($this->table, $id);
        }
    }
