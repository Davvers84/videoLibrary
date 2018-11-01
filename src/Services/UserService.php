<?php
namespace Vibrary\Services;

use Vibrary\Repositories\User\UserRepositoryInterface;

class UserService
{

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

//    public function all() {
//        return $this->userRepository->all();
//    }

    public function getUserByEmail($email) {
        return $this->userRepository->getUserByEmail($email);
    }

    public function findByNameOrEmail($search) {
        return $this->userRepository->findByNameOrEmail($search);
    }

//    public function createUser(ProviderUser $providerUser, $provider) {
//
//        $user = $this->userRepository->getUserByEmail($providerUser->getEmail());
//
//        if (!$user) {
//            $user = $this->userRepository->createFromProvider(
//                $providerUser->getEmail(),
//                $providerUser->getName()
//            );
//        }
//
//        $this->userRepository->createUserAccount($user, $providerUser->getId(), $provider);
//
//        return $user;
//    }

}