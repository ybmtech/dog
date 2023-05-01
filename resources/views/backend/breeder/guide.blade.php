@extends('layouts.backend',['title'=>'Breeding Guide'])

@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Guide on how to breed dog</h2>
           
        </div>
    </div>
</div>
  {{-- user data --}}
  <div class="row m-t-25">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
    <embed width="100%" height="900px" src="{{ asset('pdf/guide_to_dog_breeding.pdf') }}">
  </div>
    </div>
    </div>
        <!-- END USER DATA-->
    </div>
  </div>
@endsection
