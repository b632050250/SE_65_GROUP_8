<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Desktop31Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //ดรอปตำบล

    //บันทึกข้อมูล
    public function store(Request $request){
        $user = Auth::User();
        $userid = $user->id;
        $placname = $request->placeName;
        $data = array();
        $data["placeName"] = $request->placeName;
        $data["region"] = $request->region;
        $data["subdistrictID"] = $request->subdistrictID;
        DB::table('place')->insert($data);
        $place = DB::select('select* from place as p where p.placeName=?',[$placname]);
        $groupofdogName = $request->Name;
        $description = $request->details;
        $placeID = $place[0]->placeID;
        DB::insert('insert into groupofdog (groupofdogName,placeID,description,userId) values (?,?,?,?)',[$groupofdogName, $placeID,$description, $userid]);
        $list = DB::table('subdistrict')->get();
        $group = DB::select('select* from groupofdog as p where p.groupofdogName=?',[$groupofdogName]);
        $placeID = $group[0]->groupofdogID;
        return view('Desktop9',['subID'=>$place[0]->subdistrictID,'DID'=>$group[0]->groupofdogID]) ;
        //['myposts'=>$mypost,'data'=>$data]
        //return view('Desktop9',['subID'=>$place[0]->subdistrictID],['groupID'=>$group[0]->groupofdogID]) ;
    }

    public function view()
    {
        $province = DB::table('province')
            ->get();

        return view('Desktop31', compact('province'));
    }


     /* return states list.
     *
     * @return json
     */
    public function getDistricts(Request $request)
    {
        $data['districts'] = DB::table('district')
            ->where('provinceID', $request->provinceID)
            ->get(["districtName", "districtID"]);

        return response()->json($data);
    }

    /**
     * return cities list
     *
     * @return json
     */
    public function getSubdistricts(Request $request)
    {
        $data['subdistricts'] = DB::table('subdistrict')
            ->where('districtID', $request->districtID)
            ->get(["subdistrictName", "subdistrictID"]);

        return response()->json($data);
    }
}
