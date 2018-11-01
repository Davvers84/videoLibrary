<?php
namespace Vibrary\Controllers;

use Vibrary\Services\oAuthService;

class RedirectController extends Controller {

    protected $oAuthService;

    function __construct() {
        parent::__construct();
        $this->oAuthService = new oAuthService();
    }

    function google() {
        $this->oAuthService->authUser();
        return $this->view("home", array("variable1"=>"Redirecting to Google!"));
    }

}