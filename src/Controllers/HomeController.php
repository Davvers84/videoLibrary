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
        return $this->view("home", $this->getPageData());
    }

}