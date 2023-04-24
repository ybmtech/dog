@extends('layouts.auth',['title'=>'Register'])

@section('content')

<div class="login-form">
    <form  method="POST" action="{{ route('user.register') }}">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input class="au-input au-input--full" type="text" name="name" id="name" placeholder="Full Name" value="{{ old('name') }}">
            @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input class="au-input au-input--full is-number" type="text" name="phone" id="phone" placeholder="080XXXXXXXX" maxlength="12"  value="{{ old('phone') }}">
            @error('phone')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
            @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>

        <div class="form-group">
            <label>Type</label>
            <select class="au-input au-input--full" name="user_type" id="user_type">
                <option value="" selected disabled>Select</option>
                <option value="client">Client</option>
                <option value="breeder">Breeder</option>
                
            </select>
            @error('user_type')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>

       
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" id="password" placeholder="Password">
            @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input class="au-input au-input--full" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
            @error('password_confirmation')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
      
        <button type="submit" class="au-btn au-btn--block au-btn--blue m-b-20" type="submit">Sign Up</button>
       
    </form>
    <div class="register-link">
        <p>
            Already have an account?
            <a href="{{ route('login') }}">Sign In</a>
        </p>
    </div>
</div>
    
@endsection