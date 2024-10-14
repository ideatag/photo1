<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-semibold mb-4">Edit Album</h1>
        <form action="{{ route('albums.update', $album->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Album Title</label>
                <input type="text" name="title" id="title" value="{{ $album->title }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white tracking-wide hover:bg-blue-700 focus:outline-none focus:ring">
                Update Album
            </button>
        </form>
    </div>
</x-app-layout>
