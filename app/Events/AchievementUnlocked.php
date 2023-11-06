<?php

namespace App\Events;

use App\Models\User;
use App\Models\AchievementCounter;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AchievementUnlocked
{
    use Dispatchable, SerializesModels;

    public $achievementCounter;
    public $user;

    /**
     * Create a new event instance.
     */
    public function __construct($achievementCounter, $user)
    {
        $this->achievementCounter = $achievementCounter;
        $this->user = $user;
    }
}
