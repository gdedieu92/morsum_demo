<?php

class Panel_Controller extends A_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->view->load('panel/index');
    }

}
