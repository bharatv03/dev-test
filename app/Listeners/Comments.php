<?php

namespace App\Listeners;

use App\Events\CommentWritten;
use App\Events\AchievementUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\AchievementCounter;

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
         * Actually event logic to be performed
         */
        //get count of comments
        $commentCounts = $event->comment->where('user_id', $event->user->id)->count();

        //get comment achievement
        $achievementCounter = AchievementCounter::where(['count' => $commentCounts,
        'achievement_slug' => 'comment'])->first();

        //dispacth Achievement Unclocked for comment if it meets the condition
        if($achievementCounter) {
            event(new AchievementUnlocked($achievementCounter, $event->user));
        }
    }
}
