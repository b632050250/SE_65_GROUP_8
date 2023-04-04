<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use DB;

class ViewGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $city = "123 bankok,thailand";
        $dataname = DB::select('SELECT * FROM users');
        $namepost = DB::select('SELECT * FROM post NATURAL JOIN users ');
        $day = DB::select('SELECT * FROM post where postTime');
        $contentpost = DB::select('SELECT * FROM post NATURAL JOIN postofgroup NATURAL JOIN users');
        $jpgdog = DB::select('SELECT * FROM post NATURAL JOIN postofgroup NATURAL JOIN dogpicture JOIN users ON post.userID = users.id') ;
        $addpost = DB::select('SELECT * FROM post');

        $jpggroup = DB::select('SELECT post.postID, post.typetagID, post.userID, post.postTime, post.postofgroupID, users.name, dog.subdistrictID, postofgroup.postofgroupContent, postofgroup.groupofpostpictureID, postofgroup.postofgroupTime, `group`.groupOfDogID, dogpicture.dogpicturePath FROM post INNER JOIN users ON post.userID = users.id INNER JOIN postofgroup ON post.postofgroupID = postofgroup.postofgroupID INNER JOIN groupofdog ON postofgroup.postofgroupID = groupofdog.groupofdogID INNER JOIN `group` ON groupofdog.groupofdogID = `group`.groupID INNER JOIN dog ON `group`.groupOfDogID = dog.dogID INNER JOIN dogpicture ON dog.dogID = dogpicture.dogpictureID ORDER BY post.postID ASC');

        // $userID = Auth::roleID();
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
        $user = Auth::User();
        // dd($user->roleID);
        if($user->roleID==1){
            return view('about',['post'=>$jpggroup]);
        }
        else{
            return view('report.index',['report'=>$r,'name'=>$data]);
        }

        // dd();

    }




}
