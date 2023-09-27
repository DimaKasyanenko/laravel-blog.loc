@extends('layouts.auth.base')

@section('content')

    <div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
        <h1 class="mb-5 text-lg font-semibold">Изменить пароль</h1>
        <form class="space-y-3" action="{{ route('update-password') }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="email" value="{{ $email }} "/>
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

            <button class="w-full btn btn-pink" type="submit">Изменить пароль</button>
        </form>

        <div class="space-y-3 mt-5">
            <div class="text-xxs md:text-xs">
                <a class="text-white hover:text-white/70 font-bold"
                   href="{{ route('forgot') }}"
                >
                    Забыли пароль?
                </a>
            </div>
            <div class="text-xxs md:text-xs">
                <a class="text-white hover:text-white/70 font-bold"
                   href="{{ route('register') }}">
                    Регистрация
                </a>
            </div>
        </div>
    </div>
@endsection
