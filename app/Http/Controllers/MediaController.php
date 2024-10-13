<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    //
    public function index()
    {
        $media = Media::latest()->paginate(5);
        return view('admins.media.index', compact('media'));
    }

    public function create()
    {
        return view('admins.media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'files.*' => 'required|mimes:jpg,jpeg,png,mp4,mov,avi,wmv|max:20480',
        ]);
    
        foreach ($request->file('files') as $file) {
            $filePath = $file->store('media');
            Media::updateOrCreate(
                ['file_name' => $file->getClientOriginalName()],
                [
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $file->getClientMimeType(),
                    'file_path' => $filePath,
                ]
            );
        }
    
        return redirect()->route('media.index')->with('success', 'Files uploaded successfully.');
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        Storage::delete($media->file_path);
        $media->delete();

        return redirect()->route('media.index')->with('success', 'File deleted successfully.');
    }

}
