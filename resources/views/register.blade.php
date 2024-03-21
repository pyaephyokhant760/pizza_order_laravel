@extends('layouts.master')

@section('content')
<div class="login-form mb-5">
    <form action="{{ route('register')}}" method="post">
        @csrf

        @error('terms')
            <small class="text-danger">{{ $message}}</small>
        @enderror
        <div class="form-group">
            <label>Username</label>
            <input class="au-input au-input--full" type="text" name="name" placeholder="Username">
            @error('name')
            <small class="text-danger">{{ $message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
            @error('email')
            <small class="text-danger">{{ $message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input class="au-input au-input--full" type="number" name="phone" placeholder="09xxxxx">
            @error('phone')
            <small class="text-danger">{{ $message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Phone</label>
            <select name="gender" class="form-control">
                <option value="">Choose Gender  . . . .</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            @error('gender')
            <small class="text-danger">{{ $message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Address</label>
            <input class="au-input au-input--full" type="text" name="address" placeholder="City Name">
            @error('address')
            <small class="text-danger">{{ $message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
            @error('password')
            <small class="text-danger">{{ $message}}</small>
            @enderror
        </div>
        <div>
            <label>Confirm Password</label>
            <input type="text" name="password_confirmation" class="form-control">
            @error('password_confirmation')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="login-checkbox">
            <label>
                <input type="checkbox" name="aggree">Agree the terms and policy
            </label>
        </div>
        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>
        <div class="social-login-content">
            <div class="social-button">
                <button class="au-btn au-btn--block au-btn--blue m-b-20">register with facebook</button>
                <button class="au-btn au-btn--block au-btn--blue2">register with twitter</button>
            </div>
        </div>
    </form>
    <div class="register-link mb-5">
        <p>
            Already have account?
            <a href="{{ route('login#page')}}">Sign In</a>
        </p>
    </div>
</div>
@endsection

