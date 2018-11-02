<?php
namespace Vibrary\Controllers;

/**
 * Class HomeController
 * @package Vibrary\Controllers
 */
class HomeController extends PageController
{

    /**
     * HomeController constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array
     */
    function index()
    {
        return $this->view("home", $this->getPageData());
    }
}
