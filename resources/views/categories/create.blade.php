<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Buat Kategori') }}
    </h2>
  </x-slot>

  <div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-800">
          <form method="POST" action="{{ route('categories.store') }}">
            @csrf
            <div class="mb-4">
              <label for="name" class="block">Nama</label>
              <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-500"
                required>
              @error('name')
                <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
              @enderror
            </div>
            <button type="submit" class="px-4 py-2 bg-black text-white text-sm rounded-md">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
