@extends('layouts.misc')
@section('title')
    Contact Us
@endsection
@section('styles')
@endsection

@section('content')
    @include('partials.misc.header')

    <section class="bg-primary mt-[-4rem] h-72 flex justify-center items-center">
        <h1 class="text-4xl font-semibold text-center text-white uppercase text-shadow-sm shadow-black">
            {{ $data->img_text1 }}</h1>
    </section>

    <section class="container flex flex-col justify-center gap-5 mx-auto sm:flex-row">
        <div class="w-full p-2 sm:w-1/3 sm:p-5">
            <div class="flex items-center gap-2 my-2">
                <div class="w-6 h-1 bg-primary"></div>
                <span class="text-sm font-semibold uppercase">Get In Touch</span>
            </div>
            <h1 class="mb-5 text-4xl font-semibold uppercase">Contact Information</h1>
            <p>Have a question, comment, or feedback? We'd love to hear from you. Feel free to reach out. Our team will be
                ready to assist you.</p>
            <ul class="flex flex-col gap-4 my-10">
                <li class="flex items-center gap-4">
                    <div
                        class="flex items-center justify-center flex-grow-0 flex-shrink-0 w-16 h-16 text-white rounded-md bg-primary">
                        <i class="fa-2xl fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold">Address</h2>
                        <p class="font-medium text-gray-700">{{ $data->section1 }}</p>
                    </div>
                </li>
                <hr>
                <li class="flex items-center gap-4">
                    <div
                        class="flex items-center justify-center flex-grow-0 flex-shrink-0 w-16 h-16 text-white rounded-md bg-primary">
                        <i class="fa-2xl fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold">Email</h2>
                        <ul>
                            @foreach ($data->emails as $email)
                                <li class="font-medium text-gray-700">{{ $email }}</li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <hr>
                <li class="flex items-center gap-4">
                    <div
                        class="flex items-center justify-center flex-grow-0 flex-shrink-0 w-16 h-16 text-white rounded-md bg-primary">
                        <i class="fa-2xl fa-solid fa-phone"></i>
                    </div>
                    <div class="w-1/3">
                        <h2 class="text-lg font-semibold">Phone</h2>
                        <ul>
                            @foreach ($data->phones as $phone)
                                <li class="font-medium text-gray-700">{{ $phone }}</li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

        <div class="w-full p-2 sm:w-1/3 sm:p-5">
            <div class="flex items-center gap-2 my-2">
                <div class="w-6 h-1 bg-primary"></div>
                <span class="text-sm font-semibold uppercase">Drop Us a Line</span>
            </div>
            <h1 class="mb-5 text-4xl font-semibold uppercase">Send us a Message</h1>
            <form action="" method="POST" class="flex flex-col gap-3">
                @csrf
                <input class="px-3 py-2 rounded-sm" type="text" name="name" id="name" placeholder="Your Name">
                <input class="px-3 py-2 rounded-sm" type="email" name="email" id="email" placeholder="Your Email">
                <input class="px-3 py-2 rounded-sm" type="number" name="phone" id="phone" placeholder="Your Phone"
                    min="1000000000" max="9999999999">
                <textarea name="message" id="message" cols="30" rows="10" class="px-3 py-2 rounded-sm"
                    placeholder="Your Message"></textarea>
                <button class="px-3 py-2 font-semibold text-center text-white uppercase rounded-sm bg-primary"
                    type="submit">Send
                    Message</button>
            </form>
        </div>
    </section>

    @include('partials.misc.footer')
@endsection
