<?php

namespace App\Providers;

use App\Repositories\Contracts\AddressRepositoryInterface;
use App\Repositories\Contracts\AdRepositoryInterface;
use App\Repositories\Contracts\BlockItemRepositoryInterface;
use App\Repositories\Contracts\BlockRepositoryInterface;
use App\Repositories\Contracts\CartRepositoryInterface;
use App\Repositories\Contracts\DistrictRepositoryInterface;
use App\Repositories\Contracts\ExpressRepositoryInterface;
use App\Repositories\Contracts\ItemCatlogRepositoryInterface;
use App\Repositories\Contracts\ItemCollectRepositoryInterface;
use App\Repositories\Contracts\ItemRepositoryInterface;
use App\Repositories\Contracts\LinkRepositoryInterface;
use App\Repositories\Contracts\MaterialRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\PagesRepositoryInterface;
use App\Repositories\Contracts\PostCatlogRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\RefundReasonRepositoryInterface;
use App\Repositories\Contracts\SettingsRepositoryInterface;
use App\Repositories\Contracts\ShopRepositoryInterface;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\Contracts\UserConnectRepositoryInterface;
use App\Repositories\Contracts\UserGroupRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\WechatMenuRepositoryInterface;
use App\Repositories\Eloquent\AddressRepository;
use App\Repositories\Eloquent\AdRepository;
use App\Repositories\Eloquent\BlockItemRepository;
use App\Repositories\Eloquent\BlockRepository;
use App\Repositories\Eloquent\CartRepository;
use App\Repositories\Eloquent\DistrictRepository;
use App\Repositories\Eloquent\ExpressRepository;
use App\Repositories\Eloquent\ItemCatlogRepository;
use App\Repositories\Eloquent\ItemRepository;
use App\Repositories\Eloquent\LinkRepository;
use App\Repositories\Eloquent\MaterialRepository;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Eloquent\PagesRepository;
use App\Repositories\Eloquent\PostCatlogRepository;
use App\Repositories\Eloquent\PostRespository;
use App\Repositories\Eloquent\RefundReasonRepository;
use App\Repositories\Eloquent\SettingsRepository;
use App\Repositories\Eloquent\ShopRepository;
use App\Repositories\Eloquent\TransactionRepository;
use App\Repositories\Eloquent\UserConnectRepository;
use App\Repositories\Eloquent\UserGroupRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\WechatMenuRepository;
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
        //settings
        $this->app->singleton(SettingsRepositoryInterface::class, function () {
            return new SettingsRepository();
        });
        //usergroup
        $this->app->singleton(UserGroupRepositoryInterface::class, function () {
            return new UserGroupRepository();
        });

        $this->app->singleton(UserRepositoryInterface::class, function () {
            return new UserRepository();
        });

        $this->app->singleton(UserConnectRepositoryInterface::class, function () {
            return new UserConnectRepository();
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

        $this->app->singleton(ItemCatlogRepositoryInterface::class, function () {
            return new ItemCatlogRepository();
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

        $this->app->singleton(AdRepositoryInterface::class, function () {
            return new AdRepository();
        });

        $this->app->singleton(MaterialRepositoryInterface::class, function () {
            return new MaterialRepository();
        });

        //address
        $this->app->singleton(AddressRepositoryInterface::class, function () {
            return new AddressRepository();
        });
        //link
        $this->app->singleton(LinkRepositoryInterface::class, function () {
            return new LinkRepository();
        });
        //refundreason
        $this->app->singleton(RefundReasonRepositoryInterface::class, function () {
            return new RefundReasonRepository();
        });
        //pages
        $this->app->singleton(PagesRepositoryInterface::class, function () {
            return new PagesRepository();
        });
        //express
        $this->app->singleton(ExpressRepositoryInterface::class, function () {
            return new ExpressRepository();
        });
        //district
        $this->app->singleton(DistrictRepositoryInterface::class, function () {
            return new DistrictRepository();
        });
        //wechatmenu
        $this->app->singleton(WechatMenuRepositoryInterface::class, function () {
            return new WechatMenuRepository();
        });
        //block
        $this->app->singleton(BlockRepositoryInterface::class, function () {
            return new BlockRepository();
        });
        $this->app->singleton(BlockItemRepositoryInterface::class, function () {
            return new BlockItemRepository();
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
