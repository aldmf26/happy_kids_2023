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
                <div class="col-lg-10">
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
                                        <th>Nama Therapist</th>
                                        <th>Paket</th>
                                        <th width="25%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach ($therapist as $d)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $d->nama_therapy }}</td>
                                        <td>{{ $d->nama_paket }}</td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $d->id_therapy }}"
                                                class="btn btn-sm icon btn-primary"><i class="bi bi-pencil"></i></a>
                                            <a onclick="return confirm('Yakin ingin dihapus')"
                                                href="{{ route('hps_terapi', ['id_therapy' => $d->id_therapy]) }}"
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

{{-- edit terapi --}}
@foreach ($therapist as $i)
<form action="{{ route('edit_terapi') }}" method="POST">
    @csrf
    <div class="modal fade text-left" id="edit{{$i->id_therapy}}" tabindex="-1" role="dialog"
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
                                    <input type="hidden" name="id_therapy" value="{{ $i->id_therapy }}">
                                    <input type="text" value="{{ $i->nama_therapy }}" name="nama_therapy"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Data Paket </label>
                                    <select name="id_paket" id="" class="form-control choices">
                                        <option value="">- Pilih Paket -</option>
                                        @foreach ($paket as $d)
                                            <option {{$i->id_paket == $d->id_paket ? 'selected' : ''}} value="{{ $d->id_paket }}">{{ $d->nama_paket }}</option>
                                        @endforeach
                                    </select>
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

<form action="{{ route('tbh_therapy') }}" method="POST">
    @csrf
    <div class="modal fade text-left" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Tambah Therapist
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
                                    <input required type="text" name="nama_therapy" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Data Paket </label>
                                    <select name="id_paket" id="" class="form-control choices">
                                        <option value="">- Pilih Paket -</option>
                                        @foreach ($paket as $d)
                                            <option value="{{ $d->id_paket }}">{{ $d->nama_paket }}</option>
                                        @endforeach
                                    </select>
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
                })
            })

            $(document).on('click', '.klik_member', function() {
                var member_id = $(this).attr('member_id')
                $.ajax({
                    type: "GET",
                    url: "{{ route('load_view_member') }}?member_id=" + member_id,
                    success: function(r) {
                        $("#load_view_member").html(r);
                    }
                })
            })
    });
</script>
@endsection