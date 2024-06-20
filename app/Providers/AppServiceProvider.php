<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use App\Services\Movie\MoviesService;
use Illuminate\Support\ServiceProvider;
use App\Services\Category\CategoryService;
use App\Services\Movie\MoviesServiceImpl;
use App\Services\Category\CategoryServiceImpl;
use App\Services\Utilisateur\UtilisateurService;
use App\Services\Illustration\IllustrationService;
use App\Services\Utilisateur\UtilisateurServiceImpl;
use App\Services\Illustration\IllustrationServiceImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $app = $this->app;

        $app->bind(IllustrationService::class, IllustrationServiceImpl::class);
        $app->bind(UtilisateurService::class, UtilisateurServiceImpl::class);
        $app->bind(CategoryService::class, CategoryServiceImpl::class);
        $app->bind(MoviesService::class, MoviesServiceImpl::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrap();

    }
}
