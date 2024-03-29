<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dogpicture extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'dogpicture';

    protected $primaryKey = 'dogpictureID';

    protected $fillable = ['dogpictureID', 'dogpicturePath'];

    public function groups()
    {
        return $this->hasMany(Group::class, 'dogpictureID');
    }
}
