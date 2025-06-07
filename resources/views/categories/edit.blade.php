<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Edit Kategori') }}
    </h2>
  </x-slot>

  <div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <form method="POST" action="{{ route('categories.update', $category) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
              <label for="name" class="block font-medium">Nama</label>
              <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
                class="mt-4 block w-full rounded-md border-gray-300 dark:border-gray-600"
                required>
              @error('name')
                <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
              @enderror
            </div>
            <button type="submit" class="px-4 py-2 text-sm bg-black text-white rounded-md">Perbarui</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
