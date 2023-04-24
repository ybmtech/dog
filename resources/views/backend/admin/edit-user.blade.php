@extends('layouts.backend',['title'=>'Edit User Record'])

@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Edit User Record</h2>
           
        </div>
    </div>
</div>
  {{-- user data --}}
  <div class="row m-t-25">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('user.edit') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="control-label mb-1">Name</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ $user->name }}">
                        @error('name')
                   <span class="text-danger">{{ $message }}</span>
                           @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email" class="control-label mb-1">Email</label>
                                <input id="email" name="email" type="email" class="form-control" value="{{ $user->email  }}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                        @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone" class="control-label mb-1">Phone</label>
                                <input id="phone" name="phone" type="text" class="form-control" value="{{$user->phone  }}">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                        @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group has-success">
                        <label for="user_type" class="control-label mb-1">Role</label>
                        <select id="user_type" name="user_type"  class="form-control">
                            @forelse ($roles as $role)
                            <option value="{{ $role->name }}" {{ $user->roles[0]->name==$role->name ? "selected" : "" }}>{{ ucwords($role->name) }}</option>    
                            @empty
                                
                            @endforelse
                        </select>
                    @error('user_type')
                   <span class="text-danger">{{ $message }}</span>
                           @enderror
                           </div>

                         
</div>
<div class="modal-footer">
    <input type="hidden" name="id" value="{{ $user->id }}">
<button type="submit" class="btn btn-primary">Update</button>
</form>
  </div>
    </div>
    </div>
        <!-- END USER DATA-->
    </div>
  </div>
@endsection

