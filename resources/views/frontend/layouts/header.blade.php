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
            <ul>
                {{-- @foreach ($menus as $menu)
                @php $submenus = Helper::subMenus($menu->id); @endphp
                @if ($submenus->isNotEmpty())
                <li class="product-list"><a href="{{ $menu->url }}">{{ $menu->name }}</a>
                    <div class="product-menu">
                        <div class="product-menu-left">
                            @foreach ($submenus as $submenu)
                                <a href="{{ $submenu->url }}"><i class="fa-regular fa-golf-club"></i>{{ $submenu->name }}</a>
                            @endforeach
                        </div>
                        <div class="product-menu-right">
                            <img src="{{asset('/frontend/images/menu-img.jpg')}}" alt="">
                        </div>
                    </div>
                    <button type="button" class="mob-btn"><i class="fa-regular fa-circle-chevron-down"></i></button>
                </li>
                @else
                <li><a href="{{ $menu->url }}">{{ $menu->name }}</a></li>
                @endif
                @endforeach --}}
                {{-- <li>
                    <div class='dropdown'>
                        <div class='select'>
                            <div class='selected placeholder'>USD</div>
                            <div class='caret'></div>
                        </div>
                        <ul class='menu'>
                            <li onclick="setCurrency('USD')"><img
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAgBAMAAACm+uYvAAAAD1BMVEUAJWq0vtO1v9PBASv////7AfyZAAAAOUlEQVQoz2NgQALGSIABt4QSHDK4IAEGBkU4RJMg3Q4kS9CMQlhCqR3DxB8uOABuCWMcALfEiLUDADkOhlU5rxL6AAAAAElFTkSuQmCC" />USD
                            </li>
                            <li onclick="setCurrency('EUR')"><img
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAgAgMAAAApuhOPAAAACVBMVEUAU6eApFP/9ABWIW2TAAAAQ0lEQVQY02NgoD5gdEDisE1AsEXYJojAOZmMDpkIDhjBlIERMbbAbQLZArcJhYOiDA9AsRTFOSgORfECiueIsoVkAACg9AqhFj835AAAAABJRU5ErkJggg==" />EUR
                            </li>
                            <li onclick="setCurrency('GBP')"><img
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAgCAMAAABjCgsuAAAAyVBMVEUAIH8BIH8CIYAHJoIOLIYPLYYZNYsaNowfO44nQpI3UJo4UJtLYaRhdK9idbBmebJnerJoerN4iLt5ibuQncenstK7w9y8xN29xd3P1ebRDSTe4u7fMh3fNiHgOyfgPCjhQi/hRDHjTjzlW0rlW0vnalvna1vpdWfpdmjpe27qfG/qjYTqj4bqoJnq7PTropvrs7DrtLHrurfrurjr7fTsxcTsxcXu1NXx4ePy8/j06+309fn17e/49PX49Pb7+vv7+/z+/v7///8ZBiYZAAABQklEQVQ4y82U2U4CURBEW3ABRR2VdShkQFTcFUQYQIH6/4/ywbm5KwYeTKzHSarOTU9XC4D+nGkkhsg4jmNSfzmoc/XSAi5fpQ8gGZLVwi+G0jOnNwCuJhQOEg/iGPJl8qMD4GHBhqSc37oQ21BscPEIoDMiy3kp1KghpwHD8YyTHoDrKd9LIiJy5kEMw26FfGsDracV6/vZCzyINhw2+XUPoDvm8iKnx+JAlCF3vuS4C+Duk80jc/BSqBqQSBlqavhkZU8cRQoyIJXhZ/i9CWcn4suEZIaRGn5RQtqJUs77ABJl0MO39iak7EkBbW+It9R/NPz9lJztsH5cEiq8tRpDezX8LobizeULFd6P1+sdpesgZrxRIKcma+LtTocgTrxzNTxIiGrfJSfQi/cvn5W5yam0IOLFB6+3hshm514X/hucN8Af5X8PRgAAAABJRU5ErkJggg==" />GBP
                            </li>
                            <li onclick="setCurrency('CAD')"><img
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAgCAMAAABjCgsuAAAAVFBMVEX/AAD/AwP/BQX/CQn/R0f/Skr/S0v/Tk7/cHD/cXH/hYX/lJT/q6v/r6//srL/t7f/xMT/zc3/zs7/z8//0ND/1dX/1tb/2Nj/29v/5ub/9/f////rrEQTAAAAbklEQVQ4y+3Ttw6AMAxF0QsJvRMI7f//kwExICFkjwje5uEMbnDJdhOe8oO3g7bVgSGKBxWwYOVgWasUsmpdhKAITAKJCQohqM+qFoIyPIqwlDbdGADTyKeUA+SKsXrXd86rNj3NytNw4/9AHwc7pig+ByeVQt0AAAAASUVORK5CYII=" />CAD
                            </li>
                        </ul>
                    </div>

                </li> --}}
                {{-- <li id="translate" class="avijit"></li> --}}

            </ul>
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
{{-- <div id="translate"></div> --}}
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