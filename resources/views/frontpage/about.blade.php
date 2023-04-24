@extends('layouts.frontend',['title'=>'About'])

@section('content')
  <!-- About Start -->
  <div class="container py-5">
    <div class="row py-5">
        <div class="col-lg-7 pb-5 pb-lg-0 px-3 px-lg-5">
            <h4 class="text-secondary mb-3">About Us</h4>
            <h1 class="display-4 mb-4"><span class="text-primary">Breading</span> & <span class="text-secondary">Selling Healthy Dogs</span></h1>
            <h5 class="text-muted mb-3">Amet stet amet ut. Sit no vero vero no dolor. Sed erat ut sea. Just clita ut stet kasd at diam sit erat vero sit.</h5>
            <p class="mb-4">Dolores lorem lorem ipsum sit et ipsum. Sadip sea amet diam dolore sed et. Sit rebum labore sit sit ut vero no sit. Et elitr stet dolor sed sit et sed ipsum et kasd ut. Erat duo eos et erat sed diam duo</p>
            <ul class="list-inline">
                <li><h5><i class="fa fa-check-double text-secondary mr-3"></i>Best In Industry</h5></li>
                <li><h5><i class="fa fa-check-double text-secondary mr-3"></i>Emergency Services</h5></li>
                <li><h5><i class="fa fa-check-double text-secondary mr-3"></i>24/7 Customer Support</h5></li>
            </ul>
           
        </div>
        <div class="col-lg-5">
            <div class="row px-3">
                <div class="col-12 p-0">
                    <img class="img-fluid w-100" src="{{ asset('web_assets/img/about-1.jpg') }}" alt="">
                </div>
                <div class="col-12 p-0">
                    <img class="img-fluid w-100" src="{{ asset('web_assets/img/about-2.jpg') }}" alt="">
                </div>
               
            </div>
        </div>
    </div>
</div>
<!-- About End -->
@endsection