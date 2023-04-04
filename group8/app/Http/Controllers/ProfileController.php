<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use DB;

class ProfileController extends Controller
{
    public function index(){
        $userId = Auth::id();
        $data = DB::select('SELECT * FROM users where users.id=? ',[$userId]);
        return view('profile.index',['user'=>$data]) ;
    }
    public function update(){
        $userId = Auth::id();
        $data = DB::select('SELECT * FROM users where users.id=? ',[$userId]);
        return view('profile.update',['user'=>$data]) ;
    }
    public function save(Request $request){
        $name = $request->name ;
        $surname = $request->surname ;
        $userId = Auth::id();
        $file = $request->file ;
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('images/profile', $filename);
        DB::update('UPDATE users SET name= ?,surname=?,profilepath=? where id = ?',[$name, $surname,$filename, $userId]);
        return redirect('/profile/index') ;
    }
}
