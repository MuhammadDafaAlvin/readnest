<x-app-layout>
  <div class="container mx-auto px-4 py-4">
    <div class="max-w-6xl mb-10 mx-auto tracking-tighter">
      @php
        $isGuest = auth()->guest();
        $heading = $isGuest ? 'Selamat Datang di Readnest' : 'Selamat Datang, ' . auth()->user()->name . '!';
        $headingClass = $isGuest ? 'text-5xl' : 'text-4xl';
        $paragraphClass = $isGuest ? 'text-xl text-gray-800' : 'text-lg text-gray-600';
      @endphp

      <h1 class="max-w-4xl {{ $headingClass }} font-bold text-gray-900 mb-4">{{ $heading }}</h1>
      <p class="max-w-4xl tracking-normal {{ $paragraphClass }} dark:text-gray-600 mb-6">
        Temukan berbagai artikel menarik yang telah ditulis oleh komunitas — mulai dari tips bermanfaat, opini,
        hingga wawasan terkini seputar berbagai topik.
        Jelajahi, baca, dan perluas pengetahuan Anda setiap harinya.
      </p>

      <form method="GET" action="{{ route('dashboard') }}" id="search-form" class="flex mb-6 tracking-normal">
        <input type="text" name="search" id="search-input" value="{{ request()->query('search') }}"
          placeholder="Cari artikel berdasarkan judul atau konten..."
          class="w-full max-w-md px-4 py-2 rounded-l-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" id="search-button"
          class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:bg-gray-400 disabled:cursor-not-allowed">
          Cari
        </button>
      </form>
    </div>

    @if ($articles->isEmpty())
      <p class="text-gray-600 dark:text-gray-400 text-center">Belum ada artikel tersedia.</p>
    @else
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
        @foreach ($articles as $article)
          <div class="bg-white border border-gray-200 rounded-2xl shadow-lg overflow-hidden flex flex-col">
            <div class="p-4 flex flex-col flex-1 justify-between">
              <div>
                <div class="flex justify-between">
                  <span class="inline-block bg-blue-100 text-blue-500 text-xs font-semibold px-2.5 py-0.5 rounded mb-2">
                    {{ $article->category->name }}
                  </span>
                  <p class="text-sm text-gray-500 font-medium mb-2">{{ $article->created_at->format('d M Y') }}</p>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-800 leading-snug my-2 tracking-tight">
                  <a href="{{ route('articles.show', $article) }}">
                    {{ \Illuminate\Support\Str::limit($article->title, 50) }}
                  </a>
                </h3>


                <p class="text-gray-700 dark:text-gray-500 tracking-wide text-sm">
                  {{ \Illuminate\Support\Str::limit($article->content, 120) }}
                </p>
              </div>

              <div class="flex items-center justify-between mt-4 text-sm text-gray-500 dark:text-gray-400">
                <div class="flex items-center space-x-2">
                  <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author->user->name) }}&size=32"
                    alt="Avatar" class="w-8 h-8 rounded-full">
                  <span>By {{ $article->author->user->name }}</span>
                </div>
                <a href="{{ route('articles.show', $article) }}"
                  class="inline-flex items-center text-blue-600 hover:underline">
                  Baca
                  <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                  </svg>
                </a>
              </div>
              @if ($article->image)
                <img class="w-full h-48 object-cover mt-4 rounded-lg" src="{{ asset('storage/' . $article->image) }}"
                  alt="{{ $article->title }}" />
              @else
                <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center mt-4 rounded-lg">
                  <span class="text-gray-500 dark:text-gray-400">No Image</span>
                </div>
              @endif
            </div>
          </div>
        @endforeach
      </div>

      <div class="mt-8">
        {{ $articles->links() }}
      </div>
    @endif
  </div>
  <script>
    const searchForm = document.getElementById('search-form');
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');

    function toggleSearchButton() {
      searchButton.disabled = searchInput.value.trim().length === 0;
    }

    toggleSearchButton();
    searchInput.addEventListener('input', toggleSearchButton);

    searchForm.addEventListener('submit', function(event) {
      if (searchInput.value.trim().length === 0) {
        event.preventDefault();
      }
    });
  </script>
</x-app-layout>
