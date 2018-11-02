<?php
namespace Vibrary\Controllers;

use Vibrary\Services\VideosService;

class VideoController extends Controller {

    protected $videoService;

    function __construct() {
        parent::__construct();
        $this->videoService = new VideosService();

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
        return $this->view("video-downloads");
    }

    function search() {
        return $this->view("video-search");
    }

}