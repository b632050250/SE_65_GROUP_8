<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Donation extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = "donation";

    protected $fillable = [
        'donationSlip',
        'userID',
        'donationAmount',
        'donationTime',
        'opendonateID ',
    ];



}
