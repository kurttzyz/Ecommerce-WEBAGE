<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Orders;
use App\Policies\OrderPolicy;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{   
    protected $policies = [
        Order::class => OrderPolicy::class,
    ];
   

    public function boot(): void
    {
        $this->registerPolicies();
    }
}