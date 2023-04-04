<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Desktop9Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function Desktop9(){
        return view('Desktop9');
    }

    public function insert(Request $request){
        $dogpicturePath = $request->file('pic');
        // $dogPath->move('images/dog', $filename);
        // dd($dogpicturePath);
        $extension = $dogpicturePath->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $filename = $filename;

        // dd($filename);

        $dogpicturePath->move('images/dog', $filename);

        DB::insert('insert into dogpicture (dogpicturePath) values (?)',[$filename]);
        $picID = DB::select('select* from dogpicture as p where p.dogpicturePath=?',[$filename]);
        $dogName = $request->name;
        $subdistrictID = $request->ID;
        $description = $request->nature;
        $dogpictureID = $picID[0]->dogpictureID;
        $dogcolor = $request->color;
        DB::insert('insert into dog (dogName, subdistrictID , description , dogpictureID,dogcolor) values (?,?,?,?,?)',[$dogName, $subdistrictID,$description,$dogpictureID,$dogcolor]);
        $groupdogID = $request->groupID;
        $dog = DB::select('select* from dog as p where p.dogName=?',[$dogName]);
        $dogID = $dog[0]->dogID;
        DB::insert('insert into `group` (groupOfDogID, dogID) values (?,?)',[$groupdogID, $dogID]);
        return view('Desktop9',['subID'=>$subdistrictID,'DID'=>$groupdogID]) ;
    }
}
