<?php
namespace Vibrary\Controllers;

use Vibrary\Services\oAuthService;

class AuthController extends Controller {

    protected $oAuthService;

    function __construct() {
        parent::__construct();
        $this->oAuthService = new oAuthService();
    }

    function callback($response) {
        $this->oAuthService->callback($response);
        return $this->view("home", array("variable1"=>"Signed in from GOOGLE!"));
    }

    function google() {
        $this->oAuthService->redirect();
        return $this->view("home");
    }

}