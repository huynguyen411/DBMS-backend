<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'logout']]);
    }

    // use LoginRequest;
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(LoginRequest $request)
    {
        $email = $request->get('email');
        if (User::where('email', $email)->count() == 0) {
            return response()->json([
                'errors' => 
                    ['email' => ['email không tồn tại']]
                
            ], 401);
        }

        if (!$token = auth()->attempt($request->validated())) {
            return response()->json(['errors' => ['Tài khoản hoặc mật khẩu không chính xác']], 401);
        }

        $newToken = $this->createNewToken($token);
        return response()->json($newToken);
    }

    public function register(RegisterUserRequest $request)
    {
        $user = User::create(array_merge(
            $request->validated(),
            [
                'password' => bcrypt($request->password),
                'role_id' => 2
            ],
        ));

        return response()->json([
            'status' => 'ok',
            'message' => 'Đăng ký tài khoản thành công',
            'data' => $user
        ], 201);
    }

    public function updateRole($userId)
    {
        $check = User::where([
            ['_id', '=', $userId]
        ])->update(['role_id' => 1]);

        if (!$check) {
            return response()->json([
                'status' => 'error',
                'messenger' => 'Cập nhật vai trò thất bại'
            ], 422);
        }

        return response()->json([
            'status' => 'ok',
            'messenger' => 'Cập nhật vai trò thành công'
        ], 200);
    }
    
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth()->user());
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
            return response()->json([                
                'errors' =>['old_password' => 'mật khẩu hiện tại không chính xác',]
            ], 422);
        }


        $userId = auth()->user()->id;

        $user = User::where('id', $userId)->update(
            ['password' => bcrypt($request->new_password)]
        );

        return response()->json([
            'status' => 'ok',
            'message' => 'Đã đổi mật khẩu thành công',
        ], 201);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}