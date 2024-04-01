@php

$settings=DB::table('settings')->get();

@endphp 

<!--HEADER SEC-->

<header class="header-part">
    <div class="header-body">
        <div class="header-logo"> <a href="{{ route('home') }}"><img src="@foreach($settings as $data) {{$data->logo}} @endforeach " class="img-fluid" alt="" /></a> </div>
        <div class="header-menu">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('fairway-wood') }}">Fairway Wood</a></li>
                <li><a href="{{ route('golf-balls') }}">Golf Balls</a></li>
                <li><a href="{{ route('story') }}">Our Story</a></li>
                <li><a href="#">Blogs</a></li>
                <li><a href="#">PR and Media</a></li>
            </ul>
        </div>
        <div class="header-contact">
            <ul>
                <li><a href="{{route('cart')}}"><span class="material-symbols-outlined">shopping_bag</span>
                    <div class="cart-num"> @if(Helper::cartCount()>0){{Helper::cartCount()}}@endif </div>
                    </a></li>
                <li class="account-login"> <a href="#" class="account-login-link"><span class="material-symbols-outlined">account_circle</span></a>
                    <div class="account-popup "> @auth 
                        
                        @if(Auth::user()->role=='admin')
                        <div class="acc-details"> <a href="{{route('admin')}}"><span class="material-symbols-outlined">account_box</span> Welcome Admin</a> </div>
                        @else
                        <div class="acc-details"> <a href="{{route('user')}}"><span class="material-symbols-outlined">account_box</span> Welcome {{ Auth::user()->name }}</a> </div>
                        @endif <a href="{{route('user.logout')}}"><span class="material-symbols-outlined">logout</span> Logout</a> @else
                        <div class="acc-login"> <a href="{{route('login.form')}}"><span class="material-symbols-outlined">login</span> Login</a> <a href="{{route('register.form')}}"><span class="material-symbols-outlined">person_add</span> Sign Up</a> </div>
                        @endauth </div>
                </li>
                <li><a href="#">Contact Us</a></li>
            </ul>
            <button type="button" class="mobile-menu-btn"><i class="fa-solid fa-bars"></i></button>
        </div>
    </div>
</header>

<!--HEADER SEC--> 