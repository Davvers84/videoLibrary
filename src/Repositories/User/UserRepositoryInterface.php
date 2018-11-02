<?php


namespace Vibrary\Repositories\User;

use Vibrary\Models\User;

interface UserRepositoryInterface
{
    public function all();
//
//    /**
//     * @param $id
//     * @return mixed
//     */
//    public function findById($id);
//
//    /**
//     * @param $request
//     * @return mixed
//     */
//    public function create($request);
//
//
//    /**
//     * @param $id
//     * @return mixed
//     */
//    public function delete($id);
//
    public function getUserByEmail($email);

    public function findByNameOrEmail($search);

    public function createFromGoogle($email, $name);

}