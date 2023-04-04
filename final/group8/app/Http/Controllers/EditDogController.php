<?php
namespace App\Http\Controllers;

use App\Models\Dog;
use App\Models\Group;
use App\Models\Province;
use App\Models\GroupOfDog;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditDogController extends Controller
{
    public function update(Request $request, $dogID)
    {
        // Retrieve the dog data from the database
        $dog = Dog::findOrFail($dogID);
        $groups = Group::findOrFail($dogID);

        // Update the dog's name with the new value from the form submission
        $dog->dogName = $request->input('dogName');
        // $dog->dogArea = $request->input('dogArea');
        $dog->subdistrictID = $request->input('subdistrictID');
        $dog->description = $request->input('description');
        $groups->groupOfDogID = $request->input('groupOfDog');
        // $dog->groupOfDog = $request->input('groupOfDog');

        // dd($int);





        $groupID = DB::table('group')->where('dogID', $dogID)->value('groupOfDogID');


        // dd($group->groupOfDogID);

        // $subdistrictID = $request->input('subdistrictID');
        // $subdistrict = Subdistrict::findOrFail($subdistrictID);
        // $dog->subdistrict()->associate($subdistrict);

        // dd($subdistrict);


        // $districtID = $request->input('districtID');
        // $district = district::findOrFail($districtID);
        // $dog->subdistrict()->associate($district);

        // $ProvinceID = $request->input('ProvinceID');
        // $Province = Province::findOrFail($ProvinceID);
        // $dog->subdistrict()->associate($Province);
        if ($request->hasFile('dogPicture')) {

            if ($request->file('dogPicture')->isValid()) {
                // File upload is successful
                $file = $request->file('dogPicture');
                // dd($file);
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $filename = $filename;
                // dd($filename);
                $file->move('images/dog', $filename);
                $dogpicture = $dog->dogpicture;
                $dogpicture->dogpicturePath = $filename;
                // dd($dogpicture);
                $dogpicture->save();
                // dd($filename);
            } else {
                // File upload is not successful
                dd($request->file('dogPicture')->getErrorMessage());
            }
        }

        // Save the updated dog data to the database
        $dog->save();
        $groups->save();
        // dd($groupID);

        // Redirect back to the edit group dog page
        return redirect()->route('editgroupdog', ['groupID' => $groupID]);
    }

    public function edit($dogID)
    {
        // Retrieve the dog from the database based on the dogID in the URL
        $dog = Dog::find($dogID);
        $dogGroup = $groups = Group::join('dog', 'group.dogID', '=', 'dog.dogID')
            ->where('dog.dogID', '=', $dogID)
            ->with('dogpicture')
            ->first();
        // dd($dogGroup->groupOfDogID);
        $province = Province::all();
        $test = DB::table('dog')
            ->join('subdistrict', 'dog.subdistrictID', '=', 'subdistrict.subdistrictID')
            ->join('district', 'subdistrict.districtID', '=', 'district.districtID')
            ->join('province', 'district.provinceID', '=', 'province.provinceID')
            ->where('dog.dogID', '=', $dogID)
            ->first();
        $subdistrictName = $test->subdistrictName;
        $districtName = $test->districtName;
        $provinceName = $test->provinceName;
        // dd($dogGroup);
        // dd($provinceName);
        $GroupID = $dogGroup->groupOfDogID;

        $groups = DB::table('group')
        ->join('dog', 'group.dogID', '=', 'dog.dogID')
        ->join('subdistrict', 'subdistrict.subdistrictID', '=', 'dog.subdistrictID')
        ->join('district', 'district.districtID', '=', 'subdistrict.districtID')
        ->join('province', 'province.provinceID', '=', 'district.provinceID')
        ->join('groupofdog', 'groupofdog.groupofdogID', '=', 'group.groupOfDogID')
        ->where('dog.dogID', '=', $dogID)
        ->get();

        $groupOfDogs = GroupOfDog::all();
        // dd($groupOfDogs);

        // Return the edit form view with the dog's information
        return view('doggroup.editdog', compact('dog','dogGroup', 'province', 'test', 'subdistrictName', 'districtName', 'provinceName', 'GroupID','groups','groupOfDogs'));
    }

    public function showRegistrationForm()
    {
        $province = DB::table('province')->get();
        return view('doggroup.editdog', ['province' => $province]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function getDistricts(Request $request)
    {
        $districts = DB::table('district')
            ->where('provinceID', $request->provinceID)
            ->get();
        dd("aaaaa");
        if (count($districts) > 0) {
            return response()->json($districts);
        }
    }

    /**
     * return cities list
     *
     * @return json
     */
    public function getSubdistricts(Request $request)
    {
        $subdistricts = DB::table('subdistrict')
            ->where('districtID', $request->districtID)
            ->get();

        if (count($subdistricts) > 0) {
            return response()->json($subdistricts);
        }
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
        ? new JsonResponse([], 201)
        : redirect($this->redirectPath());
    }

}
