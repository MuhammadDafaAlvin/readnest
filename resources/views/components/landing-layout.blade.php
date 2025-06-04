<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-pro text-gray-900 antialiased bg-gray-100">
  <div class="min-h-screen flex flex-col">
    <!-- Header -->
    <div class="py-6">
      <div class="flex justify-center">
        <a href="/">
          <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>
      </div>
    </div>

    <!-- Konten utama -->
    <main class="flex-grow">
      {{ $slot }}
    </main>

    <!-- Footer opsional -->
    <footer class="text-center py-4 text-sm text-gray-500">
      &copy; {{ date('Y') }} {{ config('app.name') }}
    </footer>
  </div>
</body>

</html>
