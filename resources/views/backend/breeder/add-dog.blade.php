@extends('layouts.backend',['title'=>'Dogs'])

@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1"></h2>
            <button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#smallmodal">
                
                <i class="zmdi zmdi-plus"></i>Add Dog</button>
        </div>
    </div>
</div>
  {{-- user data --}}
  <div class="row m-t-25">
    <div class="col-sm-12">
        <div class="table-responsive table--no-card m-b-30">
            <table class="table table-borderless table-striped table-earning" id="example">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Health Status</th>
                        <th>Pet Id</th>
                        <th>ACTION</th>
                      </tr>
                </thead>
                <tbody>
                    @forelse ($dogs as $dog)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('dog_images/'.$dog->image) }}" alt="{{ $dog->name }}" style="width:150px; height:100px"></td>
                        <td>{{ ucwords($dog->name) }}</td>
                        <td>{{ ucwords($dog->category->name) }}</td>
                        <td>₦{{ number_format($dog->price,2) }}</td>
                        <td>{{ ucwords($dog->gender) }}</td>
                        <td>{{ $dog->age }}</td>
                        <td>{{ $dog->health_status=="yes" ? "Healthy" : "Not Healthy" }}</td>
                        <td>{{ $dog->petid }}</td>
                        <td>
                            <a href="{{ route('dog.show',str_shuffle('0123456789').$dog->id) }}" class="btn btn-warning">Edit</a>
                            <button class="btn btn-danger deleterow" id="{{ $dog->id }}">Delete</button>
                        </td>
                      </tr> 
                    @empty
                        
                    @endforelse
                </tbody>
            </table>
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
      
    $('#example').DataTable();
    
    $("body").on('click','.deleterow', function(e) {
      $("#deletemodal").modal('show');
        let id = $(this).attr('id');
        $('#id').val(id);
    
    });

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
@push('modal')
    <!-- add -->
    <div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="mediumModalLabel">Add Dog</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							                <form action="{{ route('dog.store') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="name" class="control-label mb-1">Name</label>
                                                    <input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}">
                                                    @error('name')
                                               <span class="text-danger">{{ $message }}</span>
                                                       @enderror
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="price" class="control-label mb-1">Price</label>
                                                            <input id="price" name="price" type="text" class="form-control" value="{{old('price')  }}">
                                                            @error('price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="petid" class="control-label mb-1">Pet Id(from vetinary doctor)</label>
                                                            <input id="petid" name="petid" type="text" class="form-control" value="{{old('pet_id')  }}">
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
                                                                <option value="" selected disabled>Select</option>
                                                                @forelse ($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>    
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
                                                                <option value="" selected disabled>Select</option>
                                                                <option value="male" {{ old('gender')=="male" ? "selected" : "" }}>Male</option>
                                                                <option value="female" {{ old('gender')=="female" ? "selected" : "" }}>Female</option>
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
                                                            <input id="dob" name="dob" type="date" class="form-control" value="{{ old('dob') }}">
                                                            @error('dob')
                                                            <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="age" class="control-label mb-1">Age</label>
                                                            <input id="age" name="age" type="text" class="form-control" readonly value="{{ old('age') }}">
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
                                                                <option value="" selected disabled>Select</option>
                                                                <option value="yes" {{ old('health_status')=="yes" ? "selected" : "" }}>Healthy</option>
                                                                <option value="no" {{ old('health_status')=="no" ? "selected" : "" }}>Not Heathy</option>
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
                                                            <textarea id="healthy" name="healthy" class="form-control">{{ old('healthy') }}</textarea>
                                                            @error('healthy')
                                                            <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="medication" class="control-label mb-1">Medication</label>
                                                            <textarea id="medication" name="medication" class="form-control">{{ old('medication') }}</textarea>
                                                            @error('medication')
                                                            <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                        
                                
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Add</button>
                        </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						
						</div>
					</div>
				</div>
			</div>

            {{-- end add --}}
            <!-- begin delete modal -->
			<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="deletemodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="deletemodalLabel">Delete Dog</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>
								Are you sure you want to delete this dog
							</p>
						</div>
						<div class="modal-footer">
                            <form method="POST" action="{{ route('dog.delete') }}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-primary">Yes</button>
                            </form>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
							
						</div>
					</div>
				</div>
			</div>
			<!-- end delete modal  -->
           
                
@endpush

