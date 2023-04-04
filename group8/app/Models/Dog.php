<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Dog extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = "dog";
    protected $primaryKey = 'dogID';
    
    protected $fillable = [
        'dogID',
        'dogName',
        'subdistrictID',
        'description',
        'dogpictureID', 'dogcolor',
    ];
    public function dogpicture()
    {
        return $this->belongsTo(Dogpicture::class, 'dogpictureID');
    }
    public function subdistrict()
    {
        return $this->belongsTo(Subdistrict::class, 'subdistrictID');
    }

    public function district()
    {
        return $this->belongsTo(district::class, 'districtID');
    }

    public function province()
    {
        return $this->belongsTo(province::class, 'provinceID');
    }
    public function group()
    {
        return $this->belongsTo(Group::class, 'groupOfDogID', 'groupOfDogID');
    }

}
