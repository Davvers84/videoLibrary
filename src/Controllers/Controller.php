<?php
namespace Vibrary\Controllers;

use Vibrary\Models\User;
use Vibrary\Repositories\User\UserRepository;
use Vibrary\Services\oAuthService;
use Vibrary\Services\UserService;

class Controller {

    protected $oAuthService;
    protected $userService;
    public $userData;
    public $pageData;

    function __construct() {
        // @todo replace with true dependancy injection
        $userModel = new User();
        $userRepo = new UserRepository($userModel);
        $this->userService = new UserService($userRepo);
        $this->oAuthService = new oAuthService($this->userService);
        $this->getAuthenticatedUser();
    }

    function getAuthenticatedUser() {
        if($this->oAuthService->authenticate()) {
            $this->userData = $this->oAuthService->getUserData();
        }
    }

    function addUserPageData() {
        if($this->userData) {
            $this->addPageData(
                'user'
                , array(
                    "id" => $this->userData['user']->id,
                    "name" => $this->userData['oAuth']->name,
                    "email" => $this->userData['oAuth']->email,
                    )
            );
        }
    }

    function setMessages() {
        $this->setSuccessMessage();
        $this->setErrorMessage();
    }

    function setSuccessMessage($message = '') {
        if($message) {
            $this->addPageData('successMessage', $message);
        } else if(array_key_exists('success_message', $_SESSION)) {
            $this->addPageData('successMessage', $_SESSION['success_message']);
        }
        unset($_SESSION['success_message']);
    }

    function setErrorMessage($message = '') {
        if($message) {
            $this->addPageData('errorMessage', $message);
        } else if(array_key_exists('error_message', $_SESSION)) {
            $this->addPageData('errorMessage', $_SESSION['error_message']);
        }
        unset($_SESSION['error_message']);
    }

    function addPageData($key, $data) {
        $this->pageData[$key] = $data;
    }

    function getPageData() {
        $this->addUserPageData();
        $this->setMessages();
        return $this->pageData;
    }

    function view($view, $data = array()) {
        return array("view" => $view, "data" => $data);
    }

}