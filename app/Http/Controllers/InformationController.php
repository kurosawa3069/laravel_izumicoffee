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

    public function create()
    {
        return view('information.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'posted_at' => 'required|date',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
        ]);

        $fileNameToInformation = null;

        if  ($request->hasFile('image') && $request->file('image')->isValid()) {

            $imageFile = $request->file('image');

            // ファイル名生成
            $fileName = uniqid() . '_' . time();
            $extension = $imageFile->getClientOriginalExtension();
            $fileNameToInformation = $fileName . '.' . $extension;

            // ImageManager（v3）
            $manager = new ImageManager(new Driver());

            $image = $manager
                ->read($imageFile)
                ->resize(1920, 1080);

            // 保存（public/storage）
            Storage::disk('public')->put(
                'information/' . $fileNameToInformation,
                (string) $image->encode()
            );

            // dd($value);
        }

        Information::create([
            'posted_at' => $request->posted_at,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $fileNameToInformation,
        ]);

        return redirect()->route('information.index'); 
    }

    public function show(string $id)
    {
        $information = Information::findOrFail($id);
        return view('information.show', compact('information'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
