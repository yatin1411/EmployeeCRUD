<?php
    class UserModel extends Model {
        protected $table = 'users';

        public function getUserByEmail($email) {
            $query = "SELECT * FROM {$this->table} WHERE email = ?";
            return $this->db->selectOne($query, [$email]);
        }

        public function register($data) {
            $data['name'] = sanitize($data['name']);
            $data['email'] = sanitize($data['email']);
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            unset($data['password_confirm']);
            return $this->insert($this->table, $data);
        }

        public function login($email, $password) {
            $user = $this->getUserByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }
            return false;
        }
    }
