@extends('layouts.backend',['title'=>'Breeding'])

@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Breeding</h2>
           
        </div>
    </div>
</div>
  {{-- brreding data --}}
  <div class="row m-t-25">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
              <h2 class="text-center">My Male And Other Female Dog Breeding</h2>
         
              <form class="form-horizontal" role="form" action="{{ route('breed') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label class="control-label col-sm-2" for="my_male">Male</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="mine" id="my_male" required>
                      <option value="" selected disabled>Select</option>
                      @forelse ($males as $male)
                      <option value="{{ $male->id }}" data-image="{{ $male->image }}">{{ ucwords($male->name) }}</option> 
                      @empty
                          
                      @endforelse
                    </select>
                  </div>
                  <img src="" width="30%" id="my_male_image" >
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="o_female">Female</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="other" id="o_female" required>
                      <option value="" selected disabled>Select</option>
                      @forelse ($other_females as $female)
                      <option value="{{ $female->id }}" data-image="{{ $female->image }}">{{ ucwords($female->name) }}</option> 
                      @empty
                          
                      @endforelse
                    </select>
                   </div>
                   <img src="" width="30%" id="o_female_image" >
              
                </div>
                
                <div class="form-group">
                  <label class="control-label col-sm-2" for="reward">Reward</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="reward" id="reward" required>
                      <option value="" selected disabled>Select</option>
                      <option value="puppy">Puppy</option> 
                      <option value="payment">Payment</option> 
                      </select>
                   </div>
              
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Breed</button>
                  </div>
                </div>
              </form>
            
  
            </div>
          </div>
    </div>
        
    </div>
    {{-- end breeding --}}
      {{-- brreding data --}}
  <div class="row m-t-25">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
              <h2 class="text-center">My Female And Other Male Dog Breeding</h2>
         
              <form class="form-horizontal" role="form" action="{{ route('breed') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label class="control-label col-sm-2" for="my_male2">Male</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="other" id="my_male2" required>
                      <option value="" selected disabled>Select</option>
                      @forelse ($other_males as $male)
                      <option value="{{ $male->id }}" data-image="{{ $male->image }}">{{ ucwords($male->name) }}</option> 
                      @empty
                          
                      @endforelse
                    </select>
                  </div>
                  <img src="" width="30%" id="my_male_image2" >
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="o_female2">Female</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="mine" id="o_female2" required>
                      <option value="" selected disabled>Select</option>
                      @forelse ($females as $female)
                      <option value="{{ $female->id }}" data-image="{{ $female->image }}">{{ ucwords($female->name) }}</option> 
                      @empty
                          
                      @endforelse
                    </select>
                   </div>
                   <img src="" width="30%" id="o_female_image2" >
              
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2" for="reward">Reward</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="reward" id="reward" required>
                      <option value="" selected disabled>Select</option>
                      <option value="puppy">Puppy</option> 
                      <option value="payment">Payment</option> 
                      </select>
                   </div>
              
                </div>
                
         
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Breed</button>
                  </div>
                </div>
              </form>
            
  
            </div>
          </div>
    </div>
        
    </div>
    {{-- end breeding --}}
  </div>
@endsection
@push('scripts')
<script>
$(document).ready(function() {
      $("#my_male_image").hide();
      $("#my_male_image2").hide();
      $("#o_female_image").hide();
      $("#o_female_image2").hide();

    $("#my_male").on('change', function(e) {
        let image = $(this).children("option:selected").data('image');
        let image_path="{{ asset('dog_images/') }}";
        $("#my_male_image").show();
        $("#my_male_image").attr('src',image_path+"/"+image);
    
    });

    $("#o_female").on('change', function(e) {
        let image = $(this).children("option:selected").data('image');
        let image_path="{{ asset('dog_images/') }}";
        $("#o_female_image").show();
        $("#o_female_image").attr('src',image_path+"/"+image);
    
    });


    $("#my_male2").on('change', function(e) {
        let image = $(this).children("option:selected").data('image');
        let image_path="{{ asset('dog_images/') }}";
        $("#my_male_image2").show();
        $("#my_male_image2").attr('src',image_path+"/"+image);
    
    });

    $("#o_female2").on('change', function(e) {
        let image = $(this).children("option:selected").data('image');
        let image_path="{{ asset('dog_images/') }}";
        $("#o_female_image2").show();
        $("#o_female_image2").attr('src',image_path+"/"+image);
    
    });


});
</script>


@endpush