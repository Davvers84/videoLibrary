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
    protected $client;

    function __construct(VideoRepositoryInterface $videoRepository) {
        // @todo replace with true dependancy injection
        $this->videoRepository = $videoRepository;

        $this->client = new \Google_Client();
        $this->client->setDeveloperKey(getenv('GOOGLE_SIMPLE_API_KEY'));
    }

    function searchVideos($query) {
        $youtube = new \Google_Service_YouTube($this->client);
        return $searchResponse = $youtube->search->listSearch('id,snippet', array(
            'q' => $query,
            'maxResults' => 10,
        ));
    }

    public function getVideoById($id) {
        return $this->videoRepository->getVideoById($id);
    }

    public function getVideosByUser($id) {
        return $this->videoRepository->getVideosByUser($id);
    }

    public function create($request) {
        return $this->videoRepository->create($request);
    }

}