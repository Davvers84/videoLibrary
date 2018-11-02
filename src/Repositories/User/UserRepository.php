<?php


namespace Vibrary\Repositories\User;

use Vibrary\Models\User;
use Vibrary\Repositories\BaseRepository;

/**
 * Class UserRepository
 * @package Vibrary\Repositories\User
 */
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
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param $email
     * @return mixed
     */
    public function getUserByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * @param $search
     * @return mixed
     */
    public function findByNameOrEmail($search)
    {
        return $this->model->where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->get();
    }

    /**
     * @param $email
     * @param $name
     * @return mixed
     */
    public function createFromGoogle($email, $name)
    {
        return $this->model->create([
            'email' => $email,
            'name' => $name
        ]);
    }
}
