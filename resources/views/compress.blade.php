@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-slate-800 rounded-xl p-8 shadow-lg text-center">
    <h2 class="text-3xl font-bold text-green-400 mb-6">Upload Your File</h2>
    <p class="text-gray-400 mb-6">Upload a text or data file for Adaptive Predictive Compression.</p>

    @if(session('success'))
        <div class="bg-green-700 text-green-100 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @if(session('file'))
            <p class="text-gray-300">Compressed file: <strong>{{ session('file') }}</strong></p>
        @endif
    @endif

    <form action="{{ route('compress.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <input type="file" name="file" class="block w-full text-gray-100 border border-slate-700 rounded-lg p-2 bg-slate-900">
        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition">
            Compress File
        </button>
        <form action="{{ route('compress.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <input type="file" name="file" class="form-control mb-3" required>
        <button type="submit" class="btn btn-primary">Compress & Upload</button>
    </form>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    </form>
</div>
@endsection
