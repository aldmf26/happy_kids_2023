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
                            <li class="breadcrumb-item"><a href="#">Export </a> <p class="text-danger"></p></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                @if ($pasien >= 1)
                    <div class="col-6 col-lg-4 col-md-6">
                        <a href="{{route('exportPasien')}}" class="exportKlik">
                            <div class="card">
                                <div class="card-body" style="height: 145px" >
                                    <div class="row ">
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-center">
                                            <i class="fa-solid fa-user fa-2x"></i>
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
                                        <a href="{{route('exportPasien')}}" class="btn btn-info export1 exportKlik" id="export1">Export</a>
                                        <button class="btn btn-info save_loading1" type="button" disabled>
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Loading...
                                        </button>
                                    </center>

                                </div>
                            </div>
                        </a>
                    </div>
                @else
                    <div class="col-6 col-lg-4 col-md-6">
                            <div class="card bg-info">
                                <div class="card-body text-white" style="height: 160px" >
                                    <div class="row ">
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-center">
                                            <i class="fa-solid fa-user fa-2x"></i>
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-4 justify-content-center">
                                            <h6 class="text-white font-semibold text-center">
                                            Data Pasien 
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-info text-white">
                                    <center>
                                        Semua data sudah di Export <i class="fa fa-check"></i>
                                    </center>

                                </div>
                            </div>
                    </div>
                @endif
                
                @if ($inv >= 1)
                    <div class="col-6 col-lg-4 col-md-6">
                        <a href="{{route('exportInv')}}" class="exportKlik">
                            <div class="card">
                                <div class="card-body" style="height: 145px" >
                                    <div class="row ">
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-center">
                                            <i class="fa-solid fa-file-invoice fa-2x"></i>
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-4 justify-content-center">
                                            <h6 class="text-muted font-semibold text-center">
                                            Data All Invoice <br> (Screening, Kunjungan, Periksa, Registrasi, Therapy)
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <center>
                                        <a href="{{route('exportInv')}}" class="btn btn-info export1 exportKlik" id="export2">Export</a>
                                        <button class="btn btn-info save_loading2" type="button" disabled>
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Loading...
                                        </button>
                                    </center>

                                </div>
                            </div>
                        </a>
                    </div>
                @else
                    <div class="col-6 col-lg-4 col-md-6">

                            <div class="card bg-info">
                                <div class="card-body text-white" style="height: 160px" >
                                    <div class="row ">
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-center">
                                            <i class="fa-solid fa-file-invoice fa-2x"></i>
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-4 justify-content-center">
                                            <h6 class="text-white font-semibold text-center">
                                            Data All Invoice <br> (Screening, Kunjungan, Periksa, Registrasi, Therapy)
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-info text-white">
                                    <center>
                                        Semua data sudah di Export <i class="fa fa-check"></i>
                                    </center>

                                </div>
                            </div>

                    </div>
                @endif

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
                    Data sedang di export ke server !
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
        $(document).on('click', '#export1', function() {
            $('#export1').hide();
            $('.save_loading1').show();

        });
        $(document).on('click', '#export2', function() {
            $('#export2').hide();
            $('.save_loading2').show();

        });
    });
</script>
@endsection