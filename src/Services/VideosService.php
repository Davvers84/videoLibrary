<?php
/**
 * Created by PhpStorm.
 * User: michaeldavenport
 * Date: 01/11/18
 * Time: 16:01
 */
namespace Vibrary\Services;

use Vibrary\Repositories\Video\VideoRepositoryInterface;

/**
 * Class VideosService
 * @package Vibrary\Services
 */
class VideosService
{

    /**
     * @var VideoRepositoryInterface
     */
    protected $videoRepository;
    /**
     * @var \Google_Client
     */
    protected $client;

    /**
     * VideosService constructor.
     * @param VideoRepositoryInterface $videoRepository
     */
    function __construct(VideoRepositoryInterface $videoRepository)
    {
        // @todo replace with true dependancy injection
        $this->videoRepository = $videoRepository;

        $this->client = new \Google_Client();
        $this->client->setDeveloperKey(getenv('GOOGLE_SIMPLE_API_KEY'));
    }

    /**
     * @param $query
     * @return \Google_Service_YouTube_SearchListResponse
     */
    function searchVideos($query)
    {
        $youtube = new \Google_Service_YouTube($this->client);
        return $searchResponse = $youtube->search->listSearch('id,snippet', array(
            'q' => $query,
            'maxResults' => 10,
        ));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getVideoById($id)
    {
        return $this->videoRepository->getVideoById($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getVideosByUser($id)
    {
        return $this->videoRepository->getVideosByUser($id);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        return $this->videoRepository->create($request);
    }
}
