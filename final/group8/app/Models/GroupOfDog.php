<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GroupOfDog extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = "groupofdog";

    protected $primaryKey = 'groupofdogID';

    protected $fillable = [
        'groupofdogID',
        'groupofdogName',
        'placeID',
        'description',
    ];

    public static function getAll(){
        $data = DB::table('groupofdog')->get();
        return $data;
    }
    public function groups()
    {
        return $this->hasMany(Group::class, 'groupOfDogID');
    }


}
