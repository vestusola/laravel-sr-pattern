<?php

namespace App\Interfaces;

interface IUser
{
    public function login($credentials);

    public function register($data);
}