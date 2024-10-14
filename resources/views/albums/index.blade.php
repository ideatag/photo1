<x-app-layout>

    <div class="container mx-auto p-4">
        <div class="mb-4">
            <a href="{{ route('albums.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring">
                Create New Album
            </a>
        </div>

        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 font-semibold px-4 py-2">Album Title</th>
                    <th class="border border-gray-300 font-semibold px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($albums as $album)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <a href="{{ route('albums.show', $album->id) }}" class="bg-green-500 text-white font-semibold py-1 px-4 rounded hover:bg-green-700 focus:outline-none">{{ $album->title }}</a>
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center space-x-2">
                            <a href="{{ route('albums.edit', $album->id) }}" class="inline-flex items-center px-4 py-1 bg-yellow-500 text-white font-semibold rounded hover:bg-yellow-600 focus:outline-none focus:ring">
                                Edit
                            </a>
                            <form action="{{ route('albums.destroy', $album->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-1 bg-red-500 text-white font-semibold rounded hover:bg-red-600 focus:outline-none focus:ring">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
