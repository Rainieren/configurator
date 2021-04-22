@extends('layouts.auth')

@section('content')
    <div class="flex items-center justify-center h-screen overflow-hidden z-10">
        <div class="container mx-auto">
            <div class="flex shadow-xl rounded-lg animate__animated animate__zoomIn animate__faster">
                <div class="w-2/4 bg-indigo-600 text-white p-5 auth-vector rounded-l-lg">
                    <h1 class="text-3xl font-bold">Welkom</h1>
                </div>
                <div class="w-2/4 p-10 bg-white rounded-r-lg">
                    <h1 class="text-3xl mb-4 font-serif font-bold">Login</h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="space-y-6">
                            <div class="w-1/2">
                                <label for="first_name" class="block text-xs my-2 font-medium text-gray-700 uppercase tracking-wide">{{ __('First name') }}</label>
                                <input id="email" type="email" class="@error('email') is-invalid @enderror px-3 py-2 border border-gray-300 w-full rounded" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="w-1/2">
                                <label for="password" class="block text-xs my-2 font-medium text-gray-700 uppercase tracking-wide">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror px-3 py-2 border border-gray-300 w-full rounded" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="w-100 my-2">
                                    @if (Route::has('password.request'))
                                        <a class="" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="w-1/2">
                                <input class="form-checkbox rounded text-indigo-500" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            <div class="w-1/2">
                                <button type="submit" class="px-5 py-2 bg-indigo-500 rounded shadow text-white hover:bg-indigo-700 transition">
                                    {{ __('Signup') }}
                                </button>
                                <div class="w-100 my-3">
                                    <a href="/register">
                                        {{ __('Dont have a accout?') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <style>
            .auth-vector {
                background-image: url("/images/auth_vector1.jpg");
                background-size: cover;
                background-repeat: no-repeat;
            }


        </style>


@endsection
