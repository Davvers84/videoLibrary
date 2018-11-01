<?php
namespace Vibrary\Controllers;

use Vibrary\Services\VideosService;

class VideosController extends Controller {

    function __construct() {
        parent::__construct();
    }

    function search() {
        $service = new VideosService();
        return $this->view("videos");
    }

}