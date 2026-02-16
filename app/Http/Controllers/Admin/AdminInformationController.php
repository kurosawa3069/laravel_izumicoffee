<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Information;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminInformationController extends Controller
{
    public function index()
    {
        // $informations = Information::paginate(12);
        $informations = Information::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.information.index', compact('informations'));
    }

    public function create()
    {
        return view('admin.information.create');
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

        return redirect()->route('admin.information.index'); 
    }

    public function show(string $id)
    {
        $information = Information::findOrFail($id);
        return view('admin.information.show', compact('information'));
    }

    public function edit(string $id)
    {
        $information = Information::findOrFail($id);
        return view('admin.information.edit', compact('information'));
    }

    public function update(Request $request, string $id)
    {
    
        $information = Information::findOrFail($id);

        $request->validate([
            'posted_at'   => 'required|date',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
        ]);

        $information->posted_at   = $request->posted_at;
        $information->title       = $request->title;
        $information->description = $request->description;

        if ($request->hasFile('image')) {

            // 既存画像を削除
            if ($information->image) {
                Storage::disk('public')->delete(
                    'information/' . $information->image
                );
            }
            $imageFile = $request->file('image');
            $fileName = uniqid() . '.' . $imageFile->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image = $manager
                ->read($imageFile)
                ->resize(1920, 1080);
            Storage::disk('public')->put(
                'information/' . $fileName,
                (string) $image->encode()
            );
            $information->image = $fileName;
        }

        $information->save();

        return redirect()
            ->route('admin.information.index');
    }

    
    public function destroy($id)
    {

        $information = Information::findOrFail($id);
        // 画像があれば削除
        if ($information->image) {
            Storage::disk('public')->delete(
                'information/' . $information->image
            );
        }

        // レコード削除
        $information->delete();

        return redirect()
            ->route('admin.information.index');
    }

}
