<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\GroupOfDog;
use App\Models\Post;
use App\Models\PostCost;
use App\Models\OpenDonate;
use App\Models\PostOfGroup;
use App\Models\DogImg;
use App\Models\Group;
use App\Models\TreatedDog;
use App\Models\CheckApprove;
use App\Models\Report;
use App\Models\SentReport;
use App\Models\Donation;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function sent($id)
    {
        $name = DB::table('donation')
                ->join('opendonate', 'donation.opendonateID', '=', 'opendonate.opendonateID')
                ->join('postcost', 'opendonate.postcostID', '=', 'postcost.postcostID')
                ->join('post', 'postcost.postID', '=', 'post.postID')
                ->join('postofgroup', 'post.postofgroupID', '=', 'postofgroup.postofgroupID')
                ->join('groupofdog', 'postofgroup.groupofdogID', '=', 'groupofdog.groupofdogID')
                ->where('donation.donationID', $id)
                ->first();
        $a=$name->typetagID;
        $tagName = DB::table('typetag')->where('typetag.typetagID', $a)->first();
        $placeName = DB::table('place')->where('place.placeID', $name->placeID)->first();
        $userName = DB::table('users')->where('users.id', $name->userID)->first();
        return view('report.sent',['id'=>$id,'name'=>$name,'tagName'=>$tagName,'placeName'=>$placeName,'userName'=>$userName]);
    }
    public function sented(Request $request)
    {
        $user = Auth::User();
        dd($user->id);
        $report = new Report;
        $report->userID = $request->id;
        $report->reportstatusID=2;
        $report->save();
        $data = DB::table('report')->orderBy('reportID','desc')->first();
        $sentreport = new SentReport;
        $sentreport->reportID = $data->reportID;
        $sentreport->userID = $user->id;
        $sentreport->sentreportContent = $request->content;
        $sentreport->save();
    }
    public function index()
    {
        $r = DB::table('sentreport')
                ->join('report', 'sentreport.reportID', '=', 'report.reportID')
                ->join('users', 'sentreport.userID', '=', 'users.id')
                ->select('sentreport.userID','report.userID as ID','sentreport.sentreportContent','sentreport.reportID')
                ->get();
        $data = array(array());
        for($i = 0;$i<sizeof($r);$i++){
            $d1 = DB::table('users')->where('users.id','=',$r[$i]->userID)->get();
            $d2 = DB::table('users')->where('users.id','=',$r[$i]->ID)->get();
            //dd($d1);
            $data[$i]["nameUserSentReport"] = $d1[0]->name;
            $data[$i]["nameUserReport"] = $d2[0]->name;
        }
        //dd($data);
        return view('report.index',['report'=>$r,'name'=>$data]);
    }
    public function report()
    {
        return view('report.report');
    }
    public function reported(Request $request)
    {
        $r = DB::table('report')
            ->where('report.reportID', $request->id)
            ->first();
        DB::table('report')->where('reportID',$request->id)->update(['reportstatusID'=>1]);
    }
}
