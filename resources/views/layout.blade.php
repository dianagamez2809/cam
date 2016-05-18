<html>
    <head>
      <title>Codon system</title>
      <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
      {{ HTML::style('css/foundation.css'); }}
    </head>
    <body>
        <div class="container">
          <div class="title-bar" data-responsive-toggle="realEstateMenu" data-hide-for="small">
            <button class="menu-icon" type="button" data-toggle></button>
            <div class="title-bar-title">Menu</div>
          </div>
          <div class="top-bar" id="realEstateMenu">
            <div class="top-bar-left">
                <ul class="menu" data-responsive-menu="accordion">
                    <li class="menu-text">Interplanetary</li>
                    <li><a href="#">One</a></li>
                    <li><a href="#">Two</a></li>
                    <li><a href="#">Three</a></li>
                </ul>
            </div>
            <div class="top-bar-right">
              <ul class="menu">
                <li><a href="#">My Account</a></li>
              </ul>
            </div>
          </div>
          @yield('content')
        </div>
    </body>
    <footer>
      <div class="row">
        <div class="medium-6 columns">
          <ul class="menu">
            <li><a href="#">Legal</a></li>
            <li><a href="#">Partner</a></li>
            <li><a href="#">Explore</a></li>
          </ul>
        </div>
        <div class="medium-6 columns">
          <ul class="menu float-right">
            <li class="menu-text">Copyright</li>
          </ul>
        </div>
      </div>
    </footer>
</html>
