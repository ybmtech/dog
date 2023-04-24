@extends('layouts.auth',['title'=>'Reset Password'])

@section('content')

<div class="login-form">
    <h4 class="text-center">RESET PASSWORD</h4>
    <form method="post" action="{{ route('password.store') }}">
        @csrf
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
            @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input class="au-input au-input--full" type="password" name="password_confirmation" placeholder="Confirm Password">
            @error('password_confirmation')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <input type="hidden" name="email" value="{{ old('email', $request->email) }}">
       
        <button type="submit" class="au-btn au-btn--block au-btn--blue m-b-20" type="submit">Reset Password</button>
       
    </form>
    
</div>
    
@endsection