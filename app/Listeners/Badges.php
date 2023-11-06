<?php

namespace App\Listeners;

use App\Events\BadgesUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Achievement;

class Badges
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BadgesUnlocked $event): void
    {
         //adding data to achievements
         Achievement::create(['achievement_id'=>$event->acheivement->id,
         'user_id' => $event->user->id]);
    }
}
