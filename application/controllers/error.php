<?php

class Error_Controller extends A_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        die('index error');
    }

    public function noFound() {
        die('no found');
    }

    public function noAuthorized() {
        die('no authorized');
    }

}
