<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function company()
    {
        return view('company');
    }

    public function oem()
    {
        return view('oem');
    }

    public function information()
    {
        return view('information');
    }

    public function privacy()
    {
        return view('privacy');
    }
    
    public function contact()
    {
        return view('contact');
    }   

}
