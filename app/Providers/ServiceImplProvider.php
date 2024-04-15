<?php

namespace App\Providers;

use App\Service\AuthService;
use App\Service\CategoryService;
use App\Service\Impl\AuthServiceImpl;
use App\Service\Impl\CategoryServiceImpl;
use App\Service\Impl\MenuServiceImpl;
use App\Service\MenuService;
use Illuminate\Support\ServiceProvider;

class ServiceImplProvider extends ServiceProvider
{

    public array $singletons = [
        CategoryService::class => CategoryServiceImpl::class,
        AuthService::class => AuthServiceImpl::class,
        MenuService::class => MenuServiceImpl::class,
    ];

    public function provides(): array
    {
        return [
            CategoryService::class,
            AuthService::class,
            MenuService::class
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
