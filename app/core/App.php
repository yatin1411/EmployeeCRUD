<?php
class App{
        private $controller = 'Home';
        private $method = 'index';
        private function splitURL() {
            $url = trim($_GET['url'] ?? 'home', '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }

        public function loadController() {
            $url = $this->splitURL();
            $filename="../app/controllers/".ucfirst($url[0]).".php";
            if(file_exists($filename)){
                require $filename;
                $this->controller = ucfirst($url[0]);
                
                // Set method if provided
                if(isset($url[1])){
                    $this->method = $url[1];
                }
            }
            else{
                $filename="../app/controllers/_404.php";
                require $filename;
                $this->controller="_404";
            }
            $controller = new $this->controller();
            call_user_func_array([$controller, $this->method], []); 
        }
}