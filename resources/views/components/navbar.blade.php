<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      {{ config('app.name', 'Laravel') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto">
        @auth
          <li class="nav-item">
            <a href="{{route('index')}}" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="{{route('about')}}" class="nav-link">About</a>
          </li>
        @endauth
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <ul class="navbar-nav ml-auto">
          @auth
            <li class="nav-item">
                <a href="{{route('todo.index')}}" class="nav-link">Todos</a>
            </li>
            <li class="nav-item">
                <a href="{{route('todo.create')}}" class="nav-link">New Todo</a>
            </li>
            <li style="position: relative;">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{ucfirst(Auth::user()->name)}}
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" onclick="document.querySelector('#logout').submit()" style="cursor: pointer;">Logout</a>
              </div>
            </li>
            <form method="POST" id="logout" action="{{route('logout')}}">
                @csrf
            </form>
          @else
            <li class="nav-item">
                <a href="{{route('login')}}" class="nav-link">Login</a>
            </li>
            <li class="nav-item">
                <a href="{{route('register')}}" class="nav-link">Register</a>
            </li>
          @endauth
        </ul>
      </ul>
    </div>
  </div>
</nav>
