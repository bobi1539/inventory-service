<?php

namespace App\Providers;

use App\Repository\CategoryRepository;
use App\Repository\Impl\CategoryRepositoryImpl;
use App\Repository\Impl\MenuRepositoryImpl;
use App\Repository\Impl\UserRepositoryImpl;
use App\Repository\MenuRepository;
use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{

    public array $singletons = [
        CategoryRepository::class => CategoryRepositoryImpl::class,
        UserRepository::class => UserRepositoryImpl::class,
        MenuRepository::class => MenuRepositoryImpl::class,
    ];

    public function provides(): array
    {
        return [
            CategoryRepository::class,
            UserRepository::class,
            MenuRepository::class,
        ];
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
