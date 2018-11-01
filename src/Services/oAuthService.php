<?php
namespace Vibrary\Services;

/*
 * Note (Gerwin Sturm):
 * Include path is still necessary despite autoloading because of the require_once in the libary
 * Client library should be fixed to have correct relative paths
 * e.g. require_once '../Google/Model.php'; instead of require_once 'Google/Model.php';
 */
set_include_path(get_include_path() . PATH_SEPARATOR . ROOTPATH .'/vendor/google/apiclient/src');
//echo get_include_path(); echo '<br/>';
//echo PATH_SEPARATOR; echo '<br/>';
//echo ROOTPATH; echo '<br/>';
//echo '/vendor/google/apiclient/src'; echo '<br/>';

require_once ROOTPATH . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Simple server to demonstrate how to use Google+ Sign-In and make a request
 * via your own server.
 *
 * @author silvano@google.com (Silvano Luciani)
 */

class oAuthService {

    function __construct() {

    }

    function authUser() {
        $client = new Google_Client();
        $client->setApplicationName(getenv('APP_NAME'));
        $client->setClientId(getenv('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(getenv('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri('postmessage');

        $plus = new Google_Service_Plus($client);

        $app = new Silex\Application();
        $app['debug'] = true;

        $app->register(new Silex\Provider\TwigServiceProvider(), array(
            'twig.path' => __DIR__,
        ));
        $app->register(new Silex\Provider\SessionServiceProvider());

        // Initialize a session for the current user, and render index.html.
        $app->get('/', function () use ($app) {
            $state = md5(rand());
            $app['session']->set('state', $state);
            return $app['twig']->render('index.html', array(
                'GOOGLE_CLIENT_ID' => getenv('GOOGLE_CLIENT_ID'),
                'STATE' => $state,
                'APPLICATION_NAME' => getenv('APP_NAME')
            ));
        });

        // Upgrade given auth code to token, and store it in the session.
        // POST body of request should be the authorization code.
        // Example URI: /connect?state=...&gplus_id=...
        $app->post('/connect', function (Request $request) use ($app, $client) {
            $token = $app['session']->get('token');

            if (empty($token)) {
                // Ensure that this is no request forgery going on, and that the user
                // sending us this connect request is the user that was supposed to.
                if ($request->get('state') != ($app['session']->get('state'))) {
                    return new Response('Invalid state parameter', 401);
                }

                // Normally the state would be a one-time use token, however in our
                // simple case, we want a user to be able to connect and disconnect
                // without reloading the page.  Thus, for demonstration, we don't
                // implement this best practice.
                //$app['session']->set('state', '');

                $code = $request->getContent();
                // Exchange the OAuth 2.0 authorization code for user credentials.
                $client->authenticate($code);
                $token = json_decode($client->getAccessToken());

                // You can read the Google user ID in the ID token.
                // "sub" represents the ID token subscriber which in our case
                // is the user ID. This sample does not use the user ID.
                $attributes = $client->verifyIdToken($token->id_token, getenv('GOOGLE_CLIENT_ID'))
                    ->getAttributes();
                $gplus_id = $attributes["payload"]["sub"];

                // Store the token in the session for later use.
                $app['session']->set('token', json_encode($token));
                $response = 'Successfully connected with token: ' . print_r($token, true);
            } else {
                $response = 'Already connected';
            }

            return new Response($response, 200);
        });

        //// Get list of activities visible to this app.
        //$app->get('/activities', function () use ($app, $client, $plus) {
        //    $token = $app['session']->get('token');
        //
        //    if (empty($token)) {
        //        return new Response('Unauthorized request', 401);
        //    }
        //
        //    $client->setAccessToken($token);
        //    $activities = $plus->activities->listActivities('me', 'public', array());
        //
        //    /*
        //     * Note (Gerwin Sturm):
        //     * $app->json($activities) ignores the $activities->items not returning this array
        //     * Probably needs to be fixed in the Client Library
        //     * Using ->toSimpleObject for now to get a JSON-convertible object
        //     */
        //    return $app->json($activities->toSimpleObject());
        //});

        //// Revoke current user's token and reset their session.
        //$app->post('/disconnect', function () use ($app, $client) {
        //    $token = json_decode($app['session']->get('token'))->access_token;
        //    $client->revokeToken($token);
        //    // Remove the credentials from the user's session.
        //    $app['session']->set('token', '');
        //    return new Response('Successfully disconnected', 200);
        //});
        //
        //$app->run();
        //
    }

}