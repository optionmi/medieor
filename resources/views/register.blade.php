@extends('layouts.app')
@section('content')
    <main class="bg-gray-200">
        <div class="container h-screen mx-auto">
            <div class="flex items-center justify-center h-full p-2">
                <div class="px-10 py-5 bg-white border border-gray-100 rounded-md shadow-lg">
                    <div class="flex flex-col items-center justify-center">
                        <div class="mb-5">
                            <a href="/">
                                <img src="{{ asset('img/logo.jpg') }}" alt=""></a>
                        </div>
                        <h1 class="text-2xl font-bold">Register a new account</h1>
                    </div>
                    <div class="my-5">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="" method="POST">
                            @csrf
                            <div class="mb-5">
                                <label class="text-sm" for="name">Name</label>
                                <input type="text" name="name" id="name"
                                    class="w-full p-2 border border-gray-300 rounded-md" placeholder="Full Name" required />
                            </div>
                            <div class="mb-5">
                                <label class="text-sm" for="email">Email</label>
                                <input type="email" name="email" id="email"
                                    class="w-full p-2 border border-gray-300 rounded-md" placeholder="Email" required>
                            </div>
                            <div class="mb-5">
                                <label class="text-sm" for="country">Country</label>
                                <select name="country" id="country" class="w-full p-2 border border-gray-300 rounded-md">
                                    <option value="">Select a country</option>
                                    @foreach ($countries as $code => $name)
                                        <option value="{{ $code }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-5">
                                <label class="text-sm" for="phone">Phone</label>
                                <input type="number" name="phone" class="w-full p-2 border border-gray-300 rounded-md"
                                    placeholder="10 digit Mobile Number" min="1000000000" max="9999999999" required>
                            </div>
                            <div class="mb-5">
                                <label class="text-sm" for="password">Password</label>
                                <input type="password" name="password" id="password"
                                    class="w-full p-2 border border-gray-300 rounded-md" placeholder="Password" required>
                            </div>
                            <div class="mb-5">
                                <label class="text-sm" for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full p-2 border border-gray-300 rounded-md" placeholder="Confirm Password"
                                    required>
                            </div>
                            <div>
                                <button class="w-full p-2 font-bold text-white bg-blue-500 rounded-md">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
