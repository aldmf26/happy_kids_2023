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
                            <a href="#" id="sukses" data-bs-toggle="modal" data-bs-target="#tambah"
                                class="btn icon icon-left btn-primary" style="float: right"><i
                                    class="bi bi-plus-circle"></i>
                                Tambah</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" id="table1">
                                <thead>
                                    <tr>
                                        <th width="6%">#</th>
                                        <th>Nama Jenis</th>
                                        <th>Nominal</th>
                                        <th width="25%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                             
                                    @foreach ($jenis_inv as $no => $d)
                                    <tr>
                                        <td>{{ $no+1 }}</td>
                                        <td>{{ $d->nm_jenis }}</td>
                                        <td>{{ number_format($d->nominal,0) }}</td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $d->id_jenis_inv }}"
                                                class="btn btn-sm icon btn-primary"><i class="bi bi-pencil"></i></a>
                                            <a onclick="return confirm('Yakin ingin dihapus')"
                                                href="{{ route('hps_jenis_inv', ['id_jenis_inv' => $d->id_jenis_inv]) }}"
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

{{-- tambah --}}
<form action="{{ route('tbh_jenis_inv') }}" method="POST">
    @csrf
    <div class="modal fade text-left" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Tambah Invoice Jenis
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
                                    <label>Nama Jenis </label>
                                    <input type="text" name="nm_jenis" required class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Nominal </label>
                                    <input type="text" name="nominal" class="form-control" />
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
                </form>
            </div>
        </div>
    </div>
</form>

{{-- edit terapi --}}
@foreach ($jenis_inv as $i)
<form action="{{ route('edit_jenis_inv') }}" method="POST">
    @csrf
    <div class="modal fade text-left" id="edit{{$i->id_jenis_inv}}" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Edit Therapist
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
                                    <label>Nama Therapist </label>
                                    <input type="hidden" name="id_jenis_inv" value="{{ $i->id_jenis_inv }}">
                                    <input type="text" value="{{ $i->nm_jenis }}" name="nm_jenis"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Nominal </label>
                                    <input type="text" value="{{ $i->nominal }}" name="nominal"
                                        class="form-control" />
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

@endsection
