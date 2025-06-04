<x-app-layout>
  <div class="container mx-auto px-4 py-6 tracking-tight">
    <h1 class="text-2xl font-semibold mb-4">Selamat datang, {{ auth()->user()->name }}</h1>

    <h2 class="text-xl font-semibold mb-4">Artikel</h2>

    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 list-none">
      @foreach ($articles as $article)
        <li>
          <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
              <img class="rounded-t-lg w-full h-48 object-cover" src="{{ $article->image }}" alt="{{ $article->title }}" />
            </a>
            <div class="p-5">
              <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                  {{ $article->title }}
                </h5>
              </a>
              <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                {{ \Illuminate\Support\Str::limit($article->content, 100) }}
              </p>
              <a href="{{ route('articles.show', $article) }}"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Read more
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  fill="none" viewBox="0 0 14 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
              </a>
            </div>
          </div>
        </li>
      @endforeach
    </ul>
    
  </div>
</x-app-layout>
