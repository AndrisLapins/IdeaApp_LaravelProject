<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $title = 'Welcome to the Idea App!';
        //return view('pages.index', compact('title'));
        return view('pages.index')->with('title',$title);
    }

    public function about() {
        return view('pages.about');
    }
}
