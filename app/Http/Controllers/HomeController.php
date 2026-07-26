<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;

class HomeController extends Controller
{
    public function index()
    {
        // お知らせ最新3件取得
        $informations = Information::orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        return view('home', compact('informations'));
    }

    public function company()
    {
        return view('company');
    }

    public function oem()
    {
        return view('oem');
    }

    // public function information()
    // {
    //     return view('information');
    // }

    public function privacy()
    {
        return view('privacy');
    }
    
    // public function contact()
    // {
    //     return view('contact');
    // }   

}
