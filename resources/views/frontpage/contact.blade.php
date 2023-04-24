@extends('layouts.frontend',['title'=>'Contact'])

@section('content')
  <!-- Contact Start -->
  <div class="container-fluid pt-5">
    <div class="d-flex flex-column text-center mb-5 pt-5">
        <h4 class="text-secondary mb-3">Contact Us</h4>
     </div>
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 mb-5">
        <p>Tel: 08123564578</p>
        <p>Email: contact@dog.com</p>
        </div>
      
    </div>
</div>
<!-- Contact End -->
@endsection

@push('styles')
<style>
    .footer{
        position: absolute;
        bottom: 0px;
        }
 </style>
@endpush
