<?php

namespace App\Providers;

use App\Models\EcomProductItem;
use App\Models\Order;
use App\Models\PostItem;
use App\Policies\ProductItemPolicy;
use App\Policies\LivePolicy;
use App\Policies\OrderPolicy;
use App\Policies\PostItemPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Order::class => OrderPolicy::class,
        EcomProductItem::class => ProductItemPolicy::class,
        PostItem::class => PostItemPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
