@extends('admin.layouts.master')

@section('cms_menu', 'menu-open')
@section('pages', 'active')
@section('title') {{ $data['title'] ?? '' }} @endsection

@push('style')
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $data['title'] ?? '' }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ $data['title'] ?? '' }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h3 class="card-title">Manage {{ $data['title'] ?? '' }} </h3>
                                    </div>

                                </div>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('admin.cms.update.pages') }}" method="post">
                                    @csrf
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label required" for="about_us">About Us Page Content</label>
                                                    <textarea class="form-control" id="summernote" name="about_us" style="height: 150px !important;width:100% !important;">{{ old('about_us') ? old('about_us') : $pageContent->about_us ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label required" for="privacy_policy">Privacy Policy Page
                                                        Content</label>
                                                    <textarea class="form-control" id="privacy_policy" name="privacy_policy"
                                                        style="height: 150px !important;width:100% !important;">{{ old('privacy_policy') ? old('privacy_policy') : $pageContent->privacy_policy ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label required" for="terms_condition">Terms & Conditions Page
                                                        Content</label>
                                                    <textarea class="form-control" id="terms_condition" name="terms_condition"
                                                        style="height: 150px !important;width:100% !important;">{{ old('terms_condition') ? old('terms_condition') : $pageContent->terms_condition ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-2">
                                                <button class="btn btn-success">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script !src="">
        $('#privacy_policy').summernote({
            placeholder: 'Hello',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture',]],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onImageUpload: function (files) {
                    uploadImage(files[0], "#privacy_policy");
                }
            },
            imageUploadURL: '',
        });
        function uploadImage(file, idOrClassSelector) {
            var formData = new FormData();
            formData.append('image', file);

            $.ajax({
                url: "{{route('upload-image')}}",
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response.url);
                    $(idOrClassSelector).summernote('insertImage', response.url);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ' - ' + errorThrown);
                }
            });
        }
        $('#terms_condition').summernote({
            placeholder: 'Hello',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture',]],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onImageUpload: function (files) {
                    uploadImage(files[0], "#terms_condition");
                }
            },
            imageUploadURL: '',
        });
        function uploadImage(file, idOrClassSelector) {
            var formData = new FormData();
            formData.append('image', file);

            $.ajax({
                url: "{{route('upload-image')}}",
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response.url);
                    $(idOrClassSelector).summernote('insertImage', response.url);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ' - ' + errorThrown);
                }
            });
        }
    </script>
@endpush
