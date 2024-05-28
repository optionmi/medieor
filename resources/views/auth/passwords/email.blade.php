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
                        <p class="text-sm text-center text-gray-500">Forgot your password? No problem. Just let us know your
                            email address and we will email you a
                            password reset link that will allow you to choose a new one.
                        </p>
                    </div>
                    <div class="my-5">
                        @if (session('status'))
                            <div class="p-4 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">
                                <p class="font-bold">Success</p>
                                <p class="text-sm">{{ session('status') }}</p>
                            </div>
                        @endif
                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="mb-5">
                                <label class="text-sm" for="email">Email</label>
                                <input id="email" type="email" class="w-full p-2 border border-gray-300 rounded-md"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="mt-1 text-sm text-red-500" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button class="w-full p-2 font-bold text-white bg-blue-500 rounded-md">Send Password Reset
                                Link</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </main>
@endsection
