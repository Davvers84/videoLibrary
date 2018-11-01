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
     * @param $email
     * @param $name
     * @return mixed|void
     */
    public function createFromProvider($email, $name)
    {
        return $this->model->create([
            'email' => $email,
            'name' => $name
        ]);
    }

    /**
     * @param User $user
     * @param $providerId
     * @param $provider
     * @return mixed|void
     */
    public function createUserAccount(User $user, $providerId, $provider)
    {
        $user->accounts()->create([
            'provider_id' => $providerId,
            'provider_name' => $provider,
        ]);
    }

    public function findByNameOrEmail($search)
    {
       return $this->model->where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->get();
    }
}