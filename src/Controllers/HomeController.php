<?php
namespace Vibrary\Controllers;

use Vibrary\Models\User;
use Vibrary\Repositories\User\UserRepository;
use Vibrary\Services\oAuthService;
use Vibrary\Services\UserService;

class HomeController extends Controller {

    protected $oAuthService;

    function __construct() {
        parent::__construct();
        // @todo replace with true dependancy injection
        $userModel = new User();
        $userRepo = new UserRepository($userModel);
        $userService = new UserService($userRepo);
        $this->oAuthService = new oAuthService($userService);
    }

    function index() {
        $data = array();

        if($this->oAuthService->authenticate()) {
            $userData = $this->oAuthService->getUserData();

            $data = array(
                "user" => array(
                    "name" => $userData->name,
                    "email" => $userData->email,
                )
            );
        }

        return $this->view("home", $data);
    }

}