<?php
namespace Vibrary\Controllers;

class HomeController extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        return $this->view("home", array("variable1"=>"value1"));
    }

}