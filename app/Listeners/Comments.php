<?php

namespace App\Listeners;

use App\Events\CommentWritten;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Model\AchievementCounter;

class Comments
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
    public function handle(CommentWritten $event): void
    {
        /**
        * creating fake 1 entiry of comment on behalf for a user 
        * to perform controller task where after below event can be 
        * called to check conditions and trigger
        */
        $randomUser = $event->user->inRandomOrder()->first();
        $event->comment->faker()->create(['user_id' => $randomUser->id]);

        /**
         * Actually event logic to be performed
         */
        
        //get count of comments
        $commentCounts = $event->comment->where('user_id', $randomUser->id)->count();

        //get comment achievement
        $achievementCounter = AchievementCounter::where(['count' => $commentCounts,
        'achievement_slug' => 'comment'])->first();

        //dispacth Achievement Unclocked for comment if it meets the condition
        if($achievementCounter) {
            event(new AchievementUnlocked($achievementCounter, $randomUser));
        }
    }
}
