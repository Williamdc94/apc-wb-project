<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use App\Helpers\APCCompressor;

class CompressionController extends Controller
{
    // Show the dashboard with all files (metrics)
    public function index()
    {
        $files = File::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard', compact('files'));
    }

    // Handle upload and compression
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:5120', // 5MB limit
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $path = $file->store('uploads', 'public');
        $fullPath = storage_path('app/public/' . $path);

        if (!file_exists($fullPath)) {
            return back()->with('error', 'File not found.');
        }

        // 🔹 Perform compression using Adaptive Predictive Compression
        $compression = APCCompressor::compress($fullPath);

        // 🔹 Save results to DB
        File::create([
            'user_id' => Auth::id(),
            'original_name' => $originalName,
            'file_path' => 'storage/compressed/' . basename($fullPath) . '.apc',
            'original_size' => $compression['original_size'],
            'compressed_size' => $compression['compressed_size'],
            'compression_ratio' => $compression['compression_ratio'],
            'compression_time' => $compression['compression_time'],
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'File compressed successfully!')
            ->with('compression', $compression);
    }
}
