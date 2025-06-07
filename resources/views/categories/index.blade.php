<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Kelola Kategori') }}
    </h2>
  </x-slot>

  <div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 rounded-xl">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <a href="{{ route('categories.create') }}"
            class="inline-block px-4 py-2 bg-black text-sm text-white rounded-md mb-4">Buat Kategori Baru</a>
          @if ($categories->isEmpty())
            <p class="text-gray-600 dark:text-gray-400">Belum ada kategori.</p>
          @else
            <table class="w-full text-left text-gray-700">
              <thead class="text-gray-700 bg-gray-100">
                <tr>
                  <th class="px-6 py-3">Nama</th>
                  <th class="px-6 py-3">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categories as $category)
                  <tr class="bg-white border-b dark:border-gray-200">
                    <td class="px-6 py-4 text-gray-600 font-medium">{{ $category->name }}</td>
                    <td class="px-6 py-4 flex place-items-center gap-2">
                      <a href="{{ route('categories.edit', $category) }}"
                        class="text-yellow-600 dark:text-yellow-400">
                        <div class="flex place-items-center gap-1 group"><svg
                            style="--c-400:var(--primary-400);--c-600:var(--primary-600);"
                            class="fi-link-icon h-4 w-4 text-custom-600 dark:text-custom-400"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path
                              d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z">
                            </path>
                            <path
                              d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z">
                            </path>
                          </svg>
                          <p class="font-semibold">Edit</p>
                        </div>
                      </a>
                      <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 dark:text-red-400 ml-2"
                          onclick="return confirm('Yakin ingin menghapus?')">
                          <div class="flex place-items-center">
                            <svg style="--c-400:var(--danger-400);--c-600:var(--danger-600);"
                              wire:loading.remove.delay.default="1" wire:target="mountTableAction('delete', '3')"
                              class="fi-link-icon h-4 w-4 text-custom-600 dark:text-custom-400"
                              xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                              aria-hidden="true" data-slot="icon">
                              <path fill-rule="evenodd"
                                d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z"
                                clip-rule="evenodd"></path>
                            </svg>
                            <p class="font-semibold">Hapus</p>
                          </div>
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="mt-4">
              {{ $categories->links() }}
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
