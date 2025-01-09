<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            return redirect()->intended('admin');
        }
        return view('login');
    }
    //
    public function proses_login(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $credential = $request->only('username', 'password');
        if (Auth::attempt($credential)) {
            $user =  Auth::user();
            return redirect()->intended('admin');
        }
        return redirect('login')
            ->withInput()
            ->withErrors(['login_gagal' => 'These credentials does not match our records']);
    }

    public function register()
    {
        return view('register');
    }


    // aksi form register
    public function proses_register(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // kalau gagal kembali ke halaman register dengan munculkan pesan error
        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }
        // kalau berhasil isi level & hash passwordnya ya biar secure
        $request['level'] = 'user';
        $request['password'] = bcrypt($request->password);

        // masukkan semua data pada request ke table user
        User::create($request->all());

        // kalo berhasil arahkan ke halaman login
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        // logout itu harus menghapus session nya 

        $request->session()->flush();

        // jalan kan juga fungsi logout pada auth 

        Auth::logout();
        // kembali kan ke halaman login
        return Redirect()->route('login');
    }
}
