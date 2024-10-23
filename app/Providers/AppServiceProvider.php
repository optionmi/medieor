<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Event;
use App\Models\Group;
use App\Models\Topic;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Donation;
use App\Models\CPComment;
use App\Models\CategoryPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.coreui.sidebar', function ($view) {
            $user = Auth::user();
            $lastLoginAt = session('last_login_at') ?? Carbon::now()->subYears(10);

            $newCategoriesCount = Category::where('created_at', '>', $lastLoginAt)->count();
            $newEventsCount = Event::where('created_at', '>', $lastLoginAt)->count();
            $newArticlesCount = Article::where('created_at', '>', $lastLoginAt)->count();
            $newDonationsCount = Donation::where('created_at', '>', $lastLoginAt)->count();
            $newUsersCount = User::where('created_at', '>', $lastLoginAt)->count();

            $newTopicsCount = Topic::where('created_at', '>', $lastLoginAt)->count();
            $newCategoryPostsCount = CategoryPost::where('created_at', '>', $lastLoginAt)->count();
            $newCPCommentsCount = CPComment::where('created_at', '>', $lastLoginAt)->count();

            $newAllGroupsCount = Group::where('created_at', '>', $lastLoginAt)->count();
            $newAllPostsCount = Post::where('created_at', '>', $lastLoginAt)->count();
            // $newJoinRequestsCount = Post::where('created_at', '>', $lastLoginAt)->count();
            $newCommentsCount = Comment::where('created_at', '>', $lastLoginAt)->count();

            $view->with(compact(
                'user',
                'newCategoriesCount',
                'newEventsCount',
                'newArticlesCount',
                'newDonationsCount',
                'newUsersCount',
                'newTopicsCount',
                'newCategoryPostsCount',
                'newCPCommentsCount',
                'newAllGroupsCount',
                'newAllPostsCount',
                'newCommentsCount',
            ));
        });
    }
}
