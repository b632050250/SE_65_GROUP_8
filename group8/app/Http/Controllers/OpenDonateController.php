<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\GroupOfDog;
use App\Models\Post;
use App\Models\PostCost;
use App\Models\OpenDonate;
use App\Models\PostOfGroup;
use App\Models\DogImg;
use App\Models\Group;
use App\Models\TreatedDog;
use App\Models\CheckApprove;

class OpenDonateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function selectGroup()
    {
        $data = GroupOfDog::getAll();
       // dd($data);
        return view('donate.selectGroup',['data'=>$data]);
    }
    public function index($id)
    {
        // dd($id);
        return view('donate.selectDonate',['id'=>$id]);
    }
    public function food($id)
    {
        return view('donate.foodDonate',['id'=>$id]);
    }
    public function treat($id)
    {
        return view('donate.treatDonate',['id'=>$id]);
    }
    public function treatGroup($id)
    {
        return view('donate.treatGroup',['id'=>$id]);
    }
    public function treatSingle($id)
    {
        $name = DB::table('group')
                ->join('groupofdog', 'group.groupID', '=', 'groupofdog.groupofdogID')
                ->join('dog', 'group.dogID', '=', 'dog.dogID')
                ->join('dogpicture', 'dog.dogpictureID', '=', 'dogpicture.dogpictureID')
                ->get();

        return view('donate.treatSingle',['id'=>$id,'name'=>$name]);
    }
    public function treatSingleSelected($id,$dogID)
    {
        return view('donate.treatSingleSelected',['id'=>$id,'dogID'=>$dogID]);
    }
    public function requestDonate()
    {
        return view('donate.requestDonate');
    }
    public function donorSelect($id)
    {
        $user = Auth::User();
        $data = DB::table('users')
        ->where('subdistrictID', $user->subdistrictID)
            ->get();

        return view('donate.donorSelect',['postcostID'=>$id,'data'=>$data]);
    }

    public function donorSelectSave(Request $request){
        $postcostId = $request->id;
        $data = array($request->user1,$request->user2,$request->user3,$request->user4,$request->user5);
        foreach($data as $d){
            $check = new CheckApprove;
            $check->postcostID= $postcostId;
            $check->userID= $d;
            $check->checkapproveStatusID = 1;
            $check->save();
        }
        return redirect('/selectGroup');
    }
    public function random($id)
    {
        $user = Auth::User();
        $data = DB::table('users')
        ->where('subdistrictID', $user->subdistrictID)
            ->inRandomOrder()
            ->limit(5)
            ->get();
        foreach($data as $d){
            $check = new CheckApprove;
            $check->postcostID= $id;
            $check->userID= $d->id;
            $check->checkapproveStatusID = 1;
            $check->save();
        }

        return redirect('/selectGroup');
    }

    public function createFoodDonate(Request $request)
    {
        $user = Auth::User();

        $postofgroup = new PostOfGroup;
        $postofgroup->groupofdogID =$request->groupId;
        $postofgroup->save();

        $datap = DB::table('postofgroup')->orderBy('postofgroupID','desc')->first();

        $post = new Post;
        $post->typetagID = 2;
        $post->userID = $user->id;
        $post->postofgroupID = $datap->postofgroupID;
        $post->poststatusID=2;
        $post->save();

        $data = DB::table('post')->orderBy('postID','desc')->first();

        $postcost = new PostCost;
        $postcost->postID = $data->postID;
        $postcost->postcostAmount=$request->amount;
        $postcost->save();

        $dataD = DB::table('postcost')->orderBy('postcostID','desc')->first();
        $opendonate = new OpenDonate;
        $opendonate->postcostID =$dataD->postcostID;
        $opendonate->opendonateContent =$request->content;
        $opendonate->opendonateQRcode = null;
        if($request->hasFile('qrcode')){
            $image = $request->file('qrcode');
            $image_name = $request->originalName.'.'.$image->getClientOriginalExtension();
            $path = $image->move(public_path('images/qrcode'), $image->getClientOriginalName());
            $opendonate->opendonateQRcode = $image->getClientOriginalName();

        }
        $opendonate->opendonateSlip = null;
        if($request->hasFile('reciept')){
            $image = $request->file('reciept');
            $image_name = $request->originalName.'.'.$image->getClientOriginalExtension();
            $path = $image->move(public_path('images/slip'), $image->getClientOriginalName());
            $opendonate->opendonateSlip = $image->getClientOriginalName();

        }
        $opendonate->save();

        $fileModel = new DogImg;
        $fileModel->dogimgPath = null;
        if($request->hasFile('dogImg')){
            $image = $request->file('dogImg');
            $image_name = $request->originalName.'.'.$image->getClientOriginalExtension();
            $path = $image->move(public_path('images/dog'), $image->getClientOriginalName());
            $fileModel->dogimgPath = $image->getClientOriginalName();

        }
        $fileModel->postcostID = $dataD->postcostID;
        $fileModel->save();
        return view('donate.requestDonate',['postcostID'=>$dataD->postcostID]);
    }
    public function createTreatGroupDonate(Request $request)
    {
        $user = Auth::User();

        $postofgroup = new PostOfGroup;
        $postofgroup->groupofdogID =$request->groupId;
        $postofgroup->save();

        $datap = DB::table('postofgroup')->orderBy('postofgroupID','desc')->first();

        $post = new Post;
        $post->typetagID = 1;
        $post->userID = $user->id;
        $post->postofgroupID = $datap->postofgroupID;
        $post->poststatusID=2;
        $post->save();

        $data = DB::table('post')->orderBy('postID','desc')->first();

        $postcost = new PostCost;
        $postcost->postID = $data->postID;
        $postcost->postcostAmount=$request->amount;
        $postcost->save();

        $dataD = DB::table('postcost')->orderBy('postcostID','desc')->first();
        $opendonate = new OpenDonate;
        $opendonate->postcostID =$dataD->postcostID;
        $opendonate->opendonateContent =$request->content;
        $opendonate->opendonateQRcode = null;
        if($request->hasFile('qrcode')){
            $image = $request->file('qrcode');
            $image_name = $request->originalName.'.'.$image->getClientOriginalExtension();
            $path = $image->move(public_path('images/qrcode'), $image->getClientOriginalName());
            $opendonate->opendonateQRcode = $image->getClientOriginalName();

        }
        $opendonate->opendonateSlip = null;
        if($request->hasFile('reciept')){
            $image = $request->file('reciept');
            $image_name = $request->originalName.'.'.$image->getClientOriginalExtension();
            $path = $image->move(public_path('images/slip'), $image->getClientOriginalName());
            $opendonate->opendonateSlip = $image->getClientOriginalName();

        }
        $opendonate->save();

        $fileModel = new DogImg;
        $fileModel->dogimgPath = null;
        if($request->hasFile('dogImg')){
            $image = $request->file('dogImg');
            $image_name = $request->originalName.'.'.$image->getClientOriginalExtension();
            $path = $image->move(public_path('images/dog'), $image->getClientOriginalName());
            $fileModel->dogimgPath = $image->getClientOriginalName();

        }
        $fileModel->postcostID = $dataD->postcostID;
        $fileModel->save();
        return view('donate.requestDonate',['postcostID'=>$dataD->postcostID]);
    }
    public function createTreatSingleDonate(Request $request)
    {
        $user = Auth::User();

        $postofgroup = new PostOfGroup;
        $postofgroup->groupofdogID =$request->groupId;
        $postofgroup->save();

        $datap = DB::table('postofgroup')->orderBy('postofgroupID','desc')->first();

        $post = new Post;
        $post->typetagID = 1;
        $post->userID = $user->id;
        $post->postofgroupID = $datap->postofgroupID;
        $post->poststatusID=2;
        $post->save();

        $data = DB::table('post')->orderBy('postID','desc')->first();

        $postcost = new PostCost;
        $postcost->postID = $data->postID;
        $postcost->postcostAmount=$request->amount;
        $postcost->save();

        $dataD = DB::table('postcost')->orderBy('postcostID','desc')->first();
        $opendonate = new OpenDonate;
        $opendonate->postcostID =$dataD->postcostID;
        $opendonate->opendonateContent =$request->content;
        $opendonate->opendonateQRcode = null;
        if($request->hasFile('qrcode')){
            $image = $request->file('qrcode');
            $image_name = $request->originalName.'.'.$image->getClientOriginalExtension();
            $path = $image->move(public_path('images/qrcode'), $image->getClientOriginalName());
            $opendonate->opendonateQRcode = $image->getClientOriginalName();

        }
        $opendonate->opendonateSlip = null;
        if($request->hasFile('reciept')){
            $image = $request->file('reciept');
            $image_name = $request->originalName.'.'.$image->getClientOriginalExtension();
            $path = $image->move(public_path('images/slip'), $image->getClientOriginalName());
            $opendonate->opendonateSlip = $image->getClientOriginalName();

        }
        $opendonate->save();

        $fileModel = new DogImg;
        $fileModel->dogimgPath = null;
        if($request->hasFile('dogImg')){
            $image = $request->file('dogImg');
            $image_name = $request->originalName.'.'.$image->getClientOriginalExtension();
            $path = $image->move(public_path('images/dog'), $image->getClientOriginalName());
            $fileModel->dogimgPath = $image->getClientOriginalName();

        }
        $fileModel->postcostID = $dataD->postcostID;
        $fileModel->save();

        $treatedog = new TreatedDog;
        $treatedog->postcostID = $dataD->postcostID;
        $treatedog->dogID = (int)$request->dogID;
        $treatedog->treateddogstatusID = 3;
        $treatedog->save();
        return view('donate.requestDonate',['postcostID'=>$dataD->postcostID]);
    }
}
