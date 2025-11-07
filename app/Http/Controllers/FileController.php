<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Show the file upload form
     */
    public function index()
    {
        $files = File::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard', compact('files'));
    }

    /**
     * Handle file upload and save to database
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:txt,pdf,doc,docx,csv|max:2048',
        ]);

        $uploadedFile = $request->file('file');
        $filename = time() . '_' . $uploadedFile->getClientOriginalName();

        // Store file in 'uploads' folder in storage/app/public
        $path = $uploadedFile->storeAs('uploads', $filename, 'public');

        // Save record in the database
        $file = new File();
        $file->user_id = Auth::id();
        $file->file_name = $filename;
        $file->file_path = $path;
        $file->file_size = $uploadedFile->getSize();
        $file->save();

        return redirect()->route('dashboard')->with('success', 'File uploaded successfully!');
    }

    /**
     * Download the file
     */
    public function download($id)
    {
        $file = File::findOrFail($id);

        if ($file->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return Storage::disk('public')->download($file->file_path);
    }

    /**
     * Delete the file
     */
    public function destroy($id)
    {
        $file = File::findOrFail($id);

        if ($file->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        Storage::disk('public')->delete($file->file_path);
        $file->delete();

        return redirect()->route('dashboard')->with('success', 'File deleted successfully!');
    }
}
