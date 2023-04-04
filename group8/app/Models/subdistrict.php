<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    use HasFactory;

    protected $table = 'subdistrict';

    protected $primaryKey = 'subdistrictID';

    protected $fillable = ['subdistrictID', 'subdistrictName', 'districtID'];

    // Add any relationships or custom methods here
    public function dogs()
    {
        return $this->hasMany(Dog::class, 'subdistrictID');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'districtID');
    }

}
