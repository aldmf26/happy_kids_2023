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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-6 col-lg-2 col-md-6">
                    <a href="{{ route('data_nominal',1) }}">
                        <div class="card">
                            <div class="card-body px-4 py-4-5" style="height: 170px">
                                <div class="row ">
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-center">
                                        <i class="fa-solid fa-file-invoice fa-3x"></i>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-4 justify-content-center">
                                        <h6 class="text-muted font-semibold text-center">
                                            Inv Screening
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-6 col-lg-2 col-md-6">
                    <a href="{{ route('data_nominal',2) }}">
                        <div class="card" >
                            <div class="card-body px-4 py-4-5" style="height: 170px" >
                                <div class="row ">
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-center">
                                        <i class="fa-solid fa-person-circle-check fa-3x"></i>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-4 justify-content-center">
                                        <h6 class="text-muted font-semibold text-center">
                                            Inv Periksa
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-2 col-md-6">
                    <a href="{{ route('data_nominal',3) }}">
                        <div class="card">
                            <div class="card-body px-4 py-4-5" style="height: 170px">
                                <div class="row ">
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-center">
                                        <i class="fa-solid fa-address-card fa-3x"></i>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-4 justify-content-center">
                                        <h6 class="text-muted font-semibold text-center">
                                            Inv Registrasi
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- <div class="col-6 col-lg-2 col-md-6">
                    <a href="{{ route('data_nominal',4) }}">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row ">
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-center">
                                        <i class="fa-solid fa-clipboard-list fa-3x"></i>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-4 justify-content-center">
                                        <h6 class="text-muted font-semibold text-center">
                                            Inv Theraphy & Paket
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-2 col-md-6">
                    <a href="{{ route('data_nominal',5) }}">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row ">
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-center">
                                        <i class="fa-solid fa-person-chalkboard fa-3x"></i>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-4 justify-content-center">
                                        <h6 class="text-muted font-semibold text-center">
                                            Inv Kunjungan
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div> --}}

            </div>
        </section>
    </div>
</div>

<div class="modal fade text-left" id="nomScreening">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">
                    Invoice Screening
                </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade text-left" id="inv_periksa">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">
                    Invoice Periksa
                </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="">Dari</label>
                        <input type="date" class="form-control" id="tgl1_periksa">
                    </div>
                    <div class="col-lg-4">
                        <label for="">Sampai</label>
                        <input type="date" class="form-control" id="tgl2_periksa">
                    </div>
                    <div class="col-lg-4">
                        <label for="">Aksi</label><br>
                        <button class="btn btn-primary btn-sm" type="button" id="btnPeriksa">Save</button>
                    </div>
                </div>
                <div id="loadPeriksa"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade text-left" id="inv_tp">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">
                    Invoice Therapy
                </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="">Dari</label>
                        <input type="date" class="form-control" id="tgl1_terapi">
                    </div>
                    <div class="col-lg-4">
                        <label for="">Sampai</label>
                        <input type="date" class="form-control" id="tgl2_terapi">
                    </div>
                    <div class="col-lg-4">
                        <label for="">Aksi</label><br>
                        <button class="btn btn-primary btn-sm" type="button" id="btnTerapi">Save</button>
                    </div>
                </div>
                <div id="loadTerapi"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade text-left" id="inv_kunjungan">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">
                    Invoice Kunjungan
                </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="">Dari</label>
                        <input type="date" class="form-control" id="tgl1_kunjungan">
                    </div>
                    <div class="col-lg-4">
                        <label for="">Sampai</label>
                        <input type="date" class="form-control" id="tgl2_kunjungan">
                    </div>
                    <div class="col-lg-4">
                        <label for="">Aksi</label><br>
                        <button class="btn btn-primary btn-sm" type="button" id="btnKunjungan">Save</button>
                    </div>
                </div>
                <div id="loadKunjungan"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
            </div>

        </div>
    </div>
</div>
@endsection