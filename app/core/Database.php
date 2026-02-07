<?php
    class Database {
        private $pdo;

        public function __construct() {
            try {
                $this->pdo = new PDO(
                    'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
                    DB_USER,
                    DB_PASS
                );
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die('Database Connection Failed: ' . $e->getMessage());
            }
        }

        public function query($query, $params = []) {
            try {
                $stmt = $this->pdo->prepare($query);
                if (!empty($params)) {
                    $stmt->execute($params);
                } else {
                    $stmt->execute();
                }
                return $stmt;
            } catch (PDOException $e) {
                die('Query Failed: ' . $e->getMessage());
            }
        }

        public function select($query, $params = []) {
            $result = $this->query($query, $params);
            return $result->fetchAll();
        }

        public function selectOne($query, $params = []) {
            $result = $this->query($query, $params);
            return $result->fetch();
        }

        public function insert($table, $data) {
            $columns = implode(', ', array_keys($data));
            $placeholders = implode(', ', array_fill(0, count($data), '?'));
            $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
            $this->query($query, array_values($data));
            return $this->pdo->lastInsertId();
        }

        public function update($table, $id, $data) {
            $setClause = implode(', ', array_map(fn($col) => "$col = ?", array_keys($data)));
            $query = "UPDATE $table SET $setClause WHERE id = ?";
            $params = array_merge(array_values($data), [$id]);
            $this->query($query, $params);
        }

        public function delete($table, $id) {
            $query = "DELETE FROM $table WHERE id = ?";
            $this->query($query, [$id]);
        }
    }
