<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Information;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $informations = Information::paginate(12);
        $informations = Information::orderBy('created_at', 'desc')->paginate(12);
        return view('information.index', compact('informations'));
    }

    public function show(string $id)
    {
        $information = Information::findOrFail($id);
        return view('information.show', compact('information'));
    }

}
