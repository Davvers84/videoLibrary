<?php


namespace Vibrary\Repositories\Video;

use Vibrary\Models\Video;
use Vibrary\Repositories\BaseRepository;

class VideoRepository extends BaseRepository implements VideoRepositoryInterface
{
    public $model;

    public function __construct(Video $model) {
        $this->model = $model;
    }

//    public function getUserByEmail($email) {
//        return $this->model->where('email', $email)->first();
//    }
//
//    public function findByNameOrEmail($search) {
//       return $this->model->where('name', 'LIKE', '%' . $search . '%')
//            ->orWhere('email', 'LIKE', '%' . $search . '%')
//            ->get();
//    }
//
//    public function createFromGoogle($email, $name)
//    {
//        return $this->model->create([
//            'email' => $email,
//            'name' => $name
//        ]);
//    }
}