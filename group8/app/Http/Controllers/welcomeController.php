<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class welcomeController extends Controller
{
    public function index(){
        $city = "123 bankok,thailand";
        $dataname = DB::select('SELECT * FROM users');
        $namepost = DB::select('SELECT * FROM post NATURAL JOIN users ');
        $day = DB::select('SELECT * FROM post where postTime');
        $contentpost = DB::select('SELECT * FROM post NATURAL JOIN postofgroup NATURAL JOIN users');
        $jpgdog = DB::select('SELECT * FROM post NATURAL JOIN postofgroup NATURAL JOIN dogpicture JOIN users ON post.userID = users.id') ;
        $addpost = DB::select('SELECT * FROM post');

        $jpggroup = DB::select('SELECT post.postID, post.typetagID, post.userID, post.postTime, post.postofgroupID, users.name, dog.subdistrictID, postofgroup.postofgroupContent, postofgroup.groupofpostpictureID, postofgroup.postofgroupTime, `group`.groupOfDogID, dogpicture.dogpicturePath FROM post INNER JOIN users ON post.userID = users.id INNER JOIN postofgroup ON post.postofgroupID = postofgroup.postofgroupID INNER JOIN groupofdog ON postofgroup.postofgroupID = groupofdog.groupofdogID INNER JOIN `group` ON groupofdog.groupofdogID = `group`.groupID INNER JOIN dog ON `group`.groupOfDogID = dog.dogID INNER JOIN dogpicture ON dog.dogID = dogpicture.dogpictureID ORDER BY post.postID ASC');

        // dd($jpggroup);

        return view('welcome',['post'=>$jpggroup]);
    }




}
