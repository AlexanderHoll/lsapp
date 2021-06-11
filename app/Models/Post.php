<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    // Name of table to be used
    protected $table = 'posts';
    
    // Primary Key - default value, not needed
    public $primaryKey = 'id';
    // Timestamps - default value, not needed
    public $timestamps = true;

    protected $fillable = ['title', 'body'];

    // Create relationship between user and post
    // One to many
    public function user() {
        // again using namespace as App\User does not work
        return $this->belongsTo('App\Models\User');
    }
}
