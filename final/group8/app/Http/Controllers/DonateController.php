<?php

namespace App\Http\Controllers;

use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use app\Models\Donation ;
use Illuminate\Http\UploadedFile ;
use DB;

class DonateController extends Controller
{
    public function index($id){
        $data = DB::select('SELECT * FROM postcost as pc NATURAL JOIN post NATURAL JOIN postofgroup NATURAL JOIN place NATURAL JOIN dogimg NATURAL JOIN typetag where pc.postcostID=?',[$id]);
        $donate = DB::select('SELECT postcostAmount,sum(d.donationAmount) as total_donation_amount FROM donation as d NATURAL JOIN opendonate as od NATURAL JOIN postcost as pc where pc.postcostID = ? and d.checkapprovestatusID = 2  GROUP BY d.opendonateID,pc.postcostAmount;',[$id]);
        $alldonate = DB::select('SELECT postcostAmount,sum(d.donationAmount) as total_donation_amount FROM donation as d NATURAL JOIN opendonate as od NATURAL JOIN postcost as pc where pc.postcostID = ?  and d.checkapprovestatusID = 1  GROUP BY d.opendonateID,pc.postcostAmount;',[$id]);
        $amount = $data[0]->postcostAmount ;
        dd("in");
        if($donate==null||$alldonate==null){
            $per=0 ;
            $am =0 ;
            $allper=0 ;
            $allamount=0 ;
        }else  {
        $am = $donate[0]->postcostAmount ;
        $per = (($am-($am-$donate[0]->total_donation_amount))/$am)*100 ;
        $allper = (($am-($am-$alldonate[0]->total_donation_amount))/$am)*100 ;
        $allamount = $alldonate[0]->total_donation_amount ;
    }

        return view('donate.index', [
            'postgroup' => $data,
            'amount' => $amount,
            'per' => $per,
            'am'=>$am,
            'allper'=>$allper,
            'allamount'=>$allamount,
        ]);
    }
    public function cost(Request $request){
        $amount = $request->amount ;
        $userID   = 1 ;
        $opendonateID   = 2 ;
        $file = $request->file('file') ;
        // dd($file) ;
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        // dd($filename);

        // dd($filename);

        $file->move('images/dog', $filename);
        // change path

    // Generate a unique name for the file
    $filename = uniqid() . '.' . $extension;

    // Move the uploaded file to a desired location
    // $file->move(public_path('uploads'), $filename);
        DB::insert('insert into donation (donationSlip, userID,donationAmount,opendonateID,checkapprovestatusID ) values (?,?,?,?,?)',[$filename, $userID,$amount,$opendonateID,1]);
        return  redirect('donate/index') ;
        #->with('sussfly')
    }
}
