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
        ],
        \App\Events\request_Adequacy::class => [
            \App\Listeners\adequacyEmailAdmin::class,
            \App\Listeners\adequacyEmailuser::class,
        ],
        \App\Events\update_status_Request_adequacy::class => [
            \App\Listeners\updatestatusAdequacyEmailAdmin::class,
            \App\Listeners\updateStatusAdequacyEmailuser::class,
        ],
        \App\Events\request_PAI::class => [
            \App\Listeners\request_PAIEmailAdmin::class,
            \App\Listeners\request_PAIuser::class,
        ],
        \App\Events\update_statu_PAI::class => [
            \App\Listeners\update_statut_PAIEmailAdmin::class,
            \App\Listeners\update_statu_PAIuser::class,
        ],
        \App\Events\resume_PAI::class => [
            \App\Listeners\resume_PAIEmailAdmin::class,
            \App\Listeners\resume_PAIuser::class,
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
