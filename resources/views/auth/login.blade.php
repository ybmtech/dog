@extends('layouts.auth',['title'=>'Login'])

@section('content')

<div class="login-form">
    @if (Session::has('status'))
    <div class="alert alert-primary alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{Session::get('status')}}
    </div>
    @endif
    <form method="post" action="{{ route('login.store') }}">
        @csrf
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
            @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        <div class="login-checkbox">
            <label>
                <input type="checkbox" name="remember">Remember Me
            </label>
            <label>
                <a href="{{ route('password.request') }}">Forgotten Password?</a>
            </label>
        </div>
        <button type="submit" class="au-btn au-btn--block au-btn--blue m-b-20" type="submit">sign in</button>
       
    </form>
    <div class="register-link">
        <p>
            Don't you have account?
            <a href="{{ route('register') }}">Sign Up Here</a>
        </p>
    </div>
</div>
    
@endsection