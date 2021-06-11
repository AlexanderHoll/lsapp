<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicSeed extends Model
{
    use HasFactory;
    // define fillable fields for basic seed test
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'cover_image'
    ];
}
