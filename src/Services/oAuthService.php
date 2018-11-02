<?php
namespace Vibrary\Services;

require ROOTPATH . '/vendor/autoload.php';

class oAuthService
{

    protected $userService;
    protected $client;

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

    function authenticate()
    {
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            return true;
        } else {
            return false;
        }
    }

    function getUserData()
    {
        $oAuth = new \Google_Service_Oauth2($this->client);
        $userData = $oAuth->userinfo_v2_me->get();
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
