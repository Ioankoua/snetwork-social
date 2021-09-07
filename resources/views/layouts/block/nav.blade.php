<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
  <div class="container-fluid" style="margin-left: 5vw;">
    <a href="#"></a><h2>SNet</h2></a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        @if (Auth::check()) 

        <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-left: 3vw; font-size: 19px;">
          <li class="nav-item">
            <a href="{{ route('profile.mainProfile', ['name' => Auth::user()->name]) }}" class="nav-link">
              Profile {{ Auth::user()->name }}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('wall.timeline') }}">Wall</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('friends.index') }}">Frends</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('message.messagesPage') }}">Masseges</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('profile.edit') }}" class="nav-link">Refresh profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('auth.exit') }}">Exit</a>
          </li>
        </ul>

        <form method="get" action="{{ route('search.results') }}" class="d-flex">
          <input name="query" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        @else

        <li class="nav-item" style="margin-left: 3vw; font-size: 18px;">
          <a class="nav-link" aria-current="page" 
           href="{{ route('auth.register') }}">Register</a>
        </li>

        <li class="nav-item" style="font-size: 18px;">
          <a class="nav-link" aria-current="page" href="{{ route('auth.enter') }}">Enter</a>
        </li>

        @endif

      </ul>
    </div>
  </nav>