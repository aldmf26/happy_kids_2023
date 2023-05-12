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
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#export"
                                class="btn icon icon-left btn-primary" style="float: right; margin-right: 5px;"><i
                                    class="bi bi-file-excel"></i>
                                Export</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" id="table1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Therapist</th>
                                        <th>Level</th>
                                        <th>Point Komisi</th>
                                        <th>Komisi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach ($komisi as $n)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $n->nama_therapy }}</td>
                                        <td>{{ $n->level }}</td>
                                        <td align="center">{{ empty($n->saldo) ? '0' : $n->saldo }}</td>
                                        <td>{{number_format( empty($n->saldo) ? '0' : $n->saldo * $n->nominal )}}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

</div>
<form action="{{ route('exportScreening') }}" method="post">
    @csrf
    <div class="modal fade text-left" id="export">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Export Screening
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Dari</label>
                                <input required type="date" class="form-control" name="tgl1">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Sampai</label>
                                <input required type="date" class="form-control" name="tgl2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Save</span>
                    </button>
                </div>

            </div>
        </div>
    </div>
</form>

<div class="modal fade text-left" id="view">
    <div class="modal-dialog  modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">
                    Data Paket
                </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="view_paket"></div>
            </div>
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>

<form id="submitEditTerapi">
    <div class="modal fade text-left" id="viewEditSaldo">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Data Paket Terapi
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="viewEditTerapi"></div>
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

<style>
    .modal-lg-max2 {
        max-width: 700px;
    }
</style>

<div class="modal fade text-left" id="view2">
    <div class="modal-dialog   modal-lg-max2" role="document">
        <div class="modal-content">
            <div id="view_paket2"></div>
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        function loadView(member_id){
            $.ajax({
                    url: "{{ route('view_paket_pasien') }}?member_id=" + member_id,
                    type: "Get",
                    success: function(data) {
                        $('#view_paket').html(data);
                    }
                });
        }

        $(document).on('click', '.view', function() {
                var member_id = $(this).attr('member_id')
                loadView(member_id)
        });

        $(document).on('click', '.view2', function() {
                    var member_id = $(this).attr('member_id');
                    var id_paket = $(this).attr('id_paket');
                  
                    $.ajax({
                        url: "{{ route('view_paket_pasien2') }}?member_id=" + member_id + "&id_paket=" + id_paket,
                        type: "Get",
                        success: function(data) {
                            $('#view_paket2').html(data);
                            $('#view2').modal('show'); 
                        }
                    });
                });
        $(document).on('click', '.editSaldo', function(){
            var member_id = $(this).attr('member_id')
            var id_paket = $(this).attr('id_paket')
            var id_terapi = $(this).attr('id_terapi')
            var id_saldo_therapy = $(this).attr('id_saldo_therapy')
            // alert(id_terapi)

            $("#viewEditSaldo").modal('show')
            $.ajax({
                type: "GET",
                url: "{{route('viewEditTerapi')}}",
                data: {
                    member_id : member_id,
                    id_paket : id_paket,
                    id_terapi : id_terapi,
                    id_saldo_therapy : id_saldo_therapy,
                },
                success: function (r) {
                    $("#viewEditTerapi").html(r)
                    $('.select2').select2({
                        dropdownParent: $('#viewEditSaldo')
                    });
                }
            });
        })

        $(document).on('submit', '#submitEditTerapi', function(e){
            e.preventDefault()
            var namaTerapi = $("#namaTerapi").val()
            var id_saldo_therapy = $("#id_saldo_therapy").val()
            var id_terapi_sebelum = $("#id_terapi_sebelum").val()

            $.ajax({
                type: "GET",
                url: "{{route('editPaketTerapi')}}",
                data: {
                    id_terapi:namaTerapi,
                    id_saldo_terapi:id_saldo_therapy,
                    id_terapi_sebelum:id_terapi_sebelum,
                },
                success: function (r) {
                    loadView(r)
                }
            });
        })

    });
</script>
@endsection