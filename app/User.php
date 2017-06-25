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
        //loop through each user in database to get his/her completion percentage and account created week.
    	foreach($users as $user) {
    		$date = Carbon::parse($user->created_at);
            //get the first day of the wee he is cretaed his account
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

        //get active users against completion percentage for every week. 
    	foreach($weeklyBoardings as $key=>$weeklyBoarding) {
    		ksort($weeklyBoarding);
    		array_push($weeklyBoardingsPercentage, array (
    			'name'=> $key,
    			'data'=> User::calculatePercentage($weeklyBoarding)
    		));
    	}
    	return $weeklyBoardingsPercentage;
    }

    //calcualte percentage of active users against onboarding process completion for week
	private static function calculatePercentage($onboardPercentageList, $round=1){
		$data = array();
	    $sum = array_sum($onboardPercentageList);
	    $totalNoOfUsers = 0;
	    $acitiveUsersPercentage = 100;

        // when process start all registerd users are active.
    	array_push(
    		$data,
    		array(0, 100)
    	);
        //get no of users as percentage who passes the given process completion status in current week.
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
