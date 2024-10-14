<!DOCTYPE html>
<html lang="en">

<head>
    @php
        $setting = App\Models\Setting::first();
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ $setting->site_name }}</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset($setting->favicon) }}" type="image/x-icon">

    @yield('meta')

    {{-- style --}}
    @include('admin.layouts.style')
    {{-- toastr style --}}
    <link rel="stylesheet" href="{{ asset('massage/toastr/toastr.css') }}">
    <link href="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- custom css  --}}
    <style>
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #8bc34a !important;
        }
    </style>
    @stack('style')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        {{-- header area --}}
        @include('admin.layouts.header')
        {{-- sidebar area --}}
        @include('admin.layouts.sidebar')
        {{-- main content --}}
        @yield('content')
        {{-- footer --}}
        @include('admin.layouts.footer')

        {{-- javascript --}}
        @include('admin.layouts.script')
    </div>
    {{-- toastr javascript --}}
    <script src="{{ asset('massage/toastr/toastr.js') }}"></script>

    {!! Toastr::message() !!}

    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', 'Error', {
                    closeButton: true,
                    progressBar: true,
                });
            @endforeach
        @endif
    </script>

    <script>
        $('#dataTables').DataTable();

        $('.summernote').summernote({
            height: 200,
        });

        $('.select2').select2();
    </script>
    {{-- delete sweetalert2 --}}
    <script>
        $(document).on("click", "#deleteData", function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            Swal.fire({
                title: 'Are you want to delete?',
                text: "Once Delete, This will be Permanently Delete!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#8bc34a',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    window.location.href = link;
                }
            })
        });

        $(document).on('submit', 'form', function() {
            let submitButton = $(this).find(':submit');
            submitButton.html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                );
            // Disable the submit button and add the loading class
            submitButton.prop('disabled', true);
        });
    </script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    {{-- custom js area --}}
    @stack('script')
    <script>
        $('#summernote').summernote({
            placeholder: 'Hello',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', ]],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onImageUpload: function(files) {
                    uploadImage(files[0], "#summernote");
                }
            },
            imageUploadURL: '',
        });

        function uploadImage(file, idOrClassSelector) {
            var formData = new FormData();
            formData.append('image', file);

            $.ajax({
                url: "{{ route('upload-image') }}",
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response.url);
                    $(idOrClassSelector).summernote('insertImage', response.url);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ' - ' + errorThrown);
                }
            });
        }
    </script>
</body>

</html>
