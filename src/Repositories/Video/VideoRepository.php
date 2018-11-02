<?php


namespace Vibrary\Repositories\Video;

use Vibrary\Models\Video;
use Vibrary\Repositories\BaseRepository;

class VideoRepository extends BaseRepository implements VideoRepositoryInterface
{
    public $model;

    public function __construct(Video $model)
    {
        $this->model = $model;
    }

    public function getVideoById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function getVideosByUser($id)
    {
        return $this->model->where('user_id', $id)->orderBy('created_at', 'desc')->get();
    }
}
