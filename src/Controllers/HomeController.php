<?php
namespace Vibrary\Controllers;

class HomeController extends PageController
{

    protected $oAuthService;

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        return $this->view("home", $this->getPageData());
    }
}
