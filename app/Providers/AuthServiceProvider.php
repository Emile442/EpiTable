<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\Slot;
use App\Models\Table;
use App\Models\User;
use App\Policies\BookingPolicy;
use App\Policies\SlotPolicy;
use App\Policies\TablePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Table::class    => TablePolicy::class,
        Slot::class     => SlotPolicy::class,
        Booking::class  => BookingPolicy::class,
        User::class     => UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
