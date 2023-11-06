<?php

namespace App\Listeners;

use App\Events\LessonWatched;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Model\AchievementCounter;
use App\Model\Achievement;

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
        * creating fake 1 watch entry of next lesson
        */
        $randomUser = $event->user->inRandomOrder()->first();
        $nextLesson = $event->lesson->doesnthave('lesson_user')-orderBy('id')->first();
        $event->lesson->faker()->create(['lesson_id' => $nextLesson->id, 
        'user_id' => $randomUser->id]);

        /**
         * Actual event logic to be performed
         */
        
        //get count of comments
        $lessonCounts = $event->lesson->where('user_id', $randomUser->id)->count();

        //get comment achievement
        $achievementCounter = AchievementCounter::where(['count' => $lessonCounts,
        'achievement_slug' => 'lesson'])->first();

        //dispacth Achievement Unclocked for comment if it meets the condition
        if($achievementCounter) {
            event(new AchievementUnlocked($achievementCounter, $randomUser));
        }
    }
}
