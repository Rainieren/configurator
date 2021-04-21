@extends('layouts.auth')

@section('content')

    <div class="flex items-center justify-center h-screen overflow-hidden">
        <div class="container mx-auto">
            <div class="flex shadow-xl rounded-lg animate__animated animate__zoomIn animate__faster">
                <div class="w-2/4 bg-indigo-600 text-white p-5 auth-vector rounded-l-lg">
                    <h1 class="text-2xl font-serif">Welkom</h1>
                </div>
                <div class="w-2/4 p-10 bg-white rounded-r-lg">
                    <h1 class="text-3xl mb-4 font-serif font-bold">Register</h1>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="space-y-6">
                            <div class="w-1/2">
                                <label for="first_name" class="block text-xs my-2 font-medium text-gray-700 uppercase tracking-wide">First name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror px-3 py-2 border border-gray-300 w-full rounded" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="w-1/2">
                                <label for="first_name" class="block text-xs my-2 font-medium text-gray-700 uppercase tracking-wide">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror px-3 py-2 border border-gray-300 w-full rounded" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                            </div>
                            <div class="w-1/2">
                                <label for="password-confirm" class="block text-xs my-2 font-medium text-gray-700 uppercase tracking-wide">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="px-3 py-2 border border-gray-300 w-full rounded" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <div class="w-1/2">
                                <button type="submit" class="px-5 py-2 bg-indigo-500 rounded shadow text-white hover:bg-indigo-700 transition">
                                    {{ __('Register') }}
                                </button>
                                <div class="w-100 my-3">
                                    <a class="flex space-x-5" href="/login">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                                        </svg>{{ __('Back to signup') }}</a>
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
