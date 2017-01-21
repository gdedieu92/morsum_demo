<?php

class View {

    function __construct() {
        $this->db = new Model;
    }

    private $activeController = null;
    private $activeMethod = null;
    private $viewData = null;

    public function load($name, $information = false, $header = "general/header", $menu = "general/menu", $footer = "general/footer") {
        $this->viewData = $information;
        $file = V_PATH . $name . '.php';
        $header_file = ROOT . "/application/views/" . $header . ".php";
        $menu_file = ROOT . "/application/views/" . $menu . ".php";
        $footer_file = ROOT . "/application/views/" . $footer . ".php";

        if (file_exists($file)) {
            if (file_exists($header_file)) {
                require $header_file;
            }
            if (file_exists($menu_file)) {
                require $menu_file;
            }
            require V_PATH . $name . '.php';
            if (file_exists($footer_file)) {
                require $footer_file;
            }
        } else {
            echo 'view ' . $name . ' not found';
        }
    }

    public function setActiveController($controller) {
        $this->activeController = $controller;
    }

    public function setActiveMethod($method) {
        $this->activeMethod = $method;
    }

    public function getActiveMethod() {
        return $this->activeMethod;
    }

    public function getActiveController() {
        return $this->activeController;
    }

    public function setViewData($data) {
        $this->viewData = $data;
    }

}
