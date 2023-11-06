<?php

namespace App\Helper;

use App\Models\Achievement;
use App\Models\AchievementCounter;

class Helper
{

    public static function getUnlockedAchievements($userId)
    {
        $unlockedAchievements = Achievement::with('nonBadgeAchievements')
        ->has('nonBadgeAchievements')->where('user_id', $userId)->get();

        $returnArray = [];
        foreach($unlockedAchievements as $achievementVal) {
            $achievementArray = [];
            $achievementArray['achievement_name'] = $achievementVal->nonBadgeAchievements->name;
            $achievementArray['counts_to_complete'] = $achievementVal->nonBadgeAchievements->count;
            $returnArray[] = $achievementArray;
        }
        return $returnArray;
    }

    public static function getUpcomingAchievements($userId)
    {
        $upcomingAchievements = [];

        $upcomingAchievements = AchievementCounter::doesntHave('achievements', 'and',
        function ($query) use ($userId){
            $query->where('user_id',$userId);
        })->where([['achievement_slug','!=','badge']])->get();

        $returnArray = [];
        foreach($upcomingAchievements as $achievementVal) {
            $achievementArray = [];
            $achievementArray['achievement_name'] = $achievementVal->name;
            $achievementArray['counts_to_complete'] = $achievementVal->count;
            $returnArray[] = $achievementArray;
        }

        return $returnArray;
    }

    public static function currentBadge($userId)
    {
        $currentBadge = self::getCurrentBadge($userId);

        if($currentBadge) {
            $currentBadge = $currentBadge->badgeAchievements->name;
        } else {
            $currentBadge = AchievementCounter::where(['count' => 0,
            'achievement_slug' => 'badge'])->first();
            $currentBadge = $currentBadge->name;
        }

        return $currentBadge;
    }

    public static function nextBadge($userId)
    {
        $currentBadge = self::getCurrentBadge($userId);

        $currentBadgeCount = 0;
        $nextBadge['next_badge'] = 'You have achieved all badges';
        $nextBadge['remaning_to_unlock_next_badge'] = 0;

        if($currentBadge) {
            $currentBadgeCount = $currentBadge->badgeAchievements->count;
        }

        $nextBadge = self::getNextBadge($currentBadgeCount);

        if($nextBadge) {
            $nextBadge['next_badge'] = $nextBadge->name;
            $currentAchievementCount = Achievement::with('nonBadgeAchievements')
            ->has('nonBadgeAchievements')->where('user_id', $userId)->count();
            $nextBadge['remaning_to_unlock_next_badge'] = $nextBadge->count - $currentAchievementCount;
        }

        return $nextBadge;
    }

    public static function countLeftForNextBadge()
    {
        $thiscountLeftForNextBadge = [];
        return $thiscountLeftForNextBadge;
    }

    public static function combinedAchievements($userId)
    {
        $returnArray = [];
        $returnArray['unlocked_achievements'] = self::getUnlockedAchievements($userId);
        $returnArray['next_available_achievements'] = self::getUpcomingAchievements($userId);
        $returnArray['current_badge'] = self::currentBadge($userId);
        $nextBadgeData = self::nextBadge($userId);
        $returnArray['next_badge'] = $nextBadgeData['next_badge'];
        $returnArray['remaning_to_unlock_next_badge'] = 
        $nextBadgeData['remaning_to_unlock_next_badge'];

        return $returnArray;
    }

    public static function getCurrentBadge($userId)
    {
        $achievements = Achievement::with('badgeAchievements')->has('badgeAchievements')
        ->where('user_id', $userId)->orderBy('id','desc')->first();
        if($achievements) {
            return $achievements;
        } else {
            return [];
        }
    }

    public static function getNextBadge($currentBadgeCount)
    {
        return AchievementCounter::where([['count', '>', $currentBadgeCount], [
            'achievement_slug', '=', 'badge']])->orderBy('count','asc')->first();
    }
}