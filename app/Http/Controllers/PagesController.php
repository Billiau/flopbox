<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welkom bij Dropbox';
        // return view('pages.index', compact('title'));
        return view('pages.index')->with('title', $title);
    }
    
    public function about(){
        return view('pages.about');
    }
    
    public function services(){
        $data = array(
            'title' => 'Gebruikte technieken',
            'services' => ['HTML5', 'CSS3', 'Bootstrap4', 'JavaScript', 'AJAX', 'PHP7 / Laravel', 'MySQL' ]
        );
        return view('pages.services')->with($data);
    }
}
