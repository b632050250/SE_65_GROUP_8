<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'province';

    protected $primaryKey = 'provinceID';

    protected $fillable = ['provinceID','provinceName'];

    // Add any relationships or custom methods here

    public function districts()
    {
        return $this->hasMany(District::class, 'provinceID');
    }
}
