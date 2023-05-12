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
                    @if ($countPermission < 1)
                        <h1 class="text-danger"><em>Akses Tidak Ada !</em></h1>
                    @else
                        @foreach ($void_menu as $v)
                            @php
                                $perm = DB::select("SELECT * FROM void_permission as a LEFT JOIN tb_menu_void as b ON a.id_menu_void = b.id WHERE a.id_user = '$id_user' AND b.id = '$v->id'");
                            @endphp
                            @foreach ($perm as $p)
                                <div data-bs-toggle="modal" data-bs-target="#{{$p->target_id}}" class="col-6 col-lg-2 col-md-6">
                                    <a href="#">
                                        <div class="card">
                                            <div class="card-body px-4 py-4-5" style="height: 170px">
                                                <div class="row ">
                                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-center">
                                                        <i class="fa-solid {{$p->icon}} fa-3x"></i>
                                                    </div>
                                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-4 justify-content-center">
                                                        <h6 class="text-muted font-semibold text-center">
                                                            {{ ucwords($p->teks) }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                            
                        @endforeach
                    @endif

                </div>
            </section>
        </div>
    </div>

    <div class="modal fade text-left" id="inv_screening">
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
                        <div class="col-lg-4">
                            <label for="">Dari</label>
                            <input type="date" class="form-control" id="tgl1_screening">
                        </div>
                        <div class="col-lg-4">
                            <label for="">Sampai</label>
                            <input type="date" class="form-control" id="tgl2_screening">
                        </div>
                        <div class="col-lg-4">
                            <label for="">Aksi</label><br>
                            <button class="btn btn-primary btn-sm" type="button" id="btnScreening">Save</button>
                        </div>
                    </div>
                    <div id="loadScreening"></div>

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
@section('scripts')
<script>
    $(document).ready(function () {

        function sukses(){
            iziToast.success({
                title: 'Sukses !',
                message: "Berhasil hapus",
                position: 'topRight'
            });
        }

        // load screening
        function loadScreening(tgl1, tgl2) {
            $.ajax({
                type: "GET",
                url: "{{route('loadScreening')}}",
                data: {
                    tgl1:tgl1,
                    tgl2:tgl2
                },
                success: function (r) {
                    $("#loadScreening").html(r);
                    
                }
            });
        }
        $(document).on('click', '#hapusScreening', function(){
            var id_invoice = $(this).attr('id_invoice')
            var tgl1 = $("#tgl1_screening").val();
            var tgl2 = $("#tgl2_screening").val();
            if(confirm('Yakin ingin dihapus ?')){
                $.ajax({
                        type: "GET",
                        url: "{{route('hapus_invoice')}}?id_invoice="+id_invoice,
                        success: function (r) {
                            sukses()
                            loadScreening(tgl1, tgl2)
                    }
                });
            }
        })
        $(document).on('click', '#btnScreening', function(){
            var tgl1 = $("#tgl1_screening").val();
            var tgl2 = $("#tgl2_screening").val();
            loadScreening(tgl1, tgl2)
        })

        // load periksa
        function loadPeriksa(tgl1, tgl2) {
            $.ajax({
                type: "GET",
                url: "{{route('loadPeriksa')}}",
                data: {
                    tgl1:tgl1,
                    tgl2:tgl2
                },
                success: function (r) {
                    $("#loadPeriksa").html(r);
                    
                }
            });
        }
        $(document).on('click', '#hapusPeriksa', function(){
            var id_invoice = $(this).attr('id_invoice')
            var tgl1 = $("#tgl1_periksa").val();
            var tgl2 = $("#tgl2_periksa").val();
            if(confirm('Yakin ingin dihapus ?')) {
                $.ajax({
                        type: "GET",
                        url: "{{route('hapus_invoice_periksa')}}?id_invoice_periksa="+id_invoice,
                        success: function (r) {
                            sukses()
                            loadPeriksa(tgl1, tgl2)
                    }
                });
            }
        })
        $(document).on('click', '#btnPeriksa', function(){
            var tgl1 = $("#tgl1_periksa").val();
            var tgl2 = $("#tgl2_periksa").val();
            loadPeriksa(tgl1, tgl2)
        })

        // load terapi paket
        function loadTerapi(tgl1, tgl2) {
            $.ajax({
                type: "GET",
                url: "{{route('loadTerapi')}}",
                data: {
                    tgl1:tgl1,
                    tgl2:tgl2
                },
                success: function (r) {
                    $("#loadTerapi").html(r);
                    
                }
            });
        }
        $(document).on('click', '#hapusTerapi', function(){
            var id_invoice = $(this).attr('id_invoice')
            var tgl1 = $("#tgl1_terapi").val();
            var tgl2 = $("#tgl2_terapi").val();
            if(confirm('Jika dihapus semua data kunjungan dengan member id ini akan terhapus ?')) {
                $.ajax({
                        type: "GET",
                        url: "{{route('hapus_invoice_tp')}}?id_invoice_therapy="+id_invoice,
                        success: function (r) {
                            sukses()
                            loadTerapi(tgl1, tgl2)
                    }
                });
            }
        })
        $(document).on('click', '#btnTerapi', function(){
            var tgl1 = $("#tgl1_terapi").val();
            var tgl2 = $("#tgl2_terapi").val();
            loadTerapi(tgl1, tgl2)
        })

        // load kunjungan
        function loadKunjungan(tgl1, tgl2) {
            $.ajax({
                type: "GET",
                url: "{{route('loadKunjungan')}}",
                data: {
                    tgl1:tgl1,
                    tgl2:tgl2
                },
                success: function (r) {
                    $("#loadKunjungan").html(r);
                    
                }
            });
        }
        $(document).on('click', '#hapusKunjungan', function(){
            var id_invoice = $(this).attr('id_invoice')
            var tgl1 = $("#tgl1_kunjungan").val();
            var tgl2 = $("#tgl2_kunjungan").val();
            if(confirm('Yakin ingin dihapus ?')) {
                $.ajax({
                        type: "GET",
                        url: "{{route('hapus_invoice_kunjungan')}}?no_order="+id_invoice,
                        success: function (r) {
                            sukses()
                            loadKunjungan(tgl1, tgl2)
                    }
                });
            }
        })
        $(document).on('click', '#btnKunjungan', function(){
            var tgl1 = $("#tgl1_kunjungan").val();
            var tgl2 = $("#tgl2_kunjungan").val();
            loadKunjungan(tgl1, tgl2)
        })

    });
</script>
@endsection
