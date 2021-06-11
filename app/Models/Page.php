<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    // Name of table to be used
    protected $table = 'pages';
    
    // Primary Key - default value, not needed
    public $primaryKey = 'id';
    // Timestamps - default value, not needed
    public $timestamps = true;

    protected $fillable = ['template', 'name', 'title', 'slug', 'content', 'extras'];

    // Create relationship between user and post
    // One to many
    public function page() {
        // again using namespace as App\User does not work
        return $this->belongsTo('App\Models\Page');
    }
}
