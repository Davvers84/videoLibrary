<?php
namespace Vibrary\Controllers;

class CallbackController extends Controller {

    function __construct() {
        parent::__construct();
    }

    function google() {
        return $this->view("home", array("variable1"=>"GOOGLE!"));
    }

}