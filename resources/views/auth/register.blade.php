@extends('layouts.auth.base')

@section('content')

    <div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
        <h1 class="mb-5 text-lg font-semibold">Регистрация</h1>
        <form class="space-y-3" action="{{ route('register') }}" method="POST">
            @csrf
            <input
                class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/10 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                type="email"
                required=""
                autofocus=""
                autocomplete="email"
                placeholder="E-mail"
                value="{{ old('email') }}"
                name="email">
            @error('email')
                <div class="mt-3 text-pink text-xxs xs:text-xs">{{ $message }}</div>
            @enderror

            <input
                class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/10 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                type="text"
                required=""
                placeholder="Имя"
                value="{{ old('name') }}"
                name="name"
            >
            @error('name')
            <div class="mt-3 text-pink text-xxs xs:text-xs">{{ $message }}</div>
            @enderror

            <input
                class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/10 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                type="password"
                required=""
                autocomplete="current-password"
                placeholder="Пароль"
                name="password">
            @error('password')
            <div class="mt-3 text-pink text-xxs xs:text-xs">{{ $message }}</div>
            @enderror

            <input
                class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/10 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                type="password"
                required=""
                autocomplete="new-password"
                placeholder="Повторите пароль"
                name="password_confirmation"
            >
            @error('password_confirmation')
            <div class="mt-3 text-pink text-xxs xs:text-xs">{{ $message }}</div>
            @enderror

            <button class="w-full btn btn-pink" type="submit">Зарегистрироваться</button>
        </form>

        <div class="space-y-3 mt-5">
            <div class="text-xxs md:text-xs">
                Есть аккаунт? <a class="text-white hover:text-white/70 font-bold underline underline-offset-4"
                                 href="{{ route('login') }}">Войти</a>
            </div>
        </div>
    </div>
@endsection
