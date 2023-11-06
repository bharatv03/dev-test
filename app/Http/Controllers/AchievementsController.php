<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Comment;
use App\Events\LessonWatched;
use App\Events\CommentWritten;

class AchievementsController extends Controller
{
    public function index(User $user)
    {
        $returnArray = Helper::combinedAchievements($user->id);
        
        return response()->json($returnArray);
    }

    public function testEvent()
    {
        $lesson = new Lesson;
        $user = new User;

        /**
        * creating fake 1 watch entry of next lesson
        */
        //$randomUser = $event->user->inRandomOrder()->first();
        $randomUser = $user->where('id', 1)->first();
        
        $nextLesson = $lesson->doesnthave('watched')->orderBy('id','asc')->first();
        
        $randomUser->lessons()->attach($nextLesson->id, ['watched' => true]);

        event(new LessonWatched($lesson, $randomUser));
    }

    public function testEventComment()
    {
        $comment = new Comment;
        $user = new User;

        /**
        * creating fake 1 entiry of comment on behalf for a user 
        * to perform controller task where after below event can be 
        * called to check conditions and trigger
        */
        $randomUser = $user->inRandomOrder()->first();
        $comment->factory()->create(['user_id' => $randomUser->id]);

        event(new CommentWritten($comment, $randomUser));
    }
}
