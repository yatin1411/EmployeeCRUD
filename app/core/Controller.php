<?php
    class Controller {
        public function view($name, $data = []) {
            $filename="../app/views/".$name.".view.php";
            if(file_exists($filename)){
                extract($data); //converts keys to var
                require $filename;       
            }
            else{
                $filename="../app/views/_404.view.php";
                require $filename;
            }
        }
    }