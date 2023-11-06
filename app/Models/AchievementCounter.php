<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchievementCounter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'count',
        'achievement_slug',
        'name'
    ];

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }
}
