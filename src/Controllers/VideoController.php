<?php
namespace Vibrary\Controllers;

use Illuminate\Database\QueryException;
use Vibrary\Models\Video;
use Vibrary\Repositories\Video\VideoRepository;
use Vibrary\Services\VideosService;

/**
 * Class VideoController
 * @package Vibrary\Controllers
 */
class VideoController extends PageController
{

    /**
     * @var VideosService
     */
    protected $videoService;

    /**
     * VideoController constructor.
     */
    function __construct()
    {
        parent::__construct();
        $videoModel = new Video();
        $videoRepo = new VideoRepository($videoModel);
        $this->videoService = new VideosService($videoRepo);
    }

    /**
     * @return array
     */
    function downloads()
    {
        if ($this->userData) {
            $videos = $this->videoService->getVideosByUser($this->userData['user']->id);
            $this->addPageData('videos', $videos);
        } else {
            $this->setErrorMessage('Sorry we can\'t find your user! Please sign in with your Google Account');
            header('Location: ' . filter_var(getenv('APP_URL'), FILTER_SANITIZE_URL));
            exit;
        }

        return $this->view("video-downloads", $this->getPageData());
    }

    /**
     *
     */
    function save()
    {
        if (array_key_exists('saveVideo', $_POST)) {
            $errors = 0;
            foreach ($_POST['saveVideo'] as $video) {
                $videoData = (Array) json_decode($video);
                $videoData['user_id'] = $this->userData['user']->id;
                try {
                    $this->videoService->create($videoData);
                } catch (QueryException $exception) {
                    $errors++;
                }
            }

            if (count($_POST['saveVideo']) != $errors) {
                $videosSaved = count($_POST['saveVideo']) - $errors;
                $_SESSION['success_message'] = (count($_POST['saveVideo']) - $errors) . ' video' . ($videosSaved > 1 ? 's' : '') . ' saved successfully.';
            }
            if ($errors) {
                $_SESSION['error_message'] = $errors . ' video' . ($errors > 1 ? 's' : '') . ' ' . ($errors > 1 ? 'weren\'t' : 'wasn\'t') . ' saved, possibly because you have already!';
            }
        }
        $_SESSION['error_message'] = 'You didn\'t select any video(s) to save!';
        header('Location: ' . filter_var($_SERVER['PHP_SELF'], FILTER_SANITIZE_URL));
        exit;
    }

    /**
     * @param $query
     * @return array
     */
    function search($query)
    {
        if (array_key_exists('query', $_POST)) {
            $query = $_POST['query'];
            unset($_POST['query']);
            header('Location: ' . filter_var('/video/search/' . $query, FILTER_SANITIZE_URL));
            exit;
        }

        $data = array();
        if ($this->userData) {
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
        foreach ($response->getItems() as $item) {
            $video = array(
                "channelId" => $item->snippet->channelId,
                "channelTitle" => $item->snippet->channelTitle,
                "title" => $item->snippet->title,
                "description" => $item->snippet->description,
                "videoId" => $item->id->videoId
            );
            $data["videos"][] = $video;
        }

        return $this->view("video-search", $data);
    }
}
