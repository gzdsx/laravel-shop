<?php

namespace App\Providers;


use App\Repositories\Contracts\MaterialRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\PageRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\ShopRepositoryInterface;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\MaterialRepository;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Eloquent\PageRepository;
use App\Repositories\Eloquent\PostRespository;
use App\Repositories\Eloquent\ShopRepository;
use App\Repositories\Eloquent\TransactionRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepositoryInterface::class, function () {
            return new UserRepository();
        });

        $this->app->singleton(PostRepositoryInterface::class, function () {
            return new PostRespository();
        });

        $this->app->singleton(ShopRepositoryInterface::class, function () {
            return new ShopRepository();
        });

        $this->app->singleton(OrderRepositoryInterface::class, function () {
            return new OrderRepository();
        });

        $this->app->singleton(TransactionRepositoryInterface::class, function () {
            return new TransactionRepository();
        });

        $this->app->singleton(MaterialRepositoryInterface::class, function () {
            return new MaterialRepository();
        });
        //pages
        $this->app->singleton(PageRepositoryInterface::class, function () {
            return new PageRepository();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
