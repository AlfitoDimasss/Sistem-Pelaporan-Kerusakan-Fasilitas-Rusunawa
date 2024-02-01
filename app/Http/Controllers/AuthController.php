<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function registerIndex()
    {
        return view('auth.register');
    }

    public function attempt($request)
    {
        return Auth::attempt($request);
    }

    public function validateRequest($request, $rules)
    {
        return $request->validate($rules);
    }

    public function login(Request $request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        $credentials = $this->validateRequest($request, $rules);

        if ($this->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return redirect('/login')->withInput()->with('fail', 'Username atau Password salah.');
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'whatsapp_no' => 'required|numeric|unique:users,whatsapp_no',
            'username' => 'required|unique:users,username',
            'password' => 'required'
        ];

        $validatedData = $this->validateRequest($request, $rules);

        $user = User::create($validatedData);

        if ($user) {
            return redirect('/login')->with('success', 'Akun berhasil dibuat, silahkan login kembali');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
