@extends('layouts.app')

@section('content')
    @include('partials.header')
    <main class="min-h-[calc(100vh-6rem)] py-10 bg-gray-100">
        <div class="container mx-auto">
            <div class="sm:w-1/3 px-5 py-2 mx-auto skew-x-[-20deg] bg-primary">
                <h1 class="text-2xl  skew-x-[20deg] font-semibold text-center text-white">Articles</h1>
            </div>

            <div class="flex flex-col flex-wrap items-start justify-around gap-10 p-5 py-10 sm:flex-row">
                @if (count($articles) == 0)
                    <p class="text-center">No articles found in this category.</p>
                @else
                    @foreach ($articles as $article)
                        <article class="flex p-10 bg-white rounded-md shadow-md">
                            <div class="flex flex-col gap-5 sm:flex-row">
                                <div class="w-full sm:w-1/3">
                                    <img src="{{ asset('images/articles/' . $article->media) }}" alt="">
                                </div>
                                <div class="w-full sm:w-2/3">
                                    <div class="flex flex-col gap-4">
                                        <div>
                                            <h1 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h1>
                                            <small class="text-gray-500"><i class="fa fa-clock"></i>
                                                {{ $article->created_at->diffForHumans() }}</small>
                                        </div>
                                        <div>
                                            <p>{!! $article->content !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                @endif
            </div>
        </div>
    </main>
@endsection
