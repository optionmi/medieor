@extends('layouts.app')
@section('content')
    <main class="bg-gray-200">
        <div class="container min-h-screen py-10 mx-auto">
            <div class="flex items-center justify-center h-full sm:p-2">
                <div class="max-w-3xl px-5 py-5 bg-white border border-gray-100 rounded-md shadow-lg sm:px-10">
                    <div class="flex flex-col items-center justify-center">
                        <div class="mb-5">
                            <a href="/">
                                <img src="{{ asset('img/logo.jpg') }}" alt=""></a>
                        </div>
                        <h1 class="text-xl font-bold sm:text-2xl">Register a new account</h1>
                    </div>
                    <div class="my-5">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="text-sm text-red-500">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="" method="POST">
                            @csrf
                            <div class="flex flex-col justify-between sm:gap-5 sm:flex-row">
                                <div class="flex-1 mb-5">
                                    <label class="text-sm" for="name">Name</label>
                                    <input type="text" name="name" id="name"
                                        class="w-full p-2 border border-gray-300 rounded-md" placeholder="Full Name"
                                        required />
                                </div>
                                <div class="flex-1 mb-5">
                                    <label class="text-sm" for="email">Email</label>
                                    <input type="email" name="email" id="email"
                                        class="w-full p-2 border border-gray-300 rounded-md" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="flex flex-col justify-between sm:gap-5 sm:flex-row">
                                <div class="flex-1 mb-5">
                                    <label class="text-sm" for="country">Country</label>
                                    <select name="country" id="country"
                                        class="w-full p-2 border border-gray-300 rounded-md">
                                        <option value="">Select your country</option>
                                        @foreach ($countries as $code => $name)
                                            <option value="{{ $code }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-xs text-blue-500">By sharing your location, you enable us to tailor
                                        our
                                        services to better match your local interests.</span>
                                </div>
                                <div class="flex-1 mb-5">
                                    <label class="text-sm" for="phone">Phone</label>
                                    <input type="number" name="phone"
                                        class="w-full p-2 border border-gray-300 rounded-md" placeholder="Your Phone Number"
                                        min="1000000000" max="9999999999" required>
                                </div>
                            </div>
                            <div class="mb-5">
                                <label class="text-sm" for="phone">I am Interested in</label>
                                <div class="flex flex-wrap my-1">
                                    @foreach ($categories as $category)
                                        <div class="flex items-center gap-2 my-1 sm:w-1/3">
                                            <input type="checkbox" value="{{ $category->id }}" name="categories[]"
                                                id="category{{ $category->id }}">
                                            <label for="category{{ $category->id }}">{{ $category->title }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="flex flex-col justify-between sm:gap-5 sm:flex-row">
                                <div class="flex-1 mb-5">
                                    <label class="text-sm" for="password">Password</label>
                                    <input type="password" name="password" id="password"
                                        class="w-full p-2 border border-gray-300 rounded-md" placeholder="Password"
                                        required>
                                </div>
                                <div class="flex-1 mb-5">
                                    <label class="text-sm" for="password_confirmation">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="w-full p-2 border border-gray-300 rounded-md" placeholder="Confirm Password"
                                        required>
                                </div>
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
