<?php
namespace Vibrary\Controllers;

use Vibrary\Services\VideosService;

class VideoController extends Controller {

    protected $videoService;

    function __construct() {
        parent::__construct();
        $this->videoService = new VideosService($this->userService, $this->oAuthService);

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
        }
        return $this->view("video-downloads", $data);
    }

    function search() {
        return $this->view("video-search");
    }

}