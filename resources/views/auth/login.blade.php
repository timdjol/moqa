@extends('auth/layouts.master')

@section('title', 'Логин')

@section('content')

    <div class="page admin login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-12">
                    <h3>Авторизация</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @error ('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" value="{{ old('email', isset($order) ? $order->email :
                             null) }}">
                        </div>
                        @error ('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Пароль</label>
                            <input type="password" name="password" autocomplete="current-password" value="{{ old
                            ('password', isset($order) ? $order->password : null) }}">
                        </div>
                        <!-- Remember Me -->
{{--                        <div class="form-group">--}}
{{--                            <label for="remember_me" class="inline-flex items-center">--}}
{{--                                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">--}}
{{--                                <span>Запомнить меня</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
                        <div class="form-group">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    Забыли пароль?
                                </a>
                            @endif
                        </div>
                        @csrf
                        <button class="more">Войти</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
