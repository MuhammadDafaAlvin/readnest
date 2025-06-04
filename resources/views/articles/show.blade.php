<x-app-layout>
  <div class="max-w-4xl mx-auto px-4 py-6 !font-serif">

    <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-800 leading-tight mb-2 tracking-tight">
      {{ $article->title }}</h1>

    <div class="flex items-center text-sm text-gray-500 dark:text-gray-600 mb-6 flex-wrap gap-2">
      <span class="inline-block">Kategori: <strong>{{ $article->category->name }}</strong></span>
      <span class="hidden sm:inline-block">|</span>
      <span class="inline-block">Penulis: <strong>{{ $article->author->user->name }}</strong></span>
      <span class="hidden sm:inline-block">|</span>
      <span class="inline-block">Dipublikasikan: {{ $article->created_at->format('d M Y') }}</span>
    </div>

    @if ($article->image)
      <img src="{{ asset($article->image) }}" alt="{{ $article->title }}"
        class="w-full h-72 sm:h-96 object-cover rounded-xl shadow mb-8" />
    @else
      <div class="w-full h-72 bg-gray-200 dark:bg-gray-700 flex items-center justify-center rounded-xl mb-8">
        <span class="text-gray-500 dark:text-gray-400">No Image</span>
      </div>
    @endif

    <div class="prose dark:prose-invert max-w-none mb-10 text-lg leading-relaxed tracking-wide">
      {!! nl2br(e($article->content)) !!}
    </div>

    <section class="mt-12">
      <h2 class="text-lg  text-gray-900 dark:text-gray-600 mb-4">Komentar</h2>

      @php
        function consistentColorHex($string)
        {
            return substr(md5($string), 0, 6);
        }
      @endphp


      @if ($article->comments->isEmpty())
        <p class="text-gray-600 dark:text-gray-400">Belum ada komentar.</p>
      @else
        <ul class="space-y-6">
          @foreach ($article->comments as $comment)
            <li class="flex gap-4 items-start bg-gray-50 p-4 rounded-xl shadow-sm">
              <img
                src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&size=64&background={{ consistentColorHex($comment->user->name) }}&color=ffffff"
                alt="{{ $comment->user->name }}" class="w-10 h-10 rounded-full shadow" />
              <div>
                <div class="flex items-center justify-between mb-1">
                  <span class="text-gray-600">{{ $comment->user->name }}</span>
                  <span class="ml-4 text-xs text-gray-500">{{ $comment->created_at->format('d M Y H:i') }}</span>
                </div>
                <p class="text-sm text-gray-500">{{ $comment->content }}</p>
              </div>
            </li>
          @endforeach
        </ul>
      @endif
    </section>

    @auth
      <section class="mt-12">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Tinggalkan Komentar</h3>
        <form method="POST" action="{{ route('comments.store') }}" class="space-y-4">
          @csrf
          <input type="hidden" name="article_id" value="{{ $article->id }}">

          <div>
            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Komentar Anda
            </label>
            <textarea id="content" name="content" rows="4"
              class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500"
              required></textarea>
            @error('content')
              <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <button type="submit"
            class="inline-flex items-center px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
            Kirim Komentar
          </button>
        </form>
      </section>
    @else
      <p class="mt-12 text-gray-600 dark:text-gray-400">
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline dark:text-blue-400 font-semibold">
          Masuk
        </a> untuk memberikan komentar pada artikel ini.
      </p>
    @endauth
  </div>
</x-app-layout>
