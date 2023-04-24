@extends('layouts.backend',['title'=>'Edit Dog Record'])

@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Edit Dog Record</h2>
           
        </div>
    </div>
</div>
  {{-- user data --}}
  <div class="row m-t-25">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
        <form action="{{ route('dog.edit') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name" class="control-label mb-1">Name</label>
                <input id="name" name="name" type="text" class="form-control" value="{{ $dog->name }}">
                @error('name')
           <span class="text-danger">{{ $message }}</span>
                   @enderror
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="price" class="control-label mb-1">Price</label>
                        <input id="price" name="price" type="text" class="form-control" value="{{$dog->price  }}">
                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="petid" class="control-label mb-1">Pet Id(from vetinary doctor)</label>
                        <input id="petid" name="petid" type="text" class="form-control" value="{{$dog->petid  }}">
                        @error('petid')
                        <span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>
                </div>
            </div>
           
            <div class="row">
                <div class="col-6">
                    <div class="form-group has-success">
                        <label for="category_id" class="control-label mb-1">Category</label>
                        <select id="category_id" name="category_id"  class="form-control">
                            @forelse ($categories as $category)
                            <option value="{{ $category->id }}" {{ $dog->category_id==$category->id ? "selected" : ""  }}>{{ $category->name }}</option>    
                            @empty
                                
                            @endforelse
                        </select>
                    @error('category_id')
                   <span class="text-danger">{{ $message }}</span>
                           @enderror
                           </div>
                </div>
                <div class="col-6">
                    <div class="form-group has-success">
                        <label for="gender" class="control-label mb-1">Gender</label>
                        <select id="gender" name="gender"  class="form-control">
                            <option value="male" {{ $dog->gender=="male" ? "selected" : "" }}>Male</option>
                            <option value="female" {{ $dog->gender=="female" ? "selected" : "" }}>Female</option>
                        </select>
                    @error('gender')
                   <span class="text-danger">{{ $message }}</span>
                           @enderror
                           </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="dob" class="control-label mb-1">Date of Birth</label>
                        <input id="dob" name="dob" type="date" class="form-control" value="{{ $dog->dob }}">
                        @error('dob')
                        <span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="age" class="control-label mb-1">Age</label>
                        <input id="age" name="age" type="text" class="form-control" readonly value="{{ $dog->age }}">
                        @error('age')
                        <span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>
                </div>
            </div>
          
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="image" class="control-label mb-1">Image</label>
                        <input id="image" name="image" type="file" class="form-control">
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group has-success">
                        <label for="health_status" class="control-label mb-1">Health Status</label>
                        <select id="health_status" name="health_status"  class="form-control">
                            <option value="yes" {{ $dog->health_status=="yes" ? "selected" : "" }}>Healthy</option>
                            <option value="no" {{ $dog->health_status=="no" ? "selected" : "" }}>Not Heathy</option>
                        </select>
                    @error('health_status')
                   <span class="text-danger">{{ $message }}</span>
                           @enderror
                           </div>
                </div>
            </div>
           
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="healthy" class="control-label mb-1">Healthy Suppliment</label>
                        <textarea id="healthy" name="healthy" class="form-control">{{ $dog->healthy }}</textarea>
                        @error('healthy')
                        <span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="medication" class="control-label mb-1">Medication</label>
                        <textarea id="medication" name="medication" class="form-control">{{ $dog->medication }}</textarea>
                        @error('medication')
                        <span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>
                </div>
            </div>
    

</div>
<div class="modal-footer">
    <input type="hidden" name="id" value="{{ $dog->id }}">
<button type="submit" class="btn btn-primary">Update</button>
</form>
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
