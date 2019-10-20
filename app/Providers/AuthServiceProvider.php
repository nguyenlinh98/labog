<?php

namespace App\Providers;

use App\Category;
use App\Policies\CategoryPolicy;
use App\Policies\UserPolicy;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        \App\Post::class => \App\Policies\PostPolicy::class,
        \App\User::class =>  \App\Policies\UserPolicy::class,
        Category::class => CategoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // phan quyen admin, editor, author, member
        Gate:: define('befor',function($user)
        {
            if($user->role === 'admin')
            {
                return true;
            }
        });

        Gate::define('delete_post', function ($user, $post) {
            return in_array($user->role ,'admin')||$user->id == $post->user_id;
        });

        Gate::define('view-category',function($user)
        {
            return in_array($user->role, ['admin','editor']);
        });

        Gate::define('admin',function ($user)
        {
            return $user->role === 'admin';
        });

        Gate:: define('editor',function ($user)
        {
            return $user->role === 'editor';
        });

        Gate:: define('author',function ($user)
        {
            return true;
        });

        Gate:: define('member',function ($user)
        {
            return true;
        });


    }

}
