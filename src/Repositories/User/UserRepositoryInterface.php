<?php


namespace Vibrary\Repositories\User;

use Vibrary\Models\User;

interface UserRepositoryInterface
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * @param $request
     * @return mixed
     */
    public function create($request);

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update(Array $request, $id);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param $email
     * @return mixed
     */
    public function getUserByEmail($email);

    /**
     * @param $email
     * @param $name
     * @return mixed
     */
    public function createFromProvider($email, $name);

    /**
     * @param $user
     * @param $providerId
     * @param $provider
     * @return mixed
     */
    public function createUserAccount(User $user, $providerId, $provider);

    /**
     * @param $search
     * @return mixed
     */
    public function findByNameOrEmail($search);
}