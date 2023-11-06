<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'achievement_counter_id',
        'user_id'
    ];

    /**
     * Get the user who got achievements.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the type of achievements.
     */
    public function lessonAchievements()
    {
        return $this->belongsTo(AchievementCounter::class,'achievement_counter_id','id')
        ->where('achievement_slug','lesson');
    }

    /**
     * Get the type of achievements.
     */
    public function commentAchievements()
    {
        return $this->belongsTo(AchievementCounter::class,'achievement_counter_id','id')
        ->where('achievement_slug','comment');
    }

    /**
     * Get the type of achievements.
     */
    public function badgeAchievements()
    {
        return $this->belongsTo(AchievementCounter::class,'achievement_counter_id','id')
        ->where('achievement_slug','badge');
    }

    /**
     * Get the type of achievements.
     */
    public function nonBadgeAchievements()
    {
        return $this->belongsTo(AchievementCounter::class,'achievement_counter_id','id')
        ->where([['achievement_slug','!=','badge']]);
    }

    /**
     * Get the type of achievements.
     */
    public function nonBadgeAchievementCounters()
    {
        return $this->belongsTo(AchievementCounter::class,'id', 'achievement_counter_id')
        ->where([['achievement_slug','!=','badge']]);
    }

    public function achivementCounter()
    {
        return $this->belongsTo(AchivementCounter::class);
    }
}
