<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Auth\ForgotRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Testing\Fluent\Concerns\Has;
use Laravel\Socialite\Facades\Socialite;
use Str;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authinticate(AuthRequest $request)
    {
        if (!auth()->attempt($request->validated())) {
            return back()->withErrors([
                'email' => 'Данные не верны.'
            ]);
        }

        return redirect()->route('home');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        User::query()->create([
            'name' => $request->get('name'),
            'email'    => $request->get('email'),
            'password' => Hash::make(($request->get('password')))
        ]);

        return redirect()->route('login');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('home');
    }

    public function forgotForm()
    {
        return view('auth.forgot');
    }
    public function forgotSendEmail(ForgotRequest $request)
    {
        $user = User::where(['email' => $request->get('email')])->first();
        $token = Str::random(60);

        $user['token'] = $token;
        $user->save();

        Mail::to($user)->send(new ForgotPassword($user->name, $token));

        return redirect()->route('login');
    }

    public function forgotUpdatePasswordForm($token)
    {
        $user = User::where('token', $token)->first();
        if ($user) {
            $email = $user->email;
            return view('auth.change-password', compact('email'));
        }
        return redirect()->route('forgot-password')->with('Ссылка на сброс пароля уже отправлена');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();
        if ($user) {
            $user['token'] = '';
            $user['password'] = Hash::make($request->get('password'));
            $user->save();
            return redirect()->route('login');
        }

        return redirect()->route('forgot')->with('Произошла ошибка');
    }

    public function github()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = User::query()->updateOrCreate([
            'github_id' => $githubUser->id,
        ], [
            'name' => $githubUser->id,
            'email' => $githubUser->email,
            'password' => bcrypt(str()->random(20))
        ]);

        auth()->login($user);

        return redirect()->route('dashboard.index');
    }
}
