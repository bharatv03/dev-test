<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Achievement;
use App\Events\BadgesUnlocked;

class Achievements
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
    public function handle(AchievementUnlocked $event): void
    {
        //adding data to achievements
        Achievement::create(['achievement_id'=>$event->acheivement->id,
        'user_id' => $event->user->id]);

        //get count for total achievements
        $totalAchievementCounts = Achievement::where([['user_id', '=', $event->user->id],
        ['achievement_slug', '!=', 'badge']])->count();

        //match achievements to find badge achievement
        $achievementCounter = AchievementCounter::where(['count' => $totalAchievementCounts,
        'achievement_slug' => 'badge'])->first();

        //dispacth Badge Unclocked for total achievements if it meets the condition
        if($achievementCounter) {
            event(new BadgesUnlocked($achievementCounter, $event->user->id));
        }
    }
}
