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
                    <div class="col-12 col-md-8 order-md-1 order-last">
                        <h3>{{ $title }} | Tanggal : {{ date('d-M-Y', strtotime($tgl)) }}</h3>
                    </div>
                    <div class="col-12 col-md-4 order-md-2 order-first">
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
                <div class="card">
                    <div class="card-header">
                        <a style="margin-right: 5px;" href="{{ route('app_dokter', ['view_tgl' => $tgl]) }}"
                            class="btn icon icon-left btn-warning"><i class="bi bi-arrow-left"></i>
                            Kembali</a>
                        <a style="margin-right: 5px;" href="#" data-bs-toggle="modal"
                            data-bs-target="#plus-appointment" class="btn icon btn-primary"><i class="bi bi-plus"></i>
                            Appointment</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('edit_jam_appoinment') }}" method="post">
                            @csrf
                            <table class="table  table-bordered">
                                <thead>
                                    <tr>
                                        <th>No Order</th>
                                        <th>Nama Pasien</th>
                                        <th>Dokter</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($order as $o)
                                        <tr>
                                            <td>{{ $o->no_order }}</td>
                                            <td>{{ $o->nama_pasien }}</td>
                                            <td>
                                                <select name="dokter[]" id="" class="form-control">
                                                    @foreach ($dokter as $i)
                                                        <option value="{{ $i->id_dokter }}"
                                                            {{ $i->id_dokter == $o->location ? 'Selected' : '' }}>
                                                            {{ $i->nm_dokter }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="hidden" name="id_order[]" value="{{ $o->id_order }}">
                                                <input type="hidden" name="id_terapis[]" value="{{ $o->id_terapis }}">
                                                <input type="hidden" name="tgl" value="{{ $tgl }}">
                                                <input type="time" name="start[]" id=""
                                                    value="{{ $o->start }}" class="form-control"
                                                    {{ $o->status == 'Selesai' ? 'readonly' : '' }}>
                                            </td>
                                            <td><input type="time" name="end[]" id=""
                                                    value="{{ $o->end }}" class="form-control"
                                                    {{ $o->status == 'Selesai' ? 'readonly' : '' }}></td>
                                            <td align="center">
                                                @php
                                                    $jawaban = DB::selectOne("SELECT a.* FROM jawaban4 as a where a.no_order = '$o->no_order' group by a.no_order");
                                                @endphp

                                                @if ($o->status == 'Selesai')
                                                    <a href="{{ route('cancel_selesai_appoinment', ['id_order' => $o->id_order, 'tgl' => $tgl]) }}"
                                                        class="btn btn-warning btn-sm"><i class="bi bi-arrow-clockwise"></i>
                                                        cancel</a>
                                                @else
                                                    <button type="submit" class="btn btn-primary btn-sm">simpan</button>
                                                    <a href="{{ route('cancel_appoinment', ['id_order' => $o->id_order, 'id_terapis' => $o->id_terapis, 'tgl' => $tgl]) }}"
                                                        class="btn btn-warning btn-sm">hapus</a>
                                                    <a href="{{ route('selesai_appoinment', ['id_order' => $o->id_order, 'tgl' => $tgl]) }}"
                                                        class="btn btn-primary btn-sm">selesai</a>
                                                @endif
                                                @if (empty($jawaban->no_order))
                                                    <a href="{{ route('kpertanyaan', ['no_order' => $o->no_order, 'member_id' => $o->member_id]) }}"
                                                        class="btn btn-primary btn-sm"><i
                                                            class="bi bi-file-earmark-check"></i> form soal</a>
                                                @else
                                                    <a href="{{ route('cetak', ['no_order' => $o->no_order, 'member_id' => $o->member_id]) }}"
                                                        class="btn btn-primary btn-sm" target="_blank"><i
                                                            class="bi bi-printer"></i>
                                                        cetak hasil</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </section>
        </div>

    </div>

    <form id="save_terapi" action="{{ route('save_dokter_app') }}" method="post">
        @csrf
        <div class="modal fade text-left" id="plus-appointment" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">
                            Tambah Appointment
                        </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="hidden" name="tgl" value="{{ $tgl }}">
                                    <label for="">Pasien</label>
                                    <select name="customer[]" id="" class="form-control">
                                        <option value="">- Pilih pasien -</option>
                                        @foreach ($invoice as $i)
                                            <option value="{{ $i->id_invoice }}">{{ $i->no_order }} -
                                                {{ $i->nama_pasien }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Dokter</label>
                                    <select name="dokter[]" id="" class="form-control">
                                        <option value="">- Pilih Dokter -</option>
                                        @foreach ($dokter as $i)
                                            <option value="{{ $i->id_dokter }}">{{ $i->nm_dokter }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Jam</label>
                                    <input type="time" name="jam[]" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Aksi</label><br>
                                    <button id="tambah_terapi" class="btn btn-sm btn-primary" type="button"><i
                                            class="bi bi-plus"></i></button>
                                </div>
                            </div>
                        </div>

                        <div id="view_tambah_terapi"></div>

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
@endsection
