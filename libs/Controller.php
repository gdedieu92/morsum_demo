<?php

/* MAIN CONTROLLER */

class A_Controller {

    public $post = null;

    function __construct() {
        $this->view = new View();
        $this->post = returnPOSTArray();
    }

    public function loadModel($name) {
        $file = M_PATH . $name . '.php';
        if (file_exists($file)) {
            require $file;
            $nx = ucfirst($name);
            $this->{$name} = new $nx;
        } else {
            echo 'Model ' . $name . '  not found';
        }
    }

    function index() {
        die('A_Controller index');
    }

}
