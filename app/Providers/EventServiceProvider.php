<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\LessonWatched;
use App\Events\CommentWritten;
use App\Listeners\Comments;
use App\Listeners\Lessons;
use App\Events\AchievementUnlocked;
use App\Events\BadgesUnlocked;
use App\Listeners\Badges;
use App\Listeners\Achievements;

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
        LessonWatched::class=> [
            Lessons::class,
        ],
        CommentWritten::class=> [
            Comments::class,
        ],
        AchievementUnlocked::class=> [
            Achievements::class,
        ],
        BadgesUnlocked::class=> [
            Badges::class,
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
