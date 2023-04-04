<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SearchplaceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

        public function index()
        {
            $province = DB::table('province')
                ->get();

            return view('searchPlace')->with('province',$province);
        }

}
