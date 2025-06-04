<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Buat Pengguna') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="mb-4">
              <label for="name" class="block text-sm font-medium">Nama</label>
              <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                required>
              @error('name')
                <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
              @enderror
            </div>
            <div class="mb-4">
              <label for="email" class="block text-sm font-medium">Email</label>
              <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                required>
              @error('email')
                <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
              @enderror
            </div>
            <div class="mb-4">
              <label for="password" class="block text-sm font-medium">Password</label>
              <input type="password" name="password" id="password"
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                required>
              @error('password')
                <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
              @enderror
            </div>
            <div class="mb-4">
              <label for="role_id" class="block text-sm font-medium">Role</label>
              <select name="role_id" id="role_id"
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                required>
                <option value="">Pilih Role</option>
                @foreach ($roles as $role)
                  <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                    {{ $role->name }}</option>
                @endforeach
              </select>
              @error('role_id')
                <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
              @enderror
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
