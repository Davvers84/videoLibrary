<?php
namespace Vibrary\Controllers;

class VideosController extends Controller {

    function __construct() {
        parent::__construct();
    }

    function search() {
        return $this->view("videos");
    }

}