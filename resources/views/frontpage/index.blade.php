@extends('layouts.frontend',['title'=>'Home'])

@section('content')
    
<!-- Carousel Start -->
<div class="container-fluid p-0">
    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="{{ asset('web_assets/img/HomeDesktopSlide0.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h3 class="text-white mb-3 d-none d-sm-block">Best Pet Services</h3>
                        <h1 class="display-3 text-white mb-3">Keep Your Pet Happy</h1>
                        <h5 class="text-white mb-3 d-none d-sm-block">Duo nonumy et dolor tempor no et. Diam sit diam sit diam erat</h5>
                        </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="{{ asset('web_assets/img/HomeDesktopSlide1.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h3 class="text-white mb-3 d-none d-sm-block">Best Pet Services</h3>
                        <h1 class="display-3 text-white mb-3">Pet Spa & Grooming</h1>
                        <h5 class="text-white mb-3 d-none d-sm-block">Duo nonumy et dolor tempor no et. Diam sit diam sit diam erat</h5>
                        </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="{{ asset('web_assets/img/HomeDesktopSlide2.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h3 class="text-white mb-3 d-none d-sm-block">Best Pet Services</h3>
                        <h1 class="display-3 text-white mb-3">Pet Spa & Grooming</h1>
                        <h5 class="text-white mb-3 d-none d-sm-block">Duo nonumy et dolor tempor no et. Diam sit diam sit diam erat</h5>
                      </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-primary rounded" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-primary rounded" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    </div>
</div>
<!-- Carousel End -->


<!-- healthy dog Start -->
<div class="container-fluid bg-light pt-5 pb-4">
    <div class="container py-5">
        <div class="d-flex flex-column text-center mb-5">
            <h4 class="text-secondary mb-3">Healthy Dogs</h4>
         </div>
        <div class="row">
            @forelse ($dogs as $dog)
                
            <div class="col-lg-4 mb-4">
                <div class="card border-0">
                    <div class="card-header position-relative border-0 p-0 mb-4">
                        <img class="card-img-top" src="{{ asset('dog_images/'.$dog->image) }}" alt="{{ ucwords($dog->name) }}" width="30%" height="200px">
                        <div class="position-absolute d-flex flex-column align-items-center justify-content-center w-100 h-100" style="top: 0; left: 0; z-index: 1; background: rgba(0, 0, 0, .5);">
                            <h3 class="text-primary mb-3">{{ ucwords($dog->name) }}</h3>
                            <h1 class="display-4 text-white mb-0">
                                <small class="align-top" style="font-size: 22px; line-height: 45px;">₦</small>{{ number_format($dog->price,2) }}<small class="align-bottom" style="font-size: 16px; line-height: 40px;"></small>
                            </h1>
                        </div>
                    </div>
                    <div class="card-body text-center p-0">
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item p-2"><i class="fa fa-check text-secondary mr-2"></i>Category: {{ ucwords($dog->category->name) }}</li>
                            <li class="list-group-item p-2"><i class="fa fa-check text-secondary mr-2"></i>Age: {{ $dog->age }}</li>
                            <li class="list-group-item p-2"><i class="fa fa-check text-secondary mr-2"></i>Gender: {{ $dog->gender }}</li>
                          </ul>
                    </div>
                    <div class="card-footer border-0 p-0">
                        <a href="{{ route('buy',str_shuffle('0123456789').$dog->id) }}" class="btn btn-primary btn-block p-3" style="border-radius: 0;">Buy</a>
                    </div>
                </div>
            </div>

            @empty
                
            @endforelse
           
        </div>
    </div>
</div>
<!-- healthy dog End -->
@endsection