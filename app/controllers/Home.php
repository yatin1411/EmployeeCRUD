<?php
    class Home extends Controller {
        public function index() {
            $data = [
                'isLoggedIn' => isLoggedIn(),
                'user' => getCurrentUser()
            ];
            $this->view('home', $data);
        }
    }