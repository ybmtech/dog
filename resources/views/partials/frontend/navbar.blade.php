<!-- Navbar Start -->
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-lg-5">
        <a href="" class="navbar-brand d-block d-lg-none">
            <h1 class="m-0 display-5 text-capitalize font-italic text-white"><span class="text-primary">{{ config('app.name', 'Dog World') }}</span></h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
            <div class="navbar-nav mr-auto py-0">
                <a href="{{ route('index') }}" class="nav-item nav-link {{ (request()->is('/')) ? "active":"" }}">Home</a>
                  <a href="{{ asset('store') }}" class="nav-item nav-link {{ (request()->is('store')) ? "active":"" }}">Dogs Store</a>
                  <a href="{{ route('about') }}" class="nav-item nav-link {{ (request()->is('about')) ? "active":"" }}">About</a>
                <a href="{{ asset('contact') }}" class="nav-item nav-link {{ (request()->is('contact')) ? "active":"" }}">Contact</a>
                <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
            </div>
         </div>
        <a href="{{ route('cart') }}"> <span class="badge badge-success flaticon-toy" style="font-size:20px;"> @php echo \Cart::getContent()->count(); @endphp</span></a>
    </nav>
</div>
<!-- Navbar End -->