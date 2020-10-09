<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Exam Application | @yield('title')</title>

  <style>
    body {
      margin: 0;
      padding: 0;
      width: 100%;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      align-content: center;
    }

    .mt-flex {
      display: flex;
      width: 100%;
      justify-content: center;
      margin-top: 30px;
    }
  </style>

  @stack('styles')
</head>

<body>
  @yield('content')

  <a href="{{route('home')}}" class="mt-flex">Go Home</a>
  <script src="{{ mix('/js/app.js') }}"></script>
  @stack('scripts')
</body>

</html>