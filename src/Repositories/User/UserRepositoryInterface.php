<?php


namespace Vibrary\Repositories\User;

/**
 * Interface UserRepositoryInterface
 * @package Vibrary\Repositories\User
 */
interface UserRepositoryInterface
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param $email
     * @return mixed
     */
    public function getUserByEmail($email);

    /**
     * @param $search
     * @return mixed
     */
    public function findByNameOrEmail($search);

    /**
     * @param $email
     * @param $name
     * @return mixed
     */
    public function createFromGoogle($email, $name);
}
