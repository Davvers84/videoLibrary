<?php
namespace Vibrary\Controllers;

/**
 * Class AuthController
 * @package Vibrary\Controllers
 */
class AuthController extends Controller
{

    /**
     * AuthController constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $response
     * @return mixed
     */
    function callback($response)
    {
        $this->oAuthService->callback($response);
        return $this->view("home", array("variable1"=>"Signed in from GOOGLE!"));
    }

    /**
     * @return mixed
     */
    function google()
    {
        $this->oAuthService->redirect();
        return $this->view("home");
    }

    /**
     *
     */
    function signout()
    {
        session_destroy();
        header('Location: ' . filter_var(getenv('APP_URL'), FILTER_SANITIZE_URL));
        exit;
    }
}
