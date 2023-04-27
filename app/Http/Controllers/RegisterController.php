<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\RegisterUserRequest;

class RegisterController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Register a new user
     */
    public function store(RegisterUserRequest $request)
    {
        try {

        } catch (\Exception $e) {
            
        }
    }
}
