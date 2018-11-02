<?php


namespace Vibrary\Repositories\User;

use Vibrary\Models\User;
use Vibrary\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    public $model;

    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model) {
        $this->model = $model;
    }

    /**
     * @param $email
     * @return mixed
     */
    public function getUserByEmail($email) {
        return $this->model->where('email', $email)->first();
    }


    public function findByNameOrEmail($search) {
       return $this->model->where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->get();
    }
}