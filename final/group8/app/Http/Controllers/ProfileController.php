<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProfileController extends Controller
{
    public function index(){
        $data = DB::select('SELECT * FROM users ');
        
        return view('profile.index',['user'=>$data]) ;
    }
    public function update(){
        $data = DB::select('SELECT * FROM users ');
        return view('profile.update',['user'=>$data]) ;
    }
    public function save(Request $request){
        $name = $request->name ;
        $surname = $request->surname ;
        $image = $request->file ;
        $data = DB::update('UPDATE users SET name= ?,surname=? where id = ?',[$name, $surname,1]);
        return redirect('/profile/update') ;
    }
}
