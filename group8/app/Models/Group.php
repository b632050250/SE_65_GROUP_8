<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Group extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = "group";
    protected $primaryKey = 'groupID';
    protected $with = ['dogpicture'];
    protected $fillable = ['groupID',
        'groupofdogID',
        'dogID',
    ];
    public function dogpicture()
    {
        return $this->belongsTo(Dogpicture::class, 'dogpictureID');
    }

    public function dog()
    {
        return $this->belongsTo(Dog::class, 'dogID');
    }

    public function groupOfDog()
    {
        return $this->belongsTo(GroupOfDog::class, 'groupOfDogID');
    }
    public function subdistrict()
    {
    return $this->belongsTo(Subdistrict::class, 'subdistrictID');
    }


}
