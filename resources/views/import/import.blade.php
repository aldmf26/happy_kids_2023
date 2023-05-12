@extends('theme.app')
@section('content')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $title }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Import </a> <p class="text-danger"></p></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-6 col-lg-2 col-md-6">
                    <a href="{{route('importUser')}}" class="exportKlik">
                        <div class="card">
                            <div class="card-body" style="height: 130px" >
                                <div class="row ">
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-center">
                                        <i class="fa-solid fa-user fa-2x"></i>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-4 justify-content-center">
                                        <h6 class="text-muted font-semibold text-center">
                                           Data User
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <center>
                                    <a href="{{route('importUser')}}" class="btn btn-info export1 exportKlik" id="export1">import</a>
                                    <button class="btn btn-info save_loading1" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Loading...
                                    </button>
                                </center>

                            </div>
                        </div>
                    </a>
                </div>
                {{-- <div class="col-6 col-lg-2 col-md-6">
                    <a href="{{route('importPasien')}}">
                        <div class="card">
                            <div class="card-body" style="height: 130px" >
                                <div class="row ">
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-center">
                                        <i class="fa-solid fa-procedures fa-2x"></i>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-4 justify-content-center">
                                        <h6 class="text-muted font-semibold text-center">
                                           Data Pasien
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <center>
                                    <a href="{{route('importPasien')}}" class="btn btn-info" id="export3">import</a>
                                    <button class="btn btn-info save_loading3" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Loading...
                                    </button>
                                </center>

                            </div>
                        </div>
                    </a>
                </div> --}}
                <div class="col-6 col-lg-2 col-md-6">
                    <a href="{{route('importPaket')}}" class=" exportKlik">
                        <div class="card">
                            <div class="card-body" style="height: 130px" >
                                <div class="row ">
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-center">
                                        <i class="fa-solid fa-shopping-bag fa-2x"></i>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-4 justify-content-center">
                                        <h6 class="text-muted font-semibold text-center">
                                           Data Paket
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <center>
                                    <a href="{{route('importPaket')}}" class="btn btn-info exportKlik" id="export4">import</a>
                                    <button class="btn btn-info save_loading4" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Loading...
                                    </button>
                                </center>

                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-2 col-md-6">
                    <a href="{{route('importDokter')}}" class="exportKlik">
                        <div class="card">
                            <div class="card-body" style="height: 130px" >
                                <div class="row ">
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-center">
                                        <i class="fa-solid fa-user-md fa-2x"></i>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-4 justify-content-center">
                                        <h6 class="text-muted font-semibold text-center">
                                           Data Dokter & Therapist
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <center>
                                    <a href="{{route('importDokter')}}" class="btn btn-info exportKlik" id="export2">import</a>
                                    <button class="btn btn-info save_loading2" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Loading...
                                    </button>
                                </center>

                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-2 col-md-6">
                    <a href="{{route('importNominal')}}" class="exportKlik">
                        <div class="card">
                            <div class="card-body" style="height: 130px" >
                                <div class="row ">
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-center">
                                        <i class="fa-solid fa-money-check-dollar fa-2x"></i>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-4 justify-content-center">
                                        <h6 class="text-muted font-semibold text-center">
                                           Data Nomoinal Inv
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <center>
                                    <a href="{{route('importNominal')}}" class="btn btn-info exportKlik" id="export5">import</a>
                                    <button class="btn btn-info save_loading5" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Loading...
                                    </button>
                                </center>

                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </section>
    </div>
</div>
<div class="modal fade text-left" id="loading" data-bs-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body">
                  <button class="btn btn-primary btn-block" type="button" disabled>
                    <span
                      class="spinner-grow spinner-grow-lg"
                      role="status"
                      aria-hidden="true"
                    ></span>
                    Data sedang di import dari server !
                  </button>

            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $(document).on('click', '.exportKlik', function(){
            $("#loading").modal('show')
        })
        $('.save_loading1').hide();
        $('.save_loading2').hide();
        $('.save_loading3').hide();
        $('.save_loading4').hide();
        $('.save_loading5').hide();

        $(document).on('click', '#export1', function() {
            $('#export1').hide();
            $('.save_loading1').show();
        });
        $(document).on('click', '#export2', function() {
            $('#export2').hide();
            $('.save_loading2').show();
        });
        $(document).on('click', '#export3', function() {
            $('#export3').hide();
            $('.save_loading3').show();
        });
        $(document).on('click', '#export4', function() {
            $('#export4').hide();
            $('.save_loading4').show();
        });
        $(document).on('click', '#export5', function() {
            $('#export5').hide();
            $('.save_loading5').show();
        });

    });
</script>
@endsection