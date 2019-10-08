<?php

namespace App\Providers;

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

        Gate::before(function($user){
            if($user->role === 'admin')
            {
                return true;
            }
            if($user->active === 1)
            {
                return false;
            }
        });

        Gate::define('admin',function($user)
        {
//            return $user->role === 'admin';
             return true;
        });

        Gate::define('editor',function($user)
        {
            return $user->role === 'editor';
        });
        Gate::define('author',function($user)
        {
            return $user->role === 'author';
        });
        Gate::define('member',function($user)
        {
//            return $user->role === 'member';
            if($user->active === 1)
            {
                return redirect('posts');
            }
        });

        //
    }

}
