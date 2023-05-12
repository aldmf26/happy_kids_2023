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
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
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
                                <x-btn-aldi/>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover" id="table1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Therapist</th>
                                            <th width="25%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($history as $no => $d)
                                            <tr>
                                                <td>{{ $no + 1 }}</td>
                                                <td>{{ $d->nama_therapy }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary btn-sm view2"
                                                        id_therapy="{{ $d->id_therapy }}">History
                                                    </a>
                                                </td>
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
    <form action="{{ route('exportTherapist') }}" method="post">
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

    <div class="modal fade text-left" id="history">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        History Detail
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Dari</label>
                                <input type="date" id="tgl1" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Sampai</label>
                                <input type="date" id="tgl2" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Aksi</label><br>
                                <button type="submit" id="btnHistory" class="btn btn-sm btn-primary">View</button>
                            </div>
                        </div>
                    </div>
                    <div id="loadHistory"></div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.view2', function() {
                $("#history").modal('show')
                var id_therapy = $(this).attr('id_therapy')
                $("#tgl1").val('')
                $("#tgl2").val('')

                $.ajax({
                    type: "GET",
                    url: "{{ route('historyDetail') }}" ,
                    data: {
                        id_therapy: id_therapy,
                    },
                    success: function(r) {
                        $("#loadHistory").html(r);
                    }
                });
                
                $(document).on('click', '#btnHistory', function() {
                    var tgl1 = $("#tgl1").val()
                    var tgl2 = $("#tgl2").val()
                    
                    $.ajax({
                        type: "GET",
                        url: "{{ route('historyDetail') }}" ,
                        data: {
                            id_therapy: id_therapy,
                            tgl1: tgl1,
                            tgl2: tgl2
                        },
                        success: function(r) {
                            $("#loadHistory").html(r);
                        }
                    });
                })

            })
            
        });
    </script>
@endsection
