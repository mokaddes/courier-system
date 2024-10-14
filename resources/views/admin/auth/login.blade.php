<!DOCTYPE html>
<html lang="{{ app()->getLocale() ?? 'en' }}">
    <head>
        @php
            $settings = getSetting();
        @endphp
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ Route::is('login.deliveryman') ? __('Deliveryman Login') : __('Admin Login') }} - {{ $settings->site_name }}</title>
        <link rel="shortcut icon" href="{{ asset($settings->favicon) }}" type="image/x-icon">
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
            rel="stylesheet">
        <link
            href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">
        <!-- css -->
        <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet"
            href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('backend/css/main.css') }}" />
        <link rel="stylesheet" href="{{ asset('backend/css/responsive.css') }}" />
        <link rel="stylesheet" href="{{asset('massage/toastr/toastr.css')}}">
        <style>
            .signin_form {
                background: #fff !important;
                border: 1px solid #DDD;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 90%;
                max-width: 450px;
            }

            .btn-primary {
                height: 49px;
                border-radius: 2px;
                font-size: 16px;
                font-family: 'Raleway', sans-serif;
                font-weight: bold;
                text-transform: uppercase;
            }

            .form-label {
                font-size: 13px;
                font-family: 'Roboto', sans-serif;
                font-weight: 500;
            }

            .form-control {
                height: 50px;
                border: 1px solid #EEE;
                font-size: 14px;
                font-family: 'Raleway', sans-serif;
                font-weight: 500;
                outline: none !important;
                box-shadow: none !important;
            }

            .form-control::placeholder {
                color: #BBB;
            }
        </style>
    </head>
    <body style="background-color: #ebedf4;">
        <!--  SignIn  -->
        <div class="signin_sec">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6 col-lg-5 col-xl-5">
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <input type="hidden" name="auth_type" value="{{ Route::is('login.deliveryman') ? 'deliveryman' : 'admin' }}">
                            <div class="signin_form p-3  p-md-5 bg-white">
                                <div class="mb-5 text-center">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset($settings->site_logo) }}" width="150" alt="logo">
                                    </a>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ Route::is('login.deliveryman') ? 'Deliveryman Email' : 'Admin Email' }}</label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="Enter your email" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ Route::is('login.deliveryman') ? 'Deliveryman Password' : 'Admin Password' }}</label>
                                    <input type="password" name="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Enter your password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary w-100">{{ __('Sign In') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- js file -->
        <script src="{{ asset('backend/js/jquery.min.js') }}"></script>
        <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{ asset('backend/js/main.js') }}"></script>
        <script src="{{asset('massage/toastr/toastr.js')}}"></script>
        {!! Toastr::message() !!}
        <script>
            @if($errors->any())
            @foreach($errors->all() as $error)
            toastr.error('{{ $error }}','Error',{
                closeButton:true,
                progressBar:true,
            });
            @endforeach
            @endif
        </script>
    </body>
</html>
