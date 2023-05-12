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
                    <h3>Nominal Inv {{ $title }}</h3>
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
                            <ul class="nav nav-tabs">
                   
                                <li class="nav-item">
                                    <a class="nav-link {{Request::is('data_nominal/2') ? 'active' : ''}}"
                                        aria-current="page" href="{{ route('data_nominal',2) }}">Periksa</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{Request::is('data_nominal/3') ? 'active' : ''}}"
                                        aria-current="page" href="{{ route('data_nominal',3) }}">Registrasi</a>
                                </li>
                            </ul>
                            <a href="#" id="sukses" data-bs-toggle="modal" data-bs-target="#tambah"
                                class="btn icon icon-left btn-primary" style="float: right"><i
                                    class="bi bi-plus-circle"></i>
                                Tambah</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" id="table1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Jenis</th>
                                        <th>Nominal</th>
                                        <th width="25%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($query as $no => $d)
                                    <tr>
                                        <td>{{ $no+1 }}</td>
                                        <td>{{ $d->nm_jenis }}</td>
                                        <td>{{ number_format($d->nominal,0) }}</td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $d->id_nominal }}"
                                                class="btn btn-sm icon btn-primary"><i class="bi bi-pencil"></i></a>
                                            <a onclick="return confirm('Yakin ingin dihapus')" href="{{ route('hapus_nominal', [$d->id_nominal,$tipe]) }}"
                                                class="btn btn-sm icon btn-danger"><i class="bi bi-trash"></i></a>
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

@foreach ($query as $d)
<form action="{{ route('edit_nominal') }}" method="POST">
    @csrf
    <div class="modal fade text-left" id="edit{{$d->id_nominal}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Edit Nominal
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="#">
                    <input type="hidden" name="id_nominal" value="{{ $d->id_nominal }}">
                    <input type="hidden" name="jenisInv" value="{{$jenis}}">
                    <input type="hidden" name="tipe" value="{{$tipe}}">
                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label>Nama Jenis </label>
                                    <input type="text" value="{{ $d->nm_jenis }}" name="nm_jenis" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Nominal </label>
                                    <input type="number" value="{{ $d->nominal }}" style="text-align:right;" name="nominal" class="form-control" />
                                </div>
                            </div>
                        </div>

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
                </form>
            </div>
        </div>
    </div>
</form>
@endforeach

<form action="{{ route('tambah_nominal',$tipe) }}" method="POST">
    @csrf
    <div class="modal fade text-left" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Tambah Nominal
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <input type="hidden" name="jenisInv" value="{{$jenis}}">
                                    <label>Nama Jenis </label>
                                    <input type="text" name="nm_jenis" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Nominal </label>
                                    <input type="number" style="text-align:right;" name="nominal" class="form-control" />
                                </div>
                            </div>
                        </div>
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
                </form>
            </div>
        </div>
    </div>
</form>

@endsection
@section('scripts')
<script>
    $(document).ready(function() {

            $(document).on('click', '.klik_view', function() {
                var member_id = $(this).attr('member_id')
                $.ajax({
                    type: "GET",
                    url: "{{ route('load_view_pasien') }}?member_id=" + member_id,
                    success: function(r) {
                        $("#load_view_pasien").html(r);
                    }
                });
            })

            $(document).on('click', '.klik_member', function() {
                var member_id = $(this).attr('member_id')
                $.ajax({
                    type: "GET",
                    url: "{{ route('load_view_member') }}?member_id=" + member_id,
                    success: function(r) {
                        $("#load_view_member").html(r);
                    }
                });
            })
        });
</script>
@endsection