<!-- HEADER MOBILE-->
<header class="header-mobile d-block d-lg-none">
  <div class="header-mobile__bar">
      <div class="container-fluid">
          <div class="header-mobile-inner">
              <a class="logo" href="{{ route('admin.dashboard') }}">
                  {{ config('app.name', 'Dog World') }}
              </a>
              <button class="hamburger hamburger--slider" type="button">
                  <span class="hamburger-box">
                      <span class="hamburger-inner"></span>
                  </span>
              </button>
          </div>
      </div>
  </div>
  <nav class="navbar-mobile">
      <div class="container-fluid">
          <ul class="navbar-mobile__list list-unstyled">
             
              <li>
                  <a href="{{ route('admin.dashboard') }}">
                      <i class="fas fa-chart-bar"></i>Dashboard</a>
              </li>
              <li>
                  <a href="{{ route('dogs') }}">
                      <i class="fas fa-table"></i>Dogs</a>
              </li>
              <li>
                  <a href="form.html">
                      <i class="far fa-user"></i>Users</a>
              </li>
              <li>
                  <a href="calendar.html">
                      <i class="fas fa-calendar-alt"></i>Orders</a>
              </li>
              <li>
                  <a href="map.html">
                      <i class="fas fa-map-marker-alt"></i>Payment History</a>
              </li>
             
             
          </ul>
      </div>
  </nav>
</header>
<!-- END HEADER MOBILE-->
<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
  <div class="logo">
      <a href="{{ route('admin.dashboard') }}">
        {{ config('app.name', 'Dog World') }}
      </a>
  </div>
  <div class="menu-sidebar__content js-scrollbar1">
      <nav class="navbar-sidebar">
          <ul class="list-unstyled navbar__list">
             
              <li>
                  <a href="{{ route('admin.dashboard') }}">
                      <i class="fas fa-tachometer-alt"></i>Dashboard</a>
              </li>
              <li>
                <a href="{{ route('categories') }}">
                    <i class="fas fa-sort-amount-asc"></i>Dog Categories</a>
            </li>
            <li>
                <a href="{{ route('dogs') }}">
                    <i class="fas fa-table"></i>Dogs</a>
            </li>
            <li>
                <a href="{{ route('users') }}">
                    <i class="far fa-user"></i>Users</a>
            </li>
            <li>
                <a href="calendar.html">
                    <i class="fas fa-shopping-cart"></i>Orders</a>
            </li>
            <li>
                <a href="map.html">
                    <i class="fas fa-credit-card"></i>Payment History</a>
            </li>
                  </ul>
              </li>
          </ul>
      </nav>
  </div>
</aside>
<!-- END MENU SIDEBAR-->