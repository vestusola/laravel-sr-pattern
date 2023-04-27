<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Register user
     */
    public function register($data)
    {
        return $this->userRepository->create($data);
    }

    /**
     * Login user
     */
    public function login($credentials)
    {
        $user = $this->userRepository->findUserByEmail($credentials['email']);

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw new \Exception('Incorrect email/password provided!');
        }

        return $user;
    }
}
