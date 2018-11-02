<?php
namespace Vibrary\Controllers;

/**
 * Class ErrorController
 * @package Vibrary\Controllers
 */
class ErrorController extends PageController
{

    /**
     * ErrorController constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array
     */
    function page()
    {
        return $this->view("error", $this->getPageData());
    }
}
