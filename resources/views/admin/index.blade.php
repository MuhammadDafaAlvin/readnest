<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard Admin') }}
    </h2>
  </x-slot>

  <div class="py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <h3 class="text-lg font-semibold mb-4">Statistik</h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-blue-100 dark:bg-blue-900 p-4 rounded-lg text-gray-100">
              <p class="text-sm">Artikel</p>
              <p class="text-2xl font-bold ">{{ $articlesCount }}</p>
            </div>
            <div class="bg-green-100 dark:bg-green-900 p-4 rounded-lg text-gray-100">
              <p class="text-sm">Kategori</p>
              <p class="text-2xl font-bold">{{ $categoriesCount }}</p>
            </div>
            <div class="bg-yellow-100 dark:bg-yellow-900 p-4 rounded-lg text-gray-100">
              <p class="text-sm">Komentar</p>
              <p class="text-2xl font-bold">{{ $commentsCount }}</p>
            </div>
            <div class="bg-red-100 dark:bg-red-900 p-4 rounded-lg text-gray-100">
              <p class="text-sm">Pengguna</p>
              <p class="text-2xl font-bold">{{ $usersCount }}</p>
            </div>
          </div>
          <div class="mt-6">
            <a href="{{ route('categories.index') }}"
              class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md text-sm">Kelola Kategori</a>
            <a href="{{ route('users.index') }}"
              class="inline-block px-4 py-2 bg-red-600 text-white rounded-md text-sm">Kelola
              Pengguna</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
