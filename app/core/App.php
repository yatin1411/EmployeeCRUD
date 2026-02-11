<?php
// Router - directs traffic to the right controller and method

class App {
    private $controller = 'Home';
    private $method = 'index';
    
    // Split the URL into parts
    private function splitURL() {
        $url = trim($_GET['url'] ?? 'home', '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return explode('/', $url);
    }

    public function loadController() {
        $url = $this->splitURL();
        $filename = "../app/controllers/" . ucfirst($url[0]) . ".php";
        
        // Check if controller file exists
        if (file_exists($filename)) {
            require $filename;
            $this->controller = ucfirst($url[0]);
            
            // Set method if provided in URL
            if (isset($url[1])) {
                $this->method = $url[1];
            }
        } else {
            // Controller not found - show 404 page
            $filename = "../app/controllers/_404.php";
            require $filename;
            $this->controller = "_404";
        }
        
        // Create an instance of the controller and call the method
        $controller = new $this->controller();
        
        // Check if the method exists before calling it
        if (method_exists($controller, $this->method)) {
            call_user_func_array([$controller, $this->method], []);
        } else {
            // Method doesn't exist in controller - show 404 page
            require "../app/controllers/_404.php";
            $controller = new _404();
            $controller->index();
        }
    }
}