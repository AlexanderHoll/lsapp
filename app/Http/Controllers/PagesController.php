<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use resources\views\pages;

class PagesController extends Controller
{
    public function index () {
        $title = 'Welcome to Laravel';
        // return view as normal, but pass title variable also
        return view('pages.index', compact('title'));
    }

    // OLD Controller Functions - Now using Page Manager
    // public function about () {
    //     $title = 'About Us';
    //     return view('pages.about')->with('title', $title);
    // }

    // public function services () {
    //     // declaring array to pass to services, i.e title and multiple services
    //     $data = array (
    //         'title' => 'Services',
    //         'services' => ['Web Design', 'Programming', 'SEO']
    //     );
    //     return view('pages.services')->with($data);
    // }
}
