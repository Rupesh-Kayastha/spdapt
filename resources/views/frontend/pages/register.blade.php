@extends('frontend.layouts.master')
@section('title','User Registration')
@section('main-content') 

<section class="all-bedcrumbs-sec bedcrub-margin">
    <div class="bedcrumb-body">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a>Sign Up</a></li>
        </ul>
    </div>
</section>

<!-- Shop Login -->

<section class="returns-sec all-common-login">
    <h2>Sign Up</h2>
    <div class="returns-form">
        <h3>Create an account</h3>
        <form class="form" method="post" action="{{route('register.submit')}}">
            @csrf
            <div class="billing-details-form">
                <div class="form-group full-width-f-g">
                    <label>Name<span>*</span></label>
                    <input type="text" name="name" placeholder="" required="required" class="form-control" value="{{old('name')}}">
                    @error('name') <span class="text-danger">{{$message}}</span> @enderror </div>
                <div class="form-group full-width-f-g">
                    <label>Email<span>*</span></label>
                    <input type="text" name="email" placeholder="" required="required" class="form-control" value="{{old('email')}}">
                    @error('email') <span class="text-danger">{{$message}}</span> @enderror </div>
                <div class="form-group full-width-f-g">
                    <label> Password<span>*</span></label>
                    <input type="password" name="password" placeholder="" required="required" class="form-control" value="{{old('password')}}">
                    @error('password') <span class="text-danger">{{$message}}</span> @enderror </div>
                <div class="form-group full-width-f-g">
                    <label>Confirm Password<span>*</span></label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="" required="required" value="{{old('password_confirmation')}}">
                    @error('password_confirmation') <span class="text-danger">{{$message}}</span> @enderror </div>
                <div class="form-group full-width-f-g login-btn">
                    <button class="checkout-f-btn" type="submit">Create</button>
                    Already have an account? <a href="{{route('login.form')}}" class="btn">Login</a> </div>
            </div>
        </form>
    </div>
</section>
@endsection