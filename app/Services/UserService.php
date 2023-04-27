<?php

namespace App\Services;

use App\Repositories\UserRepository;

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
        return $this->userRepository->register($data);
    }

    /**
     * Login user
     */
    public function login($credentials)
    {
        
    }
}
