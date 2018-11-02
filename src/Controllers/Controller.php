<?php
namespace Vibrary\Controllers;

use Vibrary\Models\User;
use Vibrary\Repositories\User\UserRepository;
use Vibrary\Services\oAuthService;
use Vibrary\Services\UserService;

class Controller
{

    protected $oAuthService;
    protected $userService;

    function __construct()
    {
        // @todo replace with true dependancy injection
        $userModel = new User();
        $userRepo = new UserRepository($userModel);
        $this->userService = new UserService($userRepo);
        $this->oAuthService = new oAuthService($this->userService);
        $this->getAuthenticatedUser();
    }

    function getAuthenticatedUser()
    {
        if ($this->oAuthService->authenticate()) {
            $this->userData = $this->oAuthService->getUserData();
        }
    }
}
