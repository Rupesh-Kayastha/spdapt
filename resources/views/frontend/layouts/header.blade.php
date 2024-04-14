@php
$settings=DB::table('settings')->get();
// $productList=DB::table('products')->where('status','active')->orderBy('id', 'desc')->get();
// $menus=DB::table('menu')->where(['status' => 1, 'sub_menu' => 0,])->orderBy('order_by', 'asc')->get();

// $currency = session('currency');
@endphp

<style>
    /* .currency {
        width: 10% !important;

    }

    .product-list .currency {
        position: absolute;
        right: 270px;
        left: inherit;
    } */

    .pages-header {
        background-color: #222529;
        z-index: 9999;
        position: sticky;
        width: 100%;
    }

    .pages-header.is-sticky {
        position: fixed;
        box-shadow: 0 5px 16px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        animation: slideDown .5s ease-out;
        margin: 0px 64px;
        
    }

    @keyframes slideDown {
        from {
            transform: translateY(-100%);
        }

        to {
            transform: translateY(0);
        }
    }

    .dropdown {
        width: 100%;
        position: relative;
        color: white;

        .label {
            color: $black;
            margin-bottom: 5px;
        }

        .select {
            cursor: pointer;
            transition: 0.3s;
            background-color: $black;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: space-between;

            .selected {
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;

                &.placeholder {
                    color: $placeholder;
                }
            }

            .caret {
                margin-left: 10px;
                width: 0;
                height: 0;
                border-left: 5px solid transparent;
                border-right: 5px solid transparent;
                border-top: 6px solid white;
                transition: 0.3s;
            }

            &:hover {
                background-color: $hover-black;
            }

        }

        .menu {
            visibility: hidden;
            background-color: $black;
            border-radius: 5px;
            overflow: hidden;
            position: absolute;
            width: 100%;
            top: 240%;
            opacity: 0;
            transition: visibility 0s, opacity 0.3s;
            z-index: 1;
            background: #FFF;
            color: #000;
            display: block;
            width: 184px;

            li {
                cursor: pointer;
                padding: 10px;

                &:hover {
                    background-color: $hover-black;
                }
            }
        }

        .menu-open {
            visibility: visible;
            opacity: 1;
        }

        .menu img {
            width: 25px;
            margin-right: 10px;
            object-fit: cover
        }
    }

    .caret-rotate {
        transform: rotate(180deg);
    }

    .active {
        background-color: $hover-black;
    }
</style>
<!--HEADER SEC-->

<header class="header-part">
    <div class="header-body">
        <div class="header-logo"> <a href="{{ route('home') }}"><img
                    src="@foreach($settings as $data) {{$data->logo}} @endforeach " class="img-fluid" alt="" /></a>
        </div>
        <div class="header-menu">
            
        </div>
        <div class="header-contact">
            <ul>
                <li class="account-login"> <a href="#" class="account-login-link"><i class="fa-regular fa-user"></i></a>
                    <div class="account-popup " style="z-index: 9999;"> @auth
                        @if(Auth::user()->role=='admin')
                        <div class="acc-details"> <a href="{{route('admin')}}"><i class="fa-regular fa-user-large"></i>
                                Welcome Admin</a> </div>
                        @else
                        <div class="acc-details"> <a href="{{route('user')}}"><i class="fa-regular fa-user-large"></i>
                                Welcome {{ Auth::user()->name }}</a> </div>
                        @endif <a href="{{route('user.logout')}}"><span class="material-symbols-outlined">logout</span>
                            Logout</a> @else
                        <div class="acc-login"> <a href="{{route('login.form')}}"><i
                                    class="fa-solid fa-right-from-bracket"></i> Login</a> <a
                                href="{{route('register.form')}}"><i class="fa-solid fa-user-plus"></i> Sign Up</a>
                        </div>
                        @endauth
                    </div>
                </li>
                <li><a href="{{route('contact')}}">Contact Us</a></li>
                {{-- <li id="google_translate_element"></li> --}}
            </ul>
            <button type="button" class="mobile-menu-btn"><i class="fa-solid fa-bars"></i></button>
        </div>
    </div>
</header>
<div id="translate"></div>
<style>
    #translate {
        margin: 0;
        padding: 0;
        position: absolute;
        top: 100px;
        z-index: 99;
        right: 60px;
    }

    #translate:before {
        position: absolute;
        content: '\f0ac';
        left: 6px;
        top: 1px;
        bottom: 0;
        margin: auto;
        font-family: "Font Awesome 6 Pro";
        font-size: 14px;
        color: #000;
        z-index: 99;
        line-height: initial;
        height: fit-content;
    }

    #translate select.goog-te-combo {
        margin: 0;
        padding: 0 9px 0 20px;
        position: relative;
        height: 34px;
        width: 160px;
        background: #ffffff;
        color: #000;
        border: 2px solid #c3c3c3;
        border-radius: 5px;
        cursor: pointer;
    }

    #translate select.goog-te-combo option {
        background: #fff;
        color: #000;
    }
</style>

<!--HEADER SEC-->