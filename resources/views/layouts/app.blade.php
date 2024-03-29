<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      {{-- needed for ajax --}}
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <link rel="stylesheet" href="{{asset('css/app.css')}}"> {{-- <- bootstrap css --}}

      <title>@yield('title','Todo App')</title>
  </head>
  <body>

      {{-- That's how you write a comment in blade --}}

      @include('components.navbar')

      <main class="container mt-4">
          @yield('content')
      </main>

      {{-- @include('components.footer') --}}

      <script src="{{asset('js/app.js')}}"></script> {{-- <- bootstrap and jquery --}}
      <script>
        //applies token to all request headers for ajax based applications
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      </script>
  </body>
</html>
