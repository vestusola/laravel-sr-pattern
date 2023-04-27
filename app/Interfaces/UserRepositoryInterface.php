<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function login($credentials);

    public function register($data);
}