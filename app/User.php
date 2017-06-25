<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class User extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'created_at', 'onboarding_perentage', 'count_applications', 'count_applications'];

    // This function calculate acitve user percentage in a week for each onboarding level
    public static function calculateActiveUserPercentageWeekly() {
		$weeklyBoardings = array();
		$weeklyBoardingsPercentage = array();
    	$users = User::orderBy('created_at')->get();
    	foreach($users as $user) {
    		$date = Carbon::parse($user->created_at);
    		$firstDateOfWeek = $date->startOfWeek()->format('Y-m-d');
    		$userProgress = $user->onboarding_perentage;
    		if(!isset($weeklyBoardings[$firstDateOfWeek])) {
    			$weeklyBoardings[$firstDateOfWeek] = array();
    		}
    		if(!isset($weeklyBoardings[$firstDateOfWeek][$userProgress])) {
    			$weeklyBoardings[$firstDateOfWeek][$userProgress] = 0;
    		}
    		$weeklyBoardings[$firstDateOfWeek][$userProgress] ++;
    	}

    	foreach($weeklyBoardings as $key=>$weeklyBoarding) {
    		ksort($weeklyBoarding);
    		array_push($weeklyBoardingsPercentage, array (
    			'name'=> $key,
    			'data'=> User::calculatePercentage($weeklyBoarding)
    		));
    	}
    	return $weeklyBoardingsPercentage;
    }

	private static function calculatePercentage($onboardPercentageList, $round=1){
		$data = array();
	    $sum = array_sum($onboardPercentageList);
	    $totalNoOfUsers = 0;
	    $acitiveUsersPercentage = 100;

    	array_push(
    		$data,
    		array(0, 100)
    	);
	    foreach ($onboardPercentageList as $currentOnboardPercentage => $noOfUsers) {
	    	array_push(
	    		$data,
	    		array($currentOnboardPercentage, round(($sum - $totalNoOfUsers)/$sum*100,2))
	    	);

	    	$totalNoOfUsers += $noOfUsers;
	    }
	    return $data;
	}

}
