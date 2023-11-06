<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\User;
use App\Models\AchievementCounter;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* Lesson seeders */
        $lessons = Lesson::factory()
            ->count(20)
            ->create();

        /* User seeders */
        $users = User::factory()
            ->count(5)
            ->create();
        
        /* Achievement counter array */
        $achvCountArray = [
            [
                'count' => '1',
                'achievement_slug' => 'lesson',
                'name' => 'First Lesson Achievement'
            ],
            [
                'count' => '5',
                'achievement_slug' => 'lesson',
                'name' => 'Five Lesson Achievement'
            ],
            [
                'count' => '10',
                'achievement_slug' => 'lesson',
                'name' => 'Ten Lesson Achievement'
            ],
            [
                'count' => '25',
                'achievement_slug' => 'lesson',
                'name' => 'Twenty Five Lesson Achievement'
            ],
            [
                'count' => '50',
                'achievement_slug' => 'lesson',
                'name' => 'Fifty Lesson Achievement'
            ],
            [
                'count' => '1',
                'achievement_slug' => 'comment',
                'name' => 'First Comment Achievement'
            ],
            [
                'count' => '3',
                'achievement_slug' => 'comment',
                'name' => 'Three Comment Achievement'
            ],
            [
                'count' => '5',
                'achievement_slug' => 'comment',
                'name' => 'Five Comment Achievement'
            ],
            [
                'count' => '10',
                'achievement_slug' => 'comment',
                'name' => 'Ten Comment Achievement'
            ],
            [
                'count' => '20',
                'achievement_slug' => 'comment',
                'name' => 'Twenty Comment Achievement'
            ],
            [
                'count' => '0',
                'achievement_slug' => 'badge',
                'name' => 'Beginner'
            ],
            [
                'count' => '4',
                'achievement_slug' => 'badge',
                'name' => 'Intermediate'
            ],
            [
                'count' => '8',
                'achievement_slug' => 'badge',
                'name' => 'Advanced'
            ],
            [
                'count' => '8',
                'achievement_slug' => 'badge',
                'name' => 'Master'
            ],
        ];
        $achCount = AchievementCounter::insert($achvCountArray);
    }
}
