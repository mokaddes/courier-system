<!DOCTYPE html>
<html lang="en">
    <head>
        @php
            $setting = App\Models\Setting::first();
        @endphp
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#ffffff">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset($setting->favicon) }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset($setting->favicon) }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset($setting->favicon) }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset($setting->favicon) }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset($setting->favicon) }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset($setting->favicon) }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset($setting->favicon) }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset($setting->favicon) }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset($setting->favicon) }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset($setting->favicon) }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset($setting->favicon) }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset($setting->favicon) }}">
        <title>@yield('title') - {{ $setting->site_name }}</title>
        <!-- favicon -->
        <link rel="shortcut icon" href="{{ asset($setting->favicon) }}" type="image/x-icon">
        {{-- meta  --}}
        @stack('meta')
        {{-- style  --}}
        @include('frontend.layouts.head')
        {{-- toastr  --}}
        <link rel="stylesheet" href="{{asset('massage/toastr/toastr.css')}}">
        {{-- custom style  --}}
        @stack('css')
    </head>
    <body>
        {{-- header start  --}}
        <header class="header-section sticky-top">
            @include('frontend.layouts.header')
        </header>
        {{-- content --}}
        @yield('content')
        {{-- footer  --}}
        <footer class="footer-section pb-4 pt-4">
            @include('frontend.layouts.footer')
        </footer>
        <!-- js -->
        @include('frontend.layouts.foot')
        {{-- toastr --}}
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
       <script>
            $(document).ready(function () {
            // Add event listener for form submissions
            $(document).on('submit', 'form', function () {
                let submitButton = $(this).find(':submit');
                submitButton.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
                // Disable the submit button and add the loading class
                submitButton.prop('disabled', true);
            });
        });
       </script>
        {{-- custom script  --}}
        @stack('js')
    </body>
</html>
