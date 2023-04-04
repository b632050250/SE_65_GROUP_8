<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'district';

    protected $primaryKey = 'districtID';

    protected $fillable = ['districtID', 'districtName', 'provinceID'];

    // Add any relationships or custom methods here

    public function province()
    {
        return $this->belongsTo(Province::class, 'provinceID', 'provinceID');
    }

    public function subdistricts()
    {
        return $this->hasMany(Subdistrict::class, 'districtID', 'districtID');
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'districtID', 'districtID');
    }
    

}
