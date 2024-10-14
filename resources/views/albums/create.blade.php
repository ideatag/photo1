<x-app-layout>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Create New Album</h1>
        <form action="{{ route('albums.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="mb-3">
                <label for="title" class="block text-sm font-medium text-gray-700">Album Title</label>
                <input type="text" class="mt-1 block w-1/2 border-gray-300 rounded-md shadow-sm" id="title" name="title" required>
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white tracking-wide hover:bg-blue-700 focus:outline-none focus:ring">
                Create Album
            </button>
            <a href="{{ route('albums.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-gray-700 tracking-wide hover:bg-gray-400 focus:outline-none focus:ring">
                Back to Albums
            </a>
        </form>
    </div>
</x-app-layout>
