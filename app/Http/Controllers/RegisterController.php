<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\{
    Hash,
    Validator
};

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
    public function store(Request $request)
    {
        try {
            // Validation request rules
            $rules = [
                'name'              => 'required|max:255',
                'email'             => 'required|email|max:255|unique:users',
                'password'          => 'required|min:6',
                'confirm_password'  => 'required|min:6|same:password'
            ];

            // Validate rules
            $validation = Validator::make($request->all(), $rules);
            if ($validation->fails()) return response()->json(['status' => 422, 'errors' => $validation->errors()], 422);

            $data = [
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password)
            ];

            $user = $this->userService->register($data);

            return response()->json(['status' => 201, 'user' => $user], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'error' => $e->getMessage()], 500);
        }
    }
}
