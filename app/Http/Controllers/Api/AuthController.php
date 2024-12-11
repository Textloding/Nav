<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only(['username', 'password']);
        
        // 添加调试日志
        Log::info('Login attempt', [
            'username' => $credentials['username'],
            'password_length' => strlen($credentials['password'])
        ]);

        if (!$token = auth()->attempt($credentials)) {
            // 查找用户
            $user = User::where('username', $credentials['username'])->first();
            if ($user) {
                Log::info('User found but password mismatch', [
                    'user_id' => $user->id,
                    'stored_password_hash' => $user->password
                ]);
            } else {
                Log::info('User not found');
            }

            return response()->json([
                'success' => false,
                'message' => '用户名或密码错误'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'token' => $token,
                'user' => auth()->user()
            ]
        ]);
    }

    public function me()
    {
        return response()->json([
            'success' => true,
            'data' => auth()->user()
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'success' => true,
            'message' => '已退出登录'
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'token' => auth()->refresh(),
                'user' => auth()->user()
            ]
        ]);
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6',
        ]);

        $user = auth()->user();

        // 验证原密码
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => '原密码错误'
            ], 400);
        }

        // 更新密码
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => '密码修改成功'
        ]);
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|min:3',
            'old_password' => 'required|string|min:6',
            'new_password' => 'nullable|string|min:6',
        ]);

        $user = auth()->user();

        // 验证原密码
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => '原密码错误'
            ], 400);
        }

        // 检查用户名是否已被使用
        if ($request->username !== $user->username) {
            $existingUser = User::where('username', $request->username)
                ->where('id', '!=', $user->id)
                ->first();

            if ($existingUser) {
                return response()->json([
                    'success' => false,
                    'message' => '该用户名已被使用'
                ], 400);
            }
        }

        // 更新用户信息
        $user->username = $request->username;
        
        // 如果提供了新密码，则更新密码
        if ($request->new_password) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => '账号信息修改成功'
        ]);
    }
}
