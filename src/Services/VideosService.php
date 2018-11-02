<?php
/**
 * Created by PhpStorm.
 * User: michaeldavenport
 * Date: 01/11/18
 * Time: 16:01
 */
namespace Vibrary\Services;

use Vibrary\Repositories\Video\VideoRepositoryInterface;

Class VideosService {

    protected $videoRepository;
    protected $oAuthService;
    protected $userService;

    function __construct(VideoRepositoryInterface $videoRepository, UserService $userService, oAuthService $oAuthService) {
        // @todo replace with true dependancy injection
        $this->videoRepository = $videoRepository;
        $this->userService = $userService; // @todo might not need this - so remove it
        $this->oAuthService = $oAuthService; //@todo remove this if not needed - looks like I don't need it so far
    }

    function searchVideos($query) {
        $client = new \Google_Client();
        $client->setDeveloperKey(getenv('GOOGLE_SIMPLE_API_KEY'));

        // Define an object that will be used to make all API requests.
        $youtube = new \Google_Service_YouTube($client);
        return $searchResponse = $youtube->search->listSearch('id,snippet', array(
            'q' => $query,
            'maxResults' => 50,
        ));
    }

    public function getVideoById($id) {
        return $this->videoRepository->getVideoById($id);
    }

    public function getVideosByUser($id) {
        return $this->videoRepository->getVideosByUser($id);
    }

//    public function getVideos() {
//        return $this->userService->getVideos();
//    }

}