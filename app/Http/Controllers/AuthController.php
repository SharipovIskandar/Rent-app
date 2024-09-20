<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user_name = $request->input('username');
        $password = $request->input('password');
        $user = User::query()->where('email', $user_name)->first();

        if ($user && $user->password === $password) {
            auth()->login($user);
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors(['message' => 'Foydalanuvchi topilmadi yoki parol noto\'g\'ri!']);
    }

}
