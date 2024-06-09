@props(['users'])

<h2 class="font-bold text-gray-800">{{ Str::plural('Member', $users->count()) }}</h2>
<div class="flex my-2 -space-x-4 rtl:space-x-reverse">
    @foreach ($users->take(5) as $user)
        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800"
            src="{{ asset('images/user_avatar/' . $user->img) }}" alt="{{ $user->name }} image">
    @endforeach
    @if ($users->count() > 5)
        <a class="flex items-center justify-center w-10 h-10 text-xs font-medium text-white bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800"
            href="#">...</a>
    @endif
</div>
