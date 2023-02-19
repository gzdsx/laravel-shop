<?php

namespace App\Providers;

use App\Services\AccountService;
use App\Services\Contracts\AccountServiceInterface;
use App\Services\Contracts\OrderServiceInterface;
use App\Services\OrderService;
use App\Validators\AccountValidator;
use App\Validators\PhoneValidaotr;
use App\Validators\PasswordValidator;
use App\Validators\NickNameValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $validators = [
        'pwd' => PasswordValidator::class,
        'phone' => PhoneValidaotr::class,
        'nickname' => NickNameValidator::class,
        'account' => AccountValidator::class
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerValidators();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \Carbon\Carbon::setLocale('zh');
        $this->app->singleton(AccountServiceInterface::class, function () {
            return new AccountService();
        });

        $this->app->singleton(OrderServiceInterface::class, function () {
            return new OrderService();
        });
    }

    /**
     * register custom validators
     */
    protected function registerValidators()
    {
        foreach ($this->validators as $rule => $validator) {
            Validator::extend($rule, "{$validator}@validate");
        }
    }
}
