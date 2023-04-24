@extends('layouts.backend',['title'=>'User'])

@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1"></h2>
            <button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#smallmodal">
                
                <i class="zmdi zmdi-plus"></i>Add User</button>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>ACTION</th>
                      </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucwords($user->name) }}</td>
                        <td>{{ $user->email }}</td>
                         <td>{{ $user->phone }}</td>
                         <td>{{ ucwords($user->roles[0]->name) }}</td>
                         <td>
                            <a href="{{ route('user.show',str_shuffle('0123456789').$user->id) }}" class="btn btn-warning">Edit</a>
                            <button class="btn btn-danger deleterow" id="{{ $user->id }}">Delete</button>
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
<script>
$(document).ready(function() {
      
    $('#example').DataTable();
    
    $("body").on('click','.deleterow', function(e) {
      $("#deletemodal").modal('show');
        let id = $(this).attr('id');
        $('#id').val(id);
    
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
							<h5 class="modal-title" id="mediumModalLabel">Add User</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							                <form action="{{ route('user.store') }}" method="post">
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
                                                            <label for="email" class="control-label mb-1">Email</label>
                                                            <input id="email" name="email" type="email" class="form-control" value="{{old('email')  }}">
                                                            @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="phone" class="control-label mb-1">Phone</label>
                                                            <input id="phone" name="phone" type="text" class="form-control" value="{{old('phone')  }}">
                                                            @error('phone')
                                                            <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group has-success">
                                                    <label for="user_type" class="control-label mb-1">Role</label>
                                                    <select id="user_type" name="user_type"  class="form-control">
                                                        <option value="" selected disabled>Select</option>
                                                        @forelse ($roles as $role)
                                                        <option value="{{ $role->name }}">{{ ucwords($role->name) }}</option>    
                                                        @empty
                                                            
                                                        @endforelse
                                                    </select>
                                                @error('user_type')
                                               <span class="text-danger">{{ $message }}</span>
                                                       @enderror
                                                       </div>

                                                       <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="password" class="control-label mb-1">Password</label>
                                                                <input id="password" name="password" type="password" class="form-control">
                                                                @error('password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="password_confirmation" class="control-label mb-1">Phone</label>
                                                                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control">
                                                                @error('password_confirmation')
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
							<h5 class="modal-title" id="deletemodalLabel">Delete User</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>
								Are you sure you want to delete this user
							</p>
						</div>
						<div class="modal-footer">
                            <form method="POST" action="{{ route('user.delete') }}">
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

