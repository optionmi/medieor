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
                        <h1 class="text-2xl font-bold">Login to your account</h1>
                    </div>
                    <div class="my-5">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-5">
                                <label class="text-sm" for="email">Email</label>
                                <input type="email" name="email" id="email"
                                    class="w-full p-2 border border-gray-300 rounded-md" placeholder="Email">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="relative mb-5">
                                <label class="text-sm" for="password">Password</label>
                                <input type="password" name="password" id="password"
                                    class="w-full p-2 border border-gray-300 rounded-md" placeholder="Password">
                                <span class="absolute text-gray-600 cursor-pointer bottom-2 right-2 togglePassword"><i
                                        class="fa-solid fa-eye"></i></span>
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="flex justify-end mb-5">
                                <a class="hover:underline" href="{{ route('password.request') }}">Forgot password?</a>
                            </div>

                            <button id="submitBtn"
                                class="w-full p-2 font-bold text-white bg-blue-500 rounded-md">Login</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        const form = document.querySelector('form');
        const submitBtn = document.querySelector('#submitBtn')
        form.addEventListener('submit', function(e) {
            submitBtn.disabled = true;
        });
    </script>
@endsection
