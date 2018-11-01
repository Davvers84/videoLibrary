<?php
namespace Vibrary\Controllers;

class Controller {

    function __construct() {

    }

    function view($view, $data = array()) {
        return array("view" => $view, "data" => $data);
    }

}