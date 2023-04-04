<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Approve ;
use DB;
use Carbon\Carbon;

class ApproveController extends Controller
{
    public function index(){
       
        return view('approve.index') ;
    }
    public function post(){
        $userID = Auth::id();
        $data = DB::select('SELECT* FROM postcost as pc NATURAL JOIN post as p NATURAL JOIN postofgroup as pog JOIN groupofdog as god on pog.groupofdogID=god.groupofdogID NATURAL JOIN place NATURAL JOIN subdistrict JOIN  checkapprove as ca on ca.postcostID=pc.postcostID NATURAL JOIN  checkapprovestatus NATURAL JOIN typetag join users WHERE ca.userID=? and ca.checkapproveStatusID=1 and p.userID=users.id',[$userID]);
        $formattedDate = array();
        foreach($data as $da){
            $datetime = $da->checkapproveTime ;
            $carbonDate = Carbon::parse($datetime);
            $date = $carbonDate->format('Y-m-d');
            array_push($formattedDate,$date);
        }
        return view('approve.post',['approves'=>$data,'formattedDate'=>$formattedDate]) ;
    }
    public function mypost(){
        $userID = Auth::id();
        #$data = DB::table('postcost AS pc')->select('ca.postcostID', 'pl.placeName', DB::raw('IF(checkapproveStatusID = 1, count(ca.checkapproveStatusID), 0) AS ONE'),DB::raw('IF(checkapproveStatusID = 2, count(ca.checkapproveStatusID), 0) AS two'),DB::raw('IF(checkapproveStatusID = 3, count(ca.checkapproveStatusID), 0) AS three'),'p.postTime')->join('post AS p', 'p.postID', '=', 'pc.postID')->join('postofgroup AS pog', 'pog.postofgroupID', '=', 'p.postofgroupID')->join('groupofdog AS god', 'god.groupofdogID', '=', 'pog.groupofdogID')->join('place AS pl', 'pl.placeID', '=', 'god.placeID')->join('checkapprove AS ca', 'ca.postcostID', '=', 'pc.postcostID')->where('p.userID', '=', 1)->groupBy('ca.postcostID', 'pl.placeName','ca.checkapproveStatusID','p.postTime')->get();
       # $da = DB::select('SELECT ca.postcostID,pl.placeName,IF(checkapproveStatusID = 1, count(ca.checkapproveStatusID), 0) as one,IF(checkapproveStatusID = 2, count(ca.checkapproveStatusID), 0) as two,IF(checkapproveStatusID = 3, count(ca.checkapproveStatusID), 0) as three FROM postcost as pc NATURAL JOIN post as p  NATURAL JOIN postofgroup as pog NATURAL JOIN groupofdog as god NATURAL JOIN place as pl NATURAL JOIN checkapprove as ca WHERE ca.userID=? group by ca.checkapproveStatusID,pc.postcostID,pl.placeName,ca.postcostID',[1]);
        $data = DB::select('SELECT postcostID,count(ca.checkapproveStatusID) as c ,ca.checkapproveStatusID FROM postcost as pc NATURAL JOIN checkapprove as ca JOIN post as p on pc.postID=p.postID  where p.userID=? group BY pc.postcostID,ca.checkapproveStatusID',[$userID]);
        $mypost = DB::select('SELECT * FROM postcost as pc NATURAL JOIN post as p  NATURAL JOIN place NATURAL JOIN users NATURAL JOIN typetag NATURAL JOIN subdistrict  NATURAL JOIN postofgroup as pog JOIN groupofdog as grd on grd.groupofdogID= pog.postofgroupID WHERE  p.userID =? and users.id=p.userID and place.placeID=grd.placeID;',[$userID]);
        $check = array();
        $l=0;
        foreach($mypost as $my){
            foreach($data as $da){
                if($my->postcostID==$da->postcostID){
                    if($da->checkapproveStatusID==2&&$da->c>=3){
                        $l=2 ;
                        #DB::update('UPDATE users SET post= ? where id = ?',[$name, $surname,$filename, $userId]);
                        break ;
                    }else if ($da->checkapproveStatusID==3&&$da->c>=2){
                        $l=3 ;
                        break ;
                    }else{
                        $l=1 ;
                    }
                }
            }
            array_push($check, array($my,$l));
        }
        $formattedDate = array();
        foreach($mypost as $da){
            $datetime = $da->postTime ;
            $carbonDate = Carbon::parse($datetime);
            $date = $carbonDate->format('Y-m-d');
            array_push($formattedDate,$date);
        }
        return view('approve.mypost',['myposts'=>$check,'data'=>$data,'formattedDate'=>$formattedDate]) ;
    }

