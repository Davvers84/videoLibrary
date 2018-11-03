<?php
namespace Vibrary\Services;

require ROOTPATH . '/vendor/autoload.php';

/**
 * Class oAuthService
 * @package Vibrary\Services
 */
class oAuthService
{

    /**
     * @var UserService
     */
    protected $userService;
    /**
     * @var \Google_Client
     */
    protected $client;

    /**
     * oAuthService constructor.
     * @param UserService $userService
     */
    function __construct(UserService $userService)
    {
        // @todo replace with true dependancy injection
        $this->userService = $userService;

        $this->client = new \Google_Client();
        $this->client->setApplicationName("PHP Google OAuth Login Example");
        $this->client->setClientId(getenv('GOOGLE_CLIENT_ID'));
        $this->client->setClientSecret(getenv('GOOGLE_CLIENT_SECRET'));
        $this->client->setRedirectUri(getenv('GOOGLE_REDIRECT'));
        $this->client->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
    }

    /**
     *
     */
    function callback()
    {
        if (!isset($_GET['code'])) {
            $auth_url = $this->client->createAuthUrl();
            header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
            exit;
        } else {
            $this->client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $this->client->getAccessToken();
            $this->getUserData(); // And Store in DB
            header('Location: ' . filter_var(getenv('APP_URL'), FILTER_SANITIZE_URL));
            exit;
        }
    }

    /**
     * @return bool
     */
    function authenticate()
    {

        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return array
     */
    function getUserData()
    {

        try {
            $oAuth = new \Google_Service_Oauth2($this->client);
            $userData = $oAuth->userinfo_v2_me->get();
        } catch (\Google_Service_Exception $e) {
            session_destroy();
            $_SESSION['error_message'] = 'Sorry we can\'t find your user! Please sign in with your Google Account';
            header('Location: ' . filter_var(getenv('APP_URL'), FILTER_SANITIZE_URL));
            exit;
        }

        $userDB = $this->userService->getUserByEmail($userData->email);

        if (!$userDB) {
            $this->userService->createForGoogle($userData->email, $userData->name);
            $userDB = $this->userService->getUserByEmail($userData->email);
        }

        return array(
            "oAuth" => $userData,
            "user" => $userDB
        );
    }

    /**
     *
     */
    function redirect()
    {
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $auth_url = $this->client->createAuthUrl();
            header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
            exit;
        } else {
            if (!empty($_GET['error'])) {
                // Got an error, probably user denied access
                exit('Got error: ' . htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'));
            } elseif (empty($_GET['code'])) {
                // If we don't have an authorization code then get one
                $auth_url = $this->client->createAuthUrl();
                header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
                exit;
            }
        }
    }
}
