<?php


namespace Vibrary\Repositories\Video;

use Vibrary\Models\Video;
use Vibrary\Repositories\BaseRepository;

/**
 * Class VideoRepository
 * @package Vibrary\Repositories\Video
 */
class VideoRepository extends BaseRepository implements VideoRepositoryInterface
{
    /**
     * @var Video
     */
    public $model;

    /**
     * VideoRepository constructor.
     * @param Video $model
     */
    public function __construct(Video $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getVideoById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getVideosByUser($id)
    {
        return $this->model->where('user_id', $id)->orderBy('created_at', 'desc')->get();
    }
}
