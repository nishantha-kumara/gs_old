<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
{
    public function loadChartData(){    	
    	return response()->json(User::calcActiveUserPercentWeekForHighchart());
    }
}
