@extends('frontend.layouts.master')
@section('title','Login')

@section('main-content')
<section class="all-bedcrumbs-sec bedcrub-margin" style="margin: 0;">
    <div class="bedcrumb-body">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a>Login</a></li>
        </ul>
    </div>
</section>
<section class="returns-sec all-common-login">
    <h2>Login</h2>
    <div class="returns-form">
        <form class="form" method="post" action="{{route('login.submit')}}">
            @csrf
            <div class="billing-details-form">
                <div class="form-group full-width-f-g">
                    <label for="">Email<span>*</span></label>
                    <input type="email" name="email" placeholder="" required="required" class="form-control"  value="{{old('email')}}">
                    @error('email') <span class="text-danger">{{$message}}</span> @enderror </div>
                <div class="form-group full-width-f-g">
                    <label> Password<span>*</span></label>
                    <input type="password" name="password" placeholder="" required="required" class="form-control" value="{{old('password')}}">
                    @error('password') <span class="text-danger">{{$message}}</span> @enderror </div>
                <div class="form-group full-width-f-g login-btn">
                    <button class="checkout-f-btn" type="submit">Login</button>
                    Or <span>Don't have an account?</span><a href="{{route('register.form')}}" class="checkout-f-btn"> Sign Up</a> </div>
                {{-- @if (Route::has('password.request')) <a class="lost-pass" href="{{ route('password.reset') }}"> Lost your password? </a> @endif --}} </div>
        </form>
        <!--/ End Form --> 
    </div>
</section>
</section>

<!--/ End Login --> 

@endsection

@push('styles')
<style>

    .shop.login .form .btn{

        margin-right:0;

    }

    .btn-facebook{

        background:#39579A;

    }

    .btn-facebook:hover{

        background:#073088 !important;

    }

    .btn-github{

        background:#444444;

        color:white;

    }

    .btn-github:hover{

        background:black !important;

    }

    .btn-google{

        background:#ea4335;

        color:white;

    }

    .btn-google:hover{

        background:rgb(243, 26, 26) !important;

    }

</style>
@endpush