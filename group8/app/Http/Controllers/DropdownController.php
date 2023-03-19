<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DropdownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $provinces = DB::table('provinces')
            ->get();
        
        return view('dropdown', compact('provinces'));
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
