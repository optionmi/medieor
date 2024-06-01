@extends('layouts.app')
@section('content')
    <main class="bg-gray-200">
        <div class="container h-screen mx-auto">
            <div class="flex items-center justify-center h-full p-2">
                <div class="px-10 py-5 bg-white border border-gray-100 rounded-md shadow-lg w-96">
                    <div class="flex flex-col items-center justify-center">
                        <div class="mb-5">
                            <a href="/">
                                <img src="{{ asset('img/logo.jpg') }}" alt=""></a>
                        </div>
                        <h1 class="text-2xl font-bold">Reset Password</h1>
                    </div>
                    <div class="my-5">
                        @if (session('status'))
                            <div class="p-4 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">
                                <p class="font-bold">Success</p>
                                <p class="text-sm">{{ session('status') }}</p>
                            </div>
                        @endif


                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="mb-5">
                                <label for="email" class="text-sm">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                    class="w-full p-2 border border-gray-300 rounded-md @error('email') is-invalid @enderror"
                                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                    autofocus>

                                @error('email')
                                    <span class="mt-1 text-sm text-red-500" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="password" class="text-sm">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="w-full p-2 border border-gray-300 rounded-md @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="mt-1 text-sm text-red-500" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="password-confirm" class="text-sm">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password"
                                    class="w-full p-2 border border-gray-300 rounded-md" name="password_confirmation"
                                    required autocomplete="new-password">
                            </div>


                            <button type="submit" class="w-full p-2 font-bold text-white bg-blue-500 rounded-md">
                                {{ __('Reset Password') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
