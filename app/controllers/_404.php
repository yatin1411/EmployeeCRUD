<?php
// 404 Not Found controller
// This handles any URL that doesn't match a controller file

class _404 extends Controller {
    public function index() {
        // Display the 404 page template
        $this->view('_404');
    }
}