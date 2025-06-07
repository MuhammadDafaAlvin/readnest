<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Buat Artikel') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
              {{ session('success') }}
            </div>
          @endif
          <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
              <label for="title" class="block text-sm font-medium">Judul</label>
              <input type="text" name="title" id="title" value="{{ old('title') }}"
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                required>
              @error('title')
                <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
              @enderror
            </div>
            <div class="mb-4">
              <label for="content" class="block text-sm font-medium">Konten</label>
              <textarea name="content" id="content" rows="6"
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>{{ old('content') }}</textarea>
              @error('content')
                <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
              @enderror
            </div>
            <div class="mb-4">
              <label for="category_id" class="block text-sm font-medium">Kategori</label>
              <select name="category_id" id="category_id"
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                required>
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}</option>
                @endforeach
              </select>
              @error('category_id')
                <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
              @enderror
            </div>
            <div class="mb-4">
              <label for="image" class="block text-sm font-medium">Gambar (maks 2MB, format: jpg, png, gif)</label>
              <input type="file" name="image" id="image"
                class="mt-1 block w-full text-gray-500 dark:text-gray-400" accept="image/jpeg,image/png,image/gif">
              @error('image')
                <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
              @enderror
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
