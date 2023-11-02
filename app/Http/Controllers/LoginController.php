<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    public function login(Request $request, User $user)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('toast_success', 'Berhasil Login!' . "\n" . 'Selamat Datang ' . auth()->user()->username);
        }

        return back()->with('error', 'Email atau Password Salah');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil Logout');
    }

    public function register()
    {
        $id = User::pluck('id')->last();
        return view('auth.register', [
            'id' => $id ? $id + 1 : '1'
        ]);
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|min:4|max:8|unique:users,username',
            'password' => 'required|min:4'
        ], [

            'name.required' => 'Nama Tidak Boleh Kosong!',
            'name.unique' => 'Nama Sudah Ada!',
            'name.max' => 'Max 30 Character!',

            'username.required' => 'Username Tidak Boleh Kosong!',
            'username.unique' => 'Username Sudah Ada!',
            'username.min' => 'Username Minimal 4 Character!',
            'username.max' => 'Username Maksimal 8 Character!',

            'password.required' => 'Password Tidak Boleh Kosong!',
            'password.min' => 'Password Minimal 4 Character!',
        ]);

        User::create([
            'id' => $request->input('id'),
            'id_user' => $request->input('id_user'),
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password'))
        ]);

        Wallet::create([
            'user_id' => $request->input('id'),
            'money_total' => 0,
        ]);

        return redirect('/login')->with('success', 'Berhasil Registrasi! Silahkan Login');
    }
}
