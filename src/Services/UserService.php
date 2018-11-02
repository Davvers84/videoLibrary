<?php
namespace Vibrary\Services;

use Vibrary\Repositories\User\UserRepositoryInterface;

/**
 * Class UserService
 * @package Vibrary\Services
 */
class UserService
{

    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        // @todo replace with true dependancy injection
        $this->userRepository = $userRepository;
    }

    /**
     * @param $email
     * @return mixed
     */
    public function getUserByEmail($email)
    {
        return $this->userRepository->getUserByEmail($email);
    }

    /**
     * @param $token
     * @return mixed
     */
    public function getUserByAccessToken($token)
    {
        return $this->userRepository->getUserByAccessToken($token);
    }

    /**
     * @param $search
     * @return mixed
     */
    public function findByNameOrEmail($search)
    {
        return $this->userRepository->findByNameOrEmail($search);
    }

    /**
     * @param $email
     * @param $name
     * @return mixed
     */
    public function createForGoogle($email, $name)
    {

        $user = $this->userRepository->getUserByEmail($email);

        if (!$user) {
            $user = $this->userRepository->createFromGoogle(
                $email,
                $name
            );
        }

        return $user;
    }
}
