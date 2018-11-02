<?php
namespace Vibrary\Controllers;

use Vibrary\Models\User;
use Vibrary\Repositories\User\UserRepository;
use Vibrary\Services\oAuthService;
use Vibrary\Services\UserService;

class AuthController extends Controller {

    protected $oAuthService;

    function __construct() {
        parent::__construct();
        // @todo replace with true dependancy injection
        $userModel = new User();
        $userRepo = new UserRepository($userModel);
        $userService = new UserService($userRepo);
        $this->oAuthService = new oAuthService($userService);
    }

    function callback($response) {
        $this->oAuthService->callback($response);
        return $this->view("home", array("variable1"=>"Signed in from GOOGLE!"));
    }

    function google() {
        $this->oAuthService->redirect();
        return $this->view("home");
    }

    function signout() {
        session_destroy();
        header('Location: ' . filter_var(getenv('APP_URL'), FILTER_SANITIZE_URL));
    }

}