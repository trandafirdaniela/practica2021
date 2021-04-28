<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user = User::where('email', $request->input('email'))->first();

            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                return redirect(route('login'))->withErrors([
                    'login' => 'Email or password is incorrect!'
                ])->withInput();
            }

            Auth::login($user);

            return redirect('/dashboard');
        }

        return view('auth/login');
    }

    public function register(Request $request)
    {
        //TODO
        if ($request->isMethod('post')) {
            //validate request
            //create user
            // login user or send activate email
            //redirected to dashboard/login
        }

        //return view register
        return 'REGISTER';
    }
}