<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TreatedDog extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = "treateddog";

    protected $fillable = [
        'postcostID',
        'dogID',
        'treateddogstatusID',
    ];

   
}
