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

    function search($query) {
        if(array_key_exists('query', $_POST)) {
            $query = $_POST['query'];
            unset($_POST['query']);
            header('Location: ' . filter_var('/video/search/' . $query, FILTER_SANITIZE_URL));
        }

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

        $response = $this->videoService->searchVideos($query);

        $data["videos"] = array();
        foreach($response->getItems() as $item) {
            $video = array("channelId" => $item->id->channelId,
                            "videoId" => $item->id->videoId);
            $data["videos"][] = $video;
        }

        return $this->view("video-search", $data);
    }

}