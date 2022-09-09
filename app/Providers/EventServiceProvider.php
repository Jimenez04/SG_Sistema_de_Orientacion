<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \App\Events\StudentSaved::class => [
            \App\Listeners\SendEmailStudent::class,
            \App\Listeners\SendEmailAdmin::class,
        ],
        \App\Events\UserValidate::class => [
            \App\Listeners\ValidateSendEmailUser::class,
            \App\Listeners\ValidateSendEmailAdmin::class,
        ],
        \App\Events\User_ForgetAccount::class => [
            \App\Listeners\UserForgetAccount::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
