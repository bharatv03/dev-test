<?php

namespace App\Listeners;

use App\Events\LessonWatched;
use App\Events\AchievementUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\AchievementCounter;

class Lessons
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
    public function handle(LessonWatched $event): void
    {
        /**
         * Actual event logic to be performed
         */
        
        //get count of comments
        $lessonCounts = $event->user->watched->count();

        //get comment achievement
        $achievementCounter = AchievementCounter::where(['count' => $lessonCounts,
        'achievement_slug' => 'lesson'])->first();
        
        //dispacth Achievement Unclocked for comment if it meets the condition
        if($achievementCounter) {
            event(new AchievementUnlocked($achievementCounter, $event->user));
        }
    }
}
