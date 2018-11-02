<?php


namespace Vibrary\Repositories\User;

use Vibrary\Models\User;
use Vibrary\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public $model;

    public function __construct(User $model) {
        $this->model = $model;
    }

    public function getUserByEmail($email) {
        return $this->model->where('email', $email)->first();
    }

    public function findByNameOrEmail($search) {
       return $this->model->where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->get();
    }

    public function createFromGoogle($email, $name) {
        return $this->model->create([
            'email' => $email,
            'name' => $name
        ]);
    }

//    public function getVideos() {
//        return $this->model->videos;
//    }
}