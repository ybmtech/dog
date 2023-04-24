@extends('layouts.auth',['title'=>'Forgot Password'])

@section('content')

<div class="login-form">
    @if (Session::has('status'))
    <div class="alert alert-primary alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{Session::get('status')}}
    </div>
    @endif
    <h4 class="text-center">FORGOT PASSWORD</h4>
    <form method="post" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
            @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
       
       
        <button type="submit" class="au-btn au-btn--block au-btn--blue m-b-20" type="submit">Send Password Reset Link</button>
       
    </form>
    <div class="register-link">
        <p>
            
            <a href="{{ route('login') }}">Sign In</a>
        </p>
    </div>
</div>
    
@endsection