<x-app-layout>
    <div class="max-w-6xl mx-auto">
        <h2 class="text-3xl font-bold text-green-400 mb-6">Dashboard</h2>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Upload Card -->
            <div class="bg-slate-800 p-6 rounded-2xl shadow-lg">
                <h3 class="text-xl font-semibold mb-4">Upload File for Compression</h3>
                <form action="{{ route('compress.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="block w-full text-sm text-gray-300 mb-4">
                    <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition">
                        Compress Now
                    </button>
                </form>
            </div>

            <!-- Metrics Card -->
            <div class="bg-slate-800 p-6 rounded-2xl shadow-lg">
                <h3 class="text-xl font-semibold mb-4">Previous Compression Metrics</h3>

                @if($files->count() > 0)
                    <ul class="text-gray-300 text-sm space-y-2">
                        @foreach($files->take(5) as $file)
                            <li>
                                <strong>{{ $file->original_name }}</strong> — 
                                <span class="text-green-400">{{ $file->compression_ratio }}%</span>
                                ({{ number_format($file->original_size, 2) }}KB → {{ number_format($file->compressed_size, 2) }}KB)
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-400">No data yet. Start compressing to see results.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto mt-10 bg-slate-800 rounded-xl p-6 shadow-lg">
        <h2 class="text-2xl font-bold text-green-400 mb-4">Your Uploaded Files</h2>

        @if(session('success'))
            <div class="bg-green-700 text-green-100 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full text-left border border-slate-700">
            <thead class="bg-slate-700 text-green-400">
                <tr>
                    <th class="p-3">File Name</th>
                    <th class="p-3">Original Size (KB)</th>
                    <th class="p-3">Compressed Size (KB)</th>
                    <th class="p-3">Compression (%)</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($files as $file)
                    <tr class="border-b border-slate-700">
                        <td class="p-3">{{ $file->original_name }}</td>
                        <td class="p-3">{{ number_format($file->original_size, 2) }}</td>
                        <td class="p-3">{{ number_format($file->compressed_size, 2) }}</td>
                        <td class="p-3">{{ $file->compression_ratio }}%</td>
                        <td class="p-3">
                            <a href="{{ asset($file->file_path) }}" class="text-green-400 hover:text-green-600" download>Download</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-400 p-4">No files uploaded yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if(session('compression'))
            <div class="bg-slate-800 p-4 mt-4 rounded-lg text-sm text-gray-300">
                <h2 class="text-green-400 font-semibold mb-2">Compression Summary</h2>
                <p><strong>Original Size:</strong> {{ session('compression')['original_size'] }} KB</p>
                <p><strong>Compressed Size:</strong> {{ session('compression')['compressed_size'] }} KB</p>
                <p><strong>Compression Ratio:</strong> {{ session('compression')['compression_ratio'] }}%</p>
                <p><strong>Compression Time:</strong> {{ number_format(session('compression')['compression_time'], 4) }} sec</p>
            </div>
        @endif
    </div>
</x-app-layout>
