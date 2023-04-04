<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Support\Facades\DB;

class EditGroupController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($GroupID)
    {
        // dd($GroupID);
        // Retrieve the dog group data from the database
        $dogGroup = Group::with('dogpicture')
    ->join('dog', 'group.dogID', '=', 'dog.dogID')
    ->join('dogpicture', 'dog.dogpictureID', '=', 'dogpicture.dogpictureID')
    ->where('group.groupID', '=', $GroupID)
    ->get();
        // dd($dogGroup);

        $groups = DB::table('group')
        ->join('dog', 'group.dogID', '=', 'dog.dogID')
        ->join('subdistrict', 'subdistrict.subdistrictID', '=', 'dog.subdistrictID')
        ->join('district', 'district.districtID', '=', 'subdistrict.districtID')
        ->join('province', 'province.provinceID', '=', 'district.provinceID')
        ->join('groupofdog', 'groupofdog.groupofdogID', '=', 'group.groupOfDogID')
        ->where('group.groupOfDogID', '=', $GroupID)
        ->get();

        // dd($groups);


        $dogInfo = DB::table('group')
            ->join('dog', 'group.dogID', '=', 'dog.dogID')
            ->join('subdistrict', 'dog.subdistrictID', '=', 'subdistrict.subdistrictID')
            ->join('district', 'subdistrict.districtID', '=', 'district.districtID')
            ->join('province', 'district.provinceID', '=', 'province.provinceID')
            ->where('group.groupOfDogID', '=', $GroupID)
            ->get();
        // dd($dogInfo);
        // $subdistrictName = $dogInfo->subdistrictName;
        // $districtName = $dogInfo->districtName;
        // $provinceName = $dogInfo->provinceName;
        // dd($dogGroup->dogpicture->dogpicturePath );

        // Return a view that displays the dog group data
        return view('doggroup.editgroupdog', compact('dogGroup', 'groups','dogInfo'));
    }
}
