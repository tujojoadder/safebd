<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'member'; 
     // Disable created_at and updated_at
    public $timestamps = false;

    protected $fillable = [
        'j_date',
        'fullname',
        'phone',
        'dateOfBirth',
        'blood',
        'division_id',
        'district_id',
        'upazila_id',
        'zilla',
        'thana',
        'union',
    ];
}