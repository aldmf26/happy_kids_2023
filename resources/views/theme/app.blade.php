<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Happy Kids</title>

    <link rel="stylesheet" href="{{ asset('theme') }}/assets/css/main/app.css">
    
    <link rel="shortcut icon" href="{{ asset('images-upload/logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('images-upload/logo.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('theme') }}/assets/css/shared/iconly.css">

    <link rel="stylesheet" href="{{ asset('theme') }}/assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/assets/css/pages/simple-datatables.css">
    <link rel="stylesheet" href="{{ asset('css') }}/iziToast.min.css">
    <link rel="stylesheet" href="{{ asset('css') }}/jquery.skedTape.css">


    <link rel="stylesheet" href="{{ asset('theme') }}/assets/extensions/choices.js/public/assets/styles/choices.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    

    @yield('styles')
</head>
@php
// $warna1 = DB::table('h1')->where('id_h1', 16)->first()->isi;
// $warna2 = DB::table('h1')->where('id_h1', 17)->first()->isi;
$warna1 = DB::table('cms_content')
->where('id', 1)
->first()->isi;
$warna2 = DB::table('cms_content')
->where('id', 2)
->first()->isi;
$warna3 = DB::table('cms_content')
->where('id', 3)
->first()->isi;
$warna4 = DB::table('cms_content')
->where('id', 4)
->first()->isi;
@endphp
<style>
    .sked-tape__caption {
        background-color: "{{ $warna2 }}";
        color: #fffff;
    }

    .select2 {
        width: 100% !important;

    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #aaa;
        border-radius: 4px;
        height: 35px;
    }
