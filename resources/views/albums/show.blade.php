<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-center text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Album:') }} {{ $album->title }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <form action="{{ route('photos.upload', $album->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4 mb-4">
            @csrf
            <div class="mb-3 flex items-center">
                <input type="file" name="photos[]" id="photos" multiple class="hidden" onchange="updateFileCount(this)">
                <label for="photos" class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md cursor-pointer">
                    Choose Files
                </label>
                <span id="fileCount" class="ml-4 text-gray-700">0 files selected</span>
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white tracking-wide hover:bg-blue-700 focus:outline-none focus:ring">
                Upload Photos
            </button>
            <a href="{{ route('albums.index') }}" class="inline-flex items-center mt-4 px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-gray-700 tracking-wide hover:bg-gray-400 focus:outline-none focus:ring">
                Back to Albums
            </a>
        </form>

        <h2 class="text-lg font-semibold mb-2">Photos</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @foreach($album->photos as $photo)
                <div class="col-span-1">
                    <img src="{{ asset('storage/' . $photo->path) }}"
                         alt="Photo"
                         class="rounded-lg object-cover w-full h-54 cursor-pointer p-1"
                         data-image-url="{{ asset('storage/' . $photo->path) }}"
                         onclick="showImageModal(this)">
                </div>
            @endforeach
        </div>

        <div id="imageModal" class="fixed inset-0 z-50 hidden overflow-auto bg-smoke-800 flex">
            <div class="relative p-8 bg-white w-full max-w-3xl m-auto flex-col flex rounded-lg">
                <img id="modalImage" src="#" alt="Large Photo" class="object-cover max-h-screen rounded-lg">
                <span class="absolute top-0 right-0 p-2 cursor-pointer" onclick="closeImageModal()">&times;</span>
            </div>
        </div>
    </div>

    <script>
        function showImageModal(imgElement) {
            const src = imgElement.getAttribute('data-image-url');
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }

        function updateFileCount(input) {
            const count = input.files.length;
            document.getElementById('fileCount').textContent = `${count} file${count !== 1 ? 's' : ''} selected`;
        }
    </script>
</x-app-layout>
