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
    public function create($data)
    {
        return $this->user->create($data);
    }

    /**
     * Find user by email
     */
    public function findUserByEmail(string $email)
    {
        return $this->user->where('email', $email)->first();
    }
}
