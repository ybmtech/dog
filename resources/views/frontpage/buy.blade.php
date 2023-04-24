@extends('layouts.frontend',['title'=>$dog->name])

@section('content')
    
 <!-- Features Start -->
 <div class="container-fluid bg-light p-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <img class="img-fluid w-100" src="{{ asset('dog_images/'.$dog->image) }}" alt="{{ ucwords($dog->name) }}">
            </div>
            <div class="col-lg-7 py-5 py-lg-0 px-3 px-lg-5">
                <h1 class="display-4 mb-4"><span class="text-primary">{{ ucwords($dog->name) }}</span></h1>
                 <div class="row py-2">
                    <div class="col-6">
                        <div class="d-flex align-items-center mb-4">
                            
                            <h5 class="text-truncate m-0">Price:₦ {{ number_format($dog->price,2) }}</h5>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center mb-4">
                          
                            <h5 class="text-truncate m-0">Category: {{ $dog->category->name }}</h5>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            
                            <h5 class="text-truncate m-0">Age: {{ $dog->age }}</h5>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                           
                            <h5 class="text-truncate m-0">Gender: {{ $dog->gender }}</h5>
                        </div>
                    </div>
                    
                </div>
                <h4><span class="text-primary">Healthy Suppliment</span></h4>
           
                <p class="mb-4">{{ $dog->healthy }}</p>

                <h4><span class="text-primary">Medication</span></h4>
           
                <p class="mb-4">{{ $dog->medication }}</p>
                <div class="card-footer border-0 p-0">
                    <form action="{{ route('add.cart') }}" method="post">
                        @csrf
                        <input type="hidden" name="dog_id" value="{{ $dog->id }}">
                        <button type="submit" class="btn btn-primary btn-block p-3" style="border-radius: 0;">Add Cart</button>
         
                    </form>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- Features End -->
@endsection

