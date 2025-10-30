<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? "Quizz" }}</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
  {{-- Only show navigation when logged in --}}
  @auth
      <x-navigation></x-navigation>
  @endauth

  {{ $slot }}
</body>
</html>
