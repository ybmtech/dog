@extends('layouts.backend',['title'=>'Edit Category'])

@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Edit Category</h2>
           
        </div>
    </div>
</div>
  {{-- user data --}}
  <div class="row m-t-25">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('category.edit') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="control-label mb-1">Name</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ $category->name }}">
                        @error('name')
                   <span class="text-danger">{{ $message }}</span>
                           @enderror
                    </div>
                    

                         
</div>
<div class="modal-footer">
    <input type="hidden" name="id" value="{{ $category->id }}">
<button type="submit" class="btn btn-primary">Update</button>
</form>
  </div>
    </div>
    </div>
        <!-- END USER DATA-->
    </div>
  </div>
@endsection