    public function approve(Request $request){
        $check = $request->action;
        $id = $request->id;
        $userID = Auth::id();
        $date = Carbon::now();
        $datelocal = $date->setTimezone('Asia/Bangkok');
        if ($check === 'yes') {
            DB::update('UPDATE checkapprove SET checkapproveStatusID=2,checkapproveTime=? where checkapproveID=?',[$datelocal,$id]);
        } elseif ($check === 'no') {
            DB::update('UPDATE checkapprove SET checkapproveStatusID=3,checkapproveTime=? where checkapproveID=?',[$datelocal,$id]);
        }
        $data = DB::select('SELECT postcostID,count(ca.checkapproveStatusID) as c ,ca.checkapproveStatusID FROM postcost as pc NATURAL JOIN checkapprove as ca JOIN post as p on pc.postID=p.postID  where p.userID=? group BY pc.postcostID,ca.checkapproveStatusID',[$userID]);
        $mypost = DB::select('SELECT * FROM postcost as pc NATURAL JOIN post as p NATURAL JOIN postofgroup  as pog NATURAL JOIN groupofdog NATURAL JOIN place NATURAL JOIN users NATURAL JOIN typetag NATURAL JOIN subdistrict WHERE  p.userID =? and users.id=p.userID',[$userID]);

        return redirect('approve/post') ;
    }
    public function approvedonateimage(Request $request) {
        $id = $request->id ;
        $data = DB::select('SELECT DISTINCT* FROM  donation as d  where d.donationID =?',[$id]);
        return view('approve.donateimage',['donate'=>$data]) ;
    }


    public function donate() {
        $userID = Auth::id();
        $data = DB::select('SELECT DISTINCT* FROM  opendonate as op NATURAL JOIN postcost as pc NATURAL JOIN post as p NATURAL JOIN typetag NATURAL JOIN postofgroup as pog JOIN groupofdog as grd on grd.groupofdogID= pog.postofgroupID  NATURAL JOIN place  NATURAL JOIN subdistrict JOIN users JOIN donation as d where p.userID =? and checkapprovestatusID=1  and users.id=d.userID',[$userID]);
        $formattedDate = array();
        foreach($data as $da){
            $datetime = $da->donationTime ;
            $carbonDate = Carbon::parse($datetime);
            $date = $carbonDate->format('Y-m-d');
            array_push($formattedDate,$date);
        }
        return view('approve.donate',['donates'=>$data,'formattedDate'=>$formattedDate]) ;
    }

    public function approvedonate(Request $request) {
        $check = $request->action;
        $id = $request->id;
        $date = Carbon::now();
        $datelocal = $date->setTimezone('Asia/Bangkok');
        if ($check === 'yes') {
            DB::update('UPDATE donation SET checkapprovestatusID=2,donationTime=? where donationID=?',[$datelocal,$id]);
        } elseif ($check === 'no') {
            DB::update('UPDATE donation SET checkapprovestatusID=3,donationTime=? where donationID=?',[$datelocal,$id]);
        }
        return redirect('approve/donate') ;
    }

    public function posthistory() {
        $data = DB::select('SELECT* FROM postcost as pc NATURAL JOIN post as p NATURAL JOIN postofgroup as pog JOIN groupofdog as god on pog.groupofdogID=god.groupofdogID NATURAL JOIN place NATURAL JOIN subdistrict JOIN  checkapprove as ca on ca.postcostID=pc.postcostID NATURAL JOIN  checkapprovestatus NATURAL JOIN typetag join users WHERE ca.userID=? and ca.checkapproveStatusID!=1 and p.userID=users.id',[1]);
        $formattedDate = array();
        foreach($data as $da){
            $datetime = $da->checkapproveTime ;
            $carbonDate = Carbon::parse($datetime);
            $date = $carbonDate->format('Y-m-d');
            array_push($formattedDate,$date);
        }
        return view('approve/posthistory',[
            'posthistory' => $data,'formattedDate'=>$formattedDate
        ]);
    }

    public function donatehistory() {
        $data = DB::select('SELECT DISTINCT* FROM  opendonate as op NATURAL JOIN postcost as pc NATURAL JOIN post as p NATURAL JOIN typetag NATURAL JOIN postofgroup as pog JOIN groupofdog as grd on grd.groupofdogID= pog.postofgroupID  NATURAL JOIN place  NATURAL JOIN subdistrict JOIN users JOIN donation as d where p.userID =? and checkapprovestatusID!=1  and users.id=d.userID;',[1]);
        $formattedDate = array();
        foreach($data as $da){
            $datetime = $da->donationTime ;
            $carbonDate = Carbon::parse($datetime);
            $date = $carbonDate->format('Y-m-d');
            array_push($formattedDate,$date);
        }

        return view('approve/donatehistory',[
            'donatehistory' => $data,'formattedDate'=>$formattedDate
        ]);
    }

    public function mypostdetails(Request $request) {
        $data = DB::select('SELECT * FROM checkapprove as ca JOIN users NATURAL JOIN checkapproveStatus where ca.postcostID=? and users.id=ca.userID',[$request->se]);
        return view('approve/mypostdetails',[
            'mypostdetails' => $data,
        ]);
    }


}
