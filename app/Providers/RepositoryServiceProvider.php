<?php

namespace App\Providers;


use App\Repositories\Contracts\CartRepositoryInterface;
use App\Repositories\Contracts\ItemCollectRepositoryInterface;
use App\Repositories\Contracts\ItemRepositoryInterface;
use App\Repositories\Contracts\MaterialRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\PagesRepositoryInterface;
use App\Repositories\Contracts\PostCatlogRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\ShopRepositoryInterface;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\CartRepository;
use App\Repositories\Eloquent\ItemCatlogRepository;
use App\Repositories\Eloquent\ItemRepository;
use App\Repositories\Eloquent\MaterialRepository;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Eloquent\PagesRepository;
use App\Repositories\Eloquent\PostCatlogRepository;
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

        $this->app->singleton(PostCatlogRepositoryInterface::class, function () {
            return new PostCatlogRepository();
        });

        $this->app->singleton(ItemRepositoryInterface::class, function () {
            return new ItemRepository();
        });

        $this->app->singleton(ItemCollectRepositoryInterface::class, function () {
            return new ItemCatlogRepository();
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
        //cart
        $this->app->singleton(CartRepositoryInterface::class, function (){
            return new CartRepository();
        });

        $this->app->singleton(MaterialRepositoryInterface::class, function () {
            return new MaterialRepository();
        });
        //pages
        $this->app->singleton(PagesRepositoryInterface::class, function () {
            return new PagesRepository();
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