</style>
<style>
    a {
        text-decoration: none;
    }

    #multi-step-form-container {
        margin-top: 2rem;
    }

    input:read-only {
        background-color: #E9ECEF;
    }



    .d-none {
        display: none;
    }

    .form-step {
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 20px;
        padding: 3rem;
        background: #fff
    }

    .font-normal {
        font-weight: normal;
    }

    ul.form-stepper {
        counter-reset: section;
        margin-bottom: 3rem;
    }

    ul.form-stepper .form-stepper-circle {
        position: relative;
    }

    ul.form-stepper .form-stepper-circle span {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translateY(-50%) translateX(-50%);
    }

    .form-stepper-horizontal {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    ul.form-stepper>li:not(:last-of-type) {
        margin-bottom: 0.625rem;
        -webkit-transition: margin-bottom 0.4s;
        -o-transition: margin-bottom 0.4s;
        transition: margin-bottom 0.4s;
    }

    .form-stepper-horizontal>li:not(:last-of-type) {
        margin-bottom: 0 !important;
    }

    .form-stepper-horizontal li {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
        -webkit-box-align: start;
        -ms-flex-align: start;
        align-items: start;
        -webkit-transition: 0.5s;
        transition: 0.5s;
    }

    .form-stepper-horizontal li:not(:last-child):after {
        position: relative;
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
        height: 1px;
        content: "";
        top: 32%;
    }

    .form-stepper-horizontal li:after {
        background-color: #dee2e6;
    }

    .form-stepper-horizontal li.form-stepper-completed:after {
        background-color: #68B984;
    }

    .form-stepper-horizontal li:last-child {
        flex: unset;
    }

    ul.form-stepper li a .form-stepper-circle {
        display: inline-block;
        width: 40px;
        height: 40px;
        margin-right: 0;
        line-height: 1.7rem;
        text-align: center;
        background: rgba(0, 0, 0, 0.38);
        border-radius: 50%;
    }

    .form-stepper .form-stepper-active .form-stepper-circle {
        background-color: <?=$warna3 ?> !important;
        color: #fff;
    }

    .form-stepper .form-stepper-active .label {
        color: <?=$warna3 ?> !important;
    }

    .form-stepper .form-stepper-active .form-stepper-circle:hover {
        background-color: <?=$warna3 ?> !important;
        color: #fff !important;
    }

    .form-stepper .form-stepper-unfinished .form-stepper-circle {
        background-color: #f8f7ff;
    }

    .form-stepper .form-stepper-completed .form-stepper-circle {
        color: #fff;
        background-color: <?=$warna4 ?> !important;
    }

    .form-stepper .form-stepper-completed .label {
        color: <?=$warna4 ?> !important;
    }

    .form-stepper .form-stepper-completed .form-stepper-circle:hover {
        color: #fff !important;
        background-color: <?=$warna4 ?> !important;
    }

    .form-stepper .form-stepper-active span.text-muted {
        color: #fff !important;
    }

    .form-stepper .form-stepper-completed span.text-muted {
        color: #fff !important;
    }

    .form-stepper .label {
        font-size: 1rem;
        margin-top: 0.5rem;
    }

    .form-stepper a {
        cursor: default;
    }
</style>

<body style="background-color: {{ $warna2 }}">
    <div id="app">
        @include('theme.navbar')
        @yield('content')

    </div>
    <form action="{{ route('save_theme') }}" method="post">
        @csrf
        <div class="modal fade text-left" id="theme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">
                            Edit theme
                        </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <center>
                            <div class="row">
                                <h5>Colors</h5>
                                <div class="col-lg-3">
                                    <input class="form-control style1" id="warna1" type="color" value="{{ $warna1 }}"
                                        name="warna1">
                                    <label for="" class="text-secondary ml-2">Warna 1</label>
                                </div>
                                <div class="col-lg-3">
                                    <input class="form-control style1" id="warna2" type="color" value="{{ $warna2 }}"
                                        name="warna2">
                                    <label for="" class="text-secondary ml-2">Warna 2</label>
                                </div>
                                <div class="col-lg-3">
                                    <input class="form-control style1" id="warna3" type="color" value="{{ $warna3 }}"
                                        name="warna3">
                                    <label for="" class="text-secondary ml-2">Warna 3</label>
                                </div>
                                <div class="col-lg-3">
                                    <input class="form-control style1" id="warna4" type="color" value="{{ $warna4 }}"
                                        name="warna4">
                                    <label for="" class="text-secondary ml-2">Warna 4</label>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <h5>Buttons</h5>
                                <div class="col-lg-4">
                                    <input class="form-control style1" id="warna1" type="color" value="{{ $warna1 }}"
                                        name="warna1">
                                    <label for="" class="text-secondary ml-2">Warna 1</label>
                                </div>
                                <div class="col-lg-4">
                                    <input class="form-control style1" id="warna2" type="color" value="{{ $warna2 }}"
                                        name="warna2">
                                    <label for="" class="text-secondary ml-2">Warna 2</label>
                                </div>
                                <div class="col-lg-4">
                                    <input class="form-control style1" id="warna2" type="color" value="{{ $warna2 }}"
                                        name="warna2">
                                    <label for="" class="text-secondary ml-2">Warna 2</label>
                                </div>
                            </div> --}}
                            {{-- <div class="row mt-5">
                                <h5>Font Colors</h5>
                                <div class="col-lg-4">
                                    <input class="form-control style1" id="fwarna1" type="color" value="" name="fontc1">
                                    <label for="" class="text-secondary ml-2">Warna 1</label>
                                </div>
                                <div class="col-lg-4">
                                    <input class="form-control style1" id="fwarna2" type="color" value="" name="fontc2">
                                    <label for="" class="text-secondary ml-2">Warna 2</label>
                                </div>
                                <div class="col-lg-4">
                                    <input class="form-control style1" id="fwarna3" type="color" value="" name="fontc3">
                                    <label for="" class="text-secondary ml-2">Warna 3</label>
                                </div>
                            </div> --}}
                        </center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Save</span>
                        </button>
                    </div>
    
                </div>
            </div>
        </div>
    </form>
    <script src="{{ asset('theme') }}/assets/js/bootstrap.js"></script>
    <script src="{{ asset('theme') }}/assets/js/app.js"></script>
    <script src="{{ asset('theme') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('js') }}/iziToast.min.js"></script>
    <script src="{{ asset('js') }}/jquery.skedTape.js"></script>

    <!-- Need: Apexcharts -->
    <script src="{{ asset('theme') }}/assets/js/pages/dashboard.js"></script>
    <script src="{{ asset('theme') }}/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="{{ asset('theme') }}/assets/js/pages/simple-datatables.js"></script>


    {{-- <script src="{{ asset('theme') }}/assets/js/pages/form-element-select.js"></script> --}}

    {{-- choice select2 --}}
    <script src="{{ asset('theme') }}/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="{{ asset('theme') }}/assets/js/pages/form-element-select.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script src="{{ asset('theme') }}/assets/js/select2.min.js"></script> --}}


    <script>
        $(document).ready(function () {
            $('.select2').select2()
        });
    </script>
    @if (session()->has('sukses'))
    <script>
        $(document).ready(function() {
                iziToast.success({
                    title: 'Sukses !',
                    message: "{{ session()->get('sukses') }}",
                    position: 'topRight'
                });
            });
    </script>
    @endif

    @if (session()->has('error'))
    <script>
        $(document).ready(function() {
                iziToast.error({
                    title: 'ERROR !',
                    message: "{{ session()->get('error') }}",
                    position: 'topRight'
                });
            });
    </script>
    @endif
    <script>
        $(document).on('change', '#warna1', function() {
            $('.card').css('background-color', $(this).val())
            $('.card-header').css('background-color', $(this).val())
            $('.sidebar-wrapper').css('background-color', $(this).val())
        })
        $(document).on('change', '#warna2', function() {
            $('body').css('background-color', $(this).val())
        })
        $(document).on('change', '#warna3', function() {
            $('.sidebar-item.active>.sidebar-link').css('background-color', $(this).val())
            $('.btn-primary').css('--bs-btn-bg', $(this).val())
        })
        $(document).on('change', '#warna4', function() {
            $('.btn-warning').css('--bs-btn-bg', $(this).val())
        })
    </script>
    @yield('scripts')
</body>

</html>