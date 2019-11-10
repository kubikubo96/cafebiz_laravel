<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Post;
use App\Policies\PostPolicy;
use App\Permission;
use App\Comment;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//         'App\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //SupperAdmin
        Gate::before(function($user){
            if($user->id == 1){
                return true;
            }
        });

        if(! $this->app->runningInConsole()){
            foreach(Permission::all() as $permission){
                Gate::define($permission->name,function ($user) use ($permission) {
                    return $user->hasPermission($permission);
                });
            }
        }
    }
}
