<?php
namespace Vibrary\Controllers;

class ErrorController extends PageController
{

    function __construct()
    {
        parent::__construct();
    }

    function page()
    {
        return $this->view("error", $this->getPageData());
    }
}
