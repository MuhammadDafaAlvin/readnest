<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Kelola Pengguna') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <a href="{{ route('users.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md mb-4">Buat
            Pengguna Baru</a>
          @if ($users->isEmpty())
            <p class="text-gray-600 dark:text-gray-400">Belum ada pengguna.</p>
          @else
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                  <th class="px-6 py-3">Nama</th>
                  <th class="px-6 py-3">Email</th>
                  <th class="px-6 py-3">Role</th>
                  <th class="px-6 py-3">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                  <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">{{ $user->role->name }}</td>
                    <td class="px-6 py-4">
                      <a href="{{ route('users.edit', $user) }}"
                        class="text-yellow-600 dark:text-yellow-400 hover:underline">Edit</a>
                      <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 dark:text-red-400 hover:underline ml-2"
                          onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="mt-4">
              {{ $users->links() }}
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
