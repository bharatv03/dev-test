<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Comment;
use App\Models\Lesson;
use App\Models\Achievement;
use App\Events\LessonWatched;
use App\Events\CommentWritten;

class AchievementTest extends TestCase
{
    
    public function test_no_lesson_no_comment_no_achievement_true(): void
    {
        $user = User::find(1);
        $watchedLesson = $user->watched->count();
        $comments = Comment::where('user_id', $user->id)->count();
        $achievements = Achievement::where('user_id', $user->id)->count();
        $result = true;
        if($comments && $watchedLesson && $achievements){
            $result = false;
        }
        $this->assertTrue($result);
    }

    public function test_one_lesson_one_achievement_badge_zero_true(): void
    {
        $user = User::find(1);
        $lesson = new Lesson;
        
        $nextLesson = $lesson->doesnthave('watched')->orderBy('id','asc')->first();
        
        $user->lessons()->attach($nextLesson->id, ['watched' => true]);

        event(new LessonWatched($lesson, $user));

        $result = false;

        $achievements = Achievement::where('user_id', $user->id)->count();

        if($achievements == 1) {
            $result = true;
        }

        $this->assertTrue($result);
    }

    public function test_one_comment_two_achievement_badge_zero_true(): void
    {
        $user = User::find(1);
        $comment = new Comment;
        $comment->factory()->create(['user_id' => $user->id]);
        event(new CommentWritten($comment, $user));
        $result = false;

        $achievements = Achievement::where('user_id', $user->id)->count();

        if($achievements == 2) {
            $result = true;
        }

        $this->assertTrue($result);
    }

    public function test_four_more_lesson_total_three_achievement_badge_zero_true(): void
    {
        $user = User::find(1);
        $lesson = new Lesson;
        for($i=0; $i<=3; $i++) {
            $nextLesson = $lesson->doesnthave('watched')->orderBy('id','asc')->first();
            $user->lessons()->attach($nextLesson->id, ['watched' => true]);
        }
        event(new LessonWatched($lesson, $user));

        $result = false;

        $achievements = Achievement::where('user_id', $user->id)->count();

        if($achievements == 3) {
            $result = true;
        }

        $this->assertTrue($result);
    }

    public function test_two_more_comments_total_four_achievement_badge_one_true(): void
    {
        $user = User::find(1);
        $comment = new Comment;
        $comment->factory()->count(2)->create(['user_id' => $user->id]);
        event(new CommentWritten($comment, $user));
        $result = false;

        $achievements = Achievement::where('user_id', $user->id)->count();

        if($achievements == 5) {
            $result = true;
        }

        $this->assertTrue($result);
    }
}
