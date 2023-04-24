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
@push('scripts')
<script src="{{ asset('control_assets/vendor/moment/moment.js') }}"></script>
<script>
$(document).ready(function() {
      
   

    $("#dob").on('change',function(){
         let dob=$("#dob").val();
            if(parseInt(moment().diff(dob,'months',true)) >= 12){
               
               if(parseInt(moment().diff(dob,'months',true)) % 12 ==0){
                   var age=parseInt(moment().diff(dob,'years',true)) + " years";
               }
               else if(parseInt(moment().diff(dob,'months',true)) % 12 ==1){
                   var age=parseInt(moment().diff(dob,'years',true)) + " years " + parseInt(moment().diff(dob,'months',true)) % 12 + " month";
               }
                else{
                   var age=parseInt(moment().diff(dob,'years',true)) + " years " + parseInt(moment().diff(dob,'months',true)) % 12 + " months";
            
                }
            }
           else{
              if(parseInt(moment().diff(dob,'months',true)) == 1 || parseInt(moment().diff(dob,'months',true)) == 0){
               var age=parseInt(moment().diff(dob,'months',true)) + " month";
              } 
              else{
               var age=parseInt(moment().diff(dob,'months',true)) + " months";
              }
             }
          $("#age").val(age);
     });

});
</script>


@endpush
