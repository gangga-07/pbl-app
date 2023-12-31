<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }
    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // cek apakah user status = active
            if (Auth::user()->status != 'active') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                Session::flash('status', 'failed');
                Session::flash('message', 'Your account is not active yet. Please contact admin!');
                return redirect('/login');
            }

            $request->session()->regenerate();
            if (Auth::user()->role_id == 1) {
                return redirect('dashboard');
            }
            if (Auth::user()->role_id == 2) {
                return redirect('/');
            }
            // return redirect()->intended('dashboard');
        }

        Session::flash('status', 'failed');
        Session::flash('message', 'Login Invalid');
        return redirect('/login');
    }

    // proses register
    public function attemptRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:8|max:50',
            'email' => 'required|email:dns',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'password' => 'required|string'
            // 'password_confirm' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'OOPS! <br> An Error Occurred During Registration!');
        }
        $validated = $validator->validate();
        $user_is_created = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'password' => Hash::make($validated['password']),
        ]);
        if ($user_is_created) {
            if ($request->redirect_login) {
                if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
                    return redirect()->route('dashboard')->with('success', 'Login Success! <br> Welcome ' . auth()->user()->name);
                }
                return redirect()->route('login')->with('error', 'Otomatic Login Failed! <br> Try Login using Manual Method!');
            }
            return redirect()->route('login')->with('success', 'New Account Created! <br> Please Login Using Your New Account');
        }
        redirect()->route('login')->with('error', 'Register Failed! <br> Please Try Again Later!');
    }

    // proses logout
    public function logout()
    {
        Session::flush();
        session()->invalidate();
        Auth::logout();
        return redirect()->route('main')->with('success', 'You Has Been Logged Out!')->withCookie(Cookie::forget('eksklusif_specials_token'));
    }

    // ------------------------------ // Lupa password reset By E-mail // --------------------------------------
    function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    function passwordEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    function passwordReset(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    function passwordUpdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
    // ------------------------------ // Lupa password reset By E-mail // --------------------------------------

}
