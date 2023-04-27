<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Register user
     */
    public function register($data)
    {
        return $this->user->create($data);
    }

    /**
     * Login user
     */
    public function login($credentials)
    {
        
    }
}
