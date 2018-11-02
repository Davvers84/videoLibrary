<?php
namespace Vibrary\Controllers;

use Vibrary\Models\User; // @todo remove this after testing
use Vibrary\Models\Video;
use Vibrary\Repositories\User\UserRepository;  // @todo remove this after testing
use Vibrary\Repositories\Video\VideoRepository;
use Vibrary\Services\VideosService;

class VideoController extends Controller {

    protected $videoService;

    function __construct() {
        parent::__construct();

        $videoModel = new Video();
        $videoRepo = new VideoRepository($videoModel);
        $this->videoService = new VideosService($videoRepo, $this->userService, $this->oAuthService);

//        $userModel = new User();
//        $userRepo = new UserRepository($userModel);
//        $user = $userRepo->findbyId(1);
//
////        echo '<pre>';
////        print_r($user);
////        echo '</pre>';
//
//        $videos = $user->videos;
//
//        echo '<pre>';
//        print_r($videos);
//        echo '</pre>';
//
//        die();
    }

    function downloads() {
        $data = array();
        if($this->userData) {
            $data = array(
                "user" => array(
                    "id" => $this->userData['user']->id,
                    "name" => $this->userData['oAuth']->name,
                    "email" => $this->userData['oAuth']->email,
                )
            );

            $videos = $this->videoService->getVideosByUser($data['user']['id']);
            $data['videos'] = $videos;

        }
        return $this->view("video-downloads", $data);
    }

    function search() {
        return $this->view("video-search");
    }

}