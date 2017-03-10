<!-- Default Bootstrap Nav Bar -->

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="/"><strong>Hele</strong></a>
    <div class="navbar-header pull-right">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        Menu
      </button>
    </div>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="{{ Request::is('destinations') ? "active" : "" }}"><a href="destinations">Destinations</a></li>
        <li class="{{ Request::is('about') ? "active" : "" }}"><a href="about">About</a></li>
        <li class="{{ Request::is('contact') ? "active" : "" }}"><a href="contact">Contact</a></li>

      </ul>

      <ul class="nav navbar-nav navbar-right">
        @if(Auth::check())
          <li><a href="#"><img src={{ 'https://www.gravatar.com/avatar/' . md5(strtolower(trim(Auth::user()->email))) . '?s=40&d=monsterid' }} class="user-img">  {{ Auth::user()->name }} </a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">cPanel <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('places.index') }}">Places</a></li>
            <li><a href="{{ route('category.index') }}">Categories</a></li>
            <li><a href="{{ route('tags.index') }}">Tags</a></li>
          </ul>
        </li>
        <li><form action="{{ route('logout') }}" method="post">
          {{ csrf_field() }}
          <input type="submit" value="Logout" class="btn btn-default nav-btn-top">
        </form></li>
        @else
          <li class="{{ Request::is('login') ? "active" : "" }}"><a href="{{ route('login') }}" >Login</a></li>
        @endif

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
