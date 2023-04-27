<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\{
    Validator
};

class LoginController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Login user
     */
    public function store(Request $request)
    {
        try {
            // Validation request rules
            $rules = [
                'email'     => 'required|email|max:255',
                'password'  => 'required',
            ];

            // Validate rules
            $validation = Validator::make($request->all(), $rules);
            if ($validation->fails()) return response()->json(['status' => 422, 'errors' => $validation->errors()], 422);

            $user = $this->userService->login($request->only('email', 'password'));

            $token = $user->createToken(config('app.name'))->plainTextToken; // Create a new token

            return response()->json([
                'status' => 200,
                'data' => [
                    'user'  => $user,
                    'token' => "Bearer $token"
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 401, 'error' => $e->getMessage()], 401);
        }
    }
}
