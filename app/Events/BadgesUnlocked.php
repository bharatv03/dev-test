<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BadgesUnlocked
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
