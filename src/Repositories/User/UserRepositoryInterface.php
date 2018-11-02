<?php


namespace Vibrary\Repositories\User;

interface UserRepositoryInterface
{
    public function all();

    public function getUserByEmail($email);

    public function findByNameOrEmail($search);

    public function createFromGoogle($email, $name);
}
