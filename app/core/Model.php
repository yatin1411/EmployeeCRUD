<?php
    class Model {
        protected $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function selectAll($table) {
            $query = "SELECT * FROM $table";
            return $this->db->select($query);
        }

        public function selectOne($table, $id) {
            $query = "SELECT * FROM $table WHERE id = ?";
            return $this->db->selectOne($query, [$id]);
        }

        public function search($table, $column, $keyword) {
            $query = "SELECT * FROM $table WHERE $column LIKE ?";
            return $this->db->select($query, ["%$keyword%"]);
        }

        public function insert($table, $data) {
            return $this->db->insert($table, $data);
        }

        public function update($table, $id, $data) {
            $this->db->update($table, $id, $data);
        }

        public function delete($table, $id) {
            $this->db->delete($table, $id);
        }
    }
