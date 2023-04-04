<?php

namespace App\Http\Controllers;

use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Models\Donation ;
use Illuminate\Http\UploadedFile ;
use DB;

class DonateController extends Controller
{
    public function index($id){
        $data = DB::select('SELECT * FROM postcost as pc NATURAL JOIN post NATURAL JOIN postofgroup as pog JOIN groupofdog as god on god.groupofdogID=pog.groupofdogID NATURAL JOIN opendonate as od NATURAL JOIN place NATURAL JOIN dogimg NATURAL JOIN typetag NATURAL JOIN groupofpostpicture where pc.postcostID=?',[$id]);
        $donate = DB::select('SELECT postcostAmount,sum(d.donationAmount) as total_donation_amount FROM donation as d NATURAL JOIN opendonate as od NATURAL JOIN postcost as pc where pc.postcostID = ? and d.checkapprovestatusID = 2  GROUP BY d.opendonateID,pc.postcostAmount;',[$id]);
        $alldonate = DB::select('SELECT postcostAmount,sum(d.donationAmount) as total_donation_amount FROM donation as d NATURAL JOIN opendonate as od NATURAL JOIN postcost as pc where pc.postcostID = ?  and d.checkapprovestatusID = 1  GROUP BY d.opendonateID,pc.postcostAmount;',[$id]);
        $am = $data[0]->postcostAmount ;
        $allamount = $alldonate[0]->total_donation_amount ;
        if($donate==null||$alldonate==null){
            $amount = 0;
            $per=0 ;
            $allper=0 ;
        }else  {
        $per = (($am-($am-$donate[0]->total_donation_amount))/$am)*100 ;
        $allper = (($am-($am-$alldonate[0]->total_donation_amount))/$am)*100 ;
        $amount = $donate[0]->total_donation_amount ;
    }

        return view('donate.index', [
            'postgroup' => $data,
            'amount' => $amount,
            'per' => $per,
            'am'=>$am,
            'allper'=>$allper,
            'allamount'=>$allamount,
            'id'=> $id
        ]);
    }
    public function cost(Request $request){
        $amount = $request->amount ;
        $id = $request->id  ;
        $userID = Auth::id();
        $opendonateID   = $request->opendonateID ;
        $file = $request->file('file') ;
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('images/donate', $filename);
        DB::insert('insert into donation (donationSlip, userID,donationAmount,opendonateID,checkapprovestatusID ) values (?,?,?,?,?)',[$filename, $userID,$amount,$opendonateID,1]);
        return  redirect('/Group/'.$id) ;
        #->with('sussfly')
    }
}
