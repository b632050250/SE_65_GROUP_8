<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProvinceCreateRequest;
use Illuminate\Support\Facades\DB;

class DropdownController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $province = DB::table('province')
            ->get();
        // dd($provinces);

        return view('dropdown')->with('province',$province);
    }

    public function view1()
    {
        $province = DB::table('province')
            ->get();

            //dd($province);

        return view('searchPlace', compact('province'));
    }
    public function searchDog(ProvinceCreateRequest $request)
    {
        $da = DB::table('place')
        ->select('group.groupID','groupofdog.groupofdogID','groupofdog.groupofdogName','dog.dogName','dogpicture.dogpicturePath'
        ,'subdistrict.subdistrictID','subdistrict.subdistrictName')
        ->leftJoin('subdistrict','subdistrict.subdistrictID','=','place.subdistrictID')
        ->leftJoin('groupofdog','groupofdog.groupofdogID','=','place.placeID')
        ->leftJoin('group','group.groupofdogID','=','groupofdog.groupofdogID')
        ->leftJoin('dog','dog.dogID','=','group.dogID')
        ->leftJoin('dogpicture','dogpicture.dogpictureID','=','dog.dogpictureID')
        ->where(('subdistrict.subdistrictID'),('='),($request->subdistrict))
        ->get();
        $data = DB::table('groupofdog')
        ->select('group.groupID','groupofdog.groupofdogID','groupofdog.groupofdogName','dog.dogName','dogpicture.dogpicturePath'
        ,'subdistrict.subdistrictID','subdistrict.subdistrictName','place.placeName')
        ->leftJoin('place','place.placeID','=','groupofdog.placeID')
        ->leftJoin('group','group.groupofdogID','=','groupofdog.groupofdogID')
        ->leftJoin('dog','dog.dogID','=','group.dogID')
        ->leftJoin('dogpicture','dogpicture.dogpictureID','=','dog.dogpictureID')
        ->leftJoin('subdistrict','subdistrict.subdistrictID','=','place.subdistrictID')
        ->where(('subdistrict.subdistrictID'),('='),($request->subdistrict))
        ->get();
        $new = DB::table('subdistrict')
        ->select('subdistrict.subdistrictName')
        ->where(('subdistrict.subdistrictID'),('='),($request->subdistrict))
        ->get();
        foreach($new as $row){
             $new=$row->subdistrictName;
        }


        //print($request->subdistrict);
         //print($new);
        //dd($data);
        //dd($da);
       return view('displaygroupdog', compact('data','new'));
       //return response()->json($data);
    }
    /**
     * return states list.
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
