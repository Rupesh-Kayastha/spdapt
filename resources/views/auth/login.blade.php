@php
$settings=DB::table('settings')->get();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Morsh Golf 2 Wood || Admin Login</title>
  @include('backend.layouts.head')

</head>
<body class="bg-gradient-primary">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9 mt-5">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
              <div class="col-lg-6 text-left">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"><img src="@foreach($settings as $data) {{ url('/public/product/') }}/{{$data->logo}} @endforeach" alt="Admin Logo" height="100" width="100" title="SPDAPT"></h1>
                  </div>
                  <form class="user"  method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..."  required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Password"  name="password" required autocomplete="current-password">
                         @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>
                  <hr>
                   
                  <div class="text-center">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link small" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <img src="https://img.freepik.com/free-vector/sign-concept-illustration_114360-5425.jpg?w=740&t=st=1687956872~exp=1687957472~hmac=a304c351f74d56e38d73a86d6b972ec67853929cf9e8e98e527d9edd06715407" style="flex: 0 0 50%;
                max-width: 100%;">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
