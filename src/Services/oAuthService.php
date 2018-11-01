<?php
namespace Vibrary\Services;

require ROOTPATH . '/vendor/autoload.php';

use League\OAuth2\Client\Provider\Google;
use Vibrary\Models\User;
use Vibrary\Repositories\User\UserRepository;


class oAuthService {

    protected $userService;

    protected $provider;

    function __construct() {
        // @todo replace with true dependancy injection
        $userModel = new User();
        $userRepo = new UserRepository($userModel);
        $this->userService = new UserService($userRepo);

        $this->provider = new \League\OAuth2\Client\Provider\Google([
            'clientId'     => getenv('GOOGLE_CLIENT_ID'),
            'clientSecret' => getenv('GOOGLE_CLIENT_SECRET'),
            'redirectUri'  => getenv('GOOGLE_REDIRECT'),
            'hostedDomain' => 'enta.net', // optional; used to restrict access to users on your G Suite/Google Apps for Business accounts
        ]);        
    }

    function callback($response) {


        // @todo
        // get email from google oauth response
        // Check if user exists in the database
        //      If yes then update remember token
        //      If no then create user with email and remember token

        $user = $this->userService->getUserByEmail('michael.davenport@enta.net');

//        $users = $this->userService->all();

//        var_dump($users);


        echo $response;

        die();

        //echo $_SESSION['oauth2state'];

    }

    function redirect() {
//        $_GET['code'] = '4/iACAG4JszjujAxTm_nR4SE1S4MFOX45fo9uN7TjONLxk9Gqq0h2MlMd_XpD1azkOn019bZ27MA98mKldxtpASOU';
//        $_GET['state'] = '0316ac74b5c172f0330e40d35c9df575';

        if (!empty($_GET['error'])) {
            // Got an error, probably user denied access
            exit('Got error: ' . htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'));
        } elseif (empty($_GET['code'])) {
            // If we don't have an authorization code then get one
            $authUrl = $this->provider->getAuthorizationUrl();
            $_SESSION['oauth2state'] = $this->provider->getState();
            header('Location: ' . $authUrl);
            exit;
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
            // State is invalid, possible CSRF attack in progress
            unset($_SESSION['oauth2state']);
            exit('Invalid state');
        } else {
            // Try to get an access token (using the authorization code grant)
            $token = $this->provider->getAccessToken('authorization_code', [
                'code' => $_GET['code']
            ]);

//            // Use this to interact with an API on the users behalf
//            echo $token->getToken();
//
//            // Use this to get a new access token if the old one expires
//            echo $token->getRefreshToken();
//
//            // Number of seconds until the access token will expire, and need refreshing
//            echo $token->getExpires();

        }
    }

}