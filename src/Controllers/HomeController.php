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
    }

    function index() {
        $data = array();
        if($this->userData) {
            $data = array(
                "user" => array(
                    "name" => $this->userData->name,
                    "email" => $this->userData->email,
                )
            );
        }
        return $this->view("home", $data);
    }

}