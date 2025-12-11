<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use App\Models\BorrowRecord;
use App\Policies\BookPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use App\Policies\AuthorPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\BorrowRecordPolicy;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Book::class => BookPolicy::class,
        BorrowRecord::class => BorrowRecordPolicy::class,
        Author::class => AuthorPolicy::class,
        Category::class => CategoryPolicy::class,
        Role::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define("accessManagement", function ($user) {
            return $user->role()->where('name', 'User')->doesntExist();
        });        

        Gate::define("allowToBorrow", function ($user) {
            $latestBorrowRecord = $user->borrowRecords()->latest()->first();

            return $latestBorrowRecord ? $latestBorrowRecord->isReturned() : true;
        });
    }
}
