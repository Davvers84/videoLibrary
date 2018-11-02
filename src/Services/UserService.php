<?php
namespace Vibrary\Services;

use Vibrary\Repositories\User\UserRepositoryInterface;

class UserService
{

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getUserByEmail($email) {
        return $this->userRepository->getUserByEmail($email);
    }

    public function findByNameOrEmail($search) {
        return $this->userRepository->findByNameOrEmail($search);
    }

    public function createForGoogle($email, $name, $token) {

        $user = $this->userRepository->getUserByEmail($email);

        if (!$user) {
            $user = $this->userRepository->createFromGoogle(
                $email,
                $name,
                $token
            );
        } else {
            $data = array("remember_token" => $token);
            $this->userRepository->update($data, $user->id);
        }

        return $user;
    }

}