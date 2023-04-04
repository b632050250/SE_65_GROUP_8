<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index($groupOfDogID){

        // dd($groupOfDogID);
        $gruopshow = DB::select('SELECT * FROM `groupofpostpicture` INNER JOIN postofgroup as pog JOIN groupofdog as grd on grd.groupofdogID= pog.postofgroupID INNER JOIN `group` on pog.groupofdogID=`group`.`groupID` INNER JOIN `groupofdog` on `group`.groupofdogID=`groupofdog`.`groupofdogID` INNER JOIN place on place.placeID = groupofdog.placeID WHERE `group`.groupOfDogID=?', [$groupOfDogID]);

        // dd($gruopshow = $gruopshow[0]);

        $gruopshow = $gruopshow[0];
        return view('group',['namesgroups'=>$gruopshow]);

    }
}
