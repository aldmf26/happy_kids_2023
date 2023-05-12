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
            <div class="card">
                <div class="card-header">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn icon icon-left btn-primary"
                        style="float: right;"><i class="bi bi-plus"></i>
                        Buat Invoice Baru</a>
                    <x-btn-aldi/>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Member ID</th>
                                <th>No Order</th>
                                <th>Nama Pasien</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($invoice as $n)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ date('d-m-Y', strtotime($n->tgl)) }}</td>
                                <td>{{ $n->member_id }}</td>
                                <td>{{ $n->no_order }}</td>
                                <td>{{ $n->nama_pasien }}</td>
                                <td>
                                    <span class="badge bg-{{ $n->status == 'paid' ? 'primary' : 'warning' }}">{{
                                        $n->status == 'paid' ? "$n->status : " . strtoupper($n->pembayaran) : $n->status
                                        }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('cetak_registrasi',['id_registrasi' => $n->id_registrasi]) }}"
                                        target="_blank" class="btn btn-primary btn-sm"><i class="bi bi-printer"></i></a>
                                </td>
                                {{-- <td>
                                    <a href="{{ route('cetak_invoice',['id_registrasi' => $n->id_registrasi]) }}"
                                        target="_blank" class="btn btn-primary btn-sm"><i class="bi bi-printer"></i></a>
                                    <a href="#" class="btn btn-primary edit_invoice btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#edit" id_registrasi="{{$n->id_registrasi}}"><i
                                            class="bi bi-pencil-square"></i></a>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

</div>

{{-- edit --}}
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

<form action="{{ route('save_registrasi') }}" method="post">
    @csrf
    <div class="modal fade text-left" id="tambah">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Tambah Data Invoice Registrasi
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <div id="loadNomedis"></div> --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">No Rekam Medis</label>
                                <select required name="member_id" id="" class="choices form-select pilih_rek">
                                    <option value="">--Pilih data--</option>
                                    @foreach ($dt_pasien as $d)
                                    <option value="{{$d->member_id}}">{{$d->member_id}} - {{ $d->nama_pasien }} - {{
                                        $d->tgl_lahir }}</option>
                                    @endforeach
                                    <option value="plusPasien"><a href="{{ route('data_pasien') }}">+ Pasien Baru</a>
                                    </option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input required type="date" name="tgl" value="{{date('Y-m-d')}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nama Pasien</label>
                                <input required type="text" class="form-control nama" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Pembayaran</label>
                                <select name="pembayaran" id="" class="form-control choices">
                                    <option value="">- Pilih pembayaran -</option>
                                    <option value="CASH">CASH</option>
                                    <option value="BCA">BCA</option>
                                    <option value="MANDIRI">MANDIRI</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nominal</label>
                                <select name="rupiah" class="form-control choices">
                                    <option value="">- Pilih Nominal -</option>
                                    @foreach ($nominal as $n)
                                    <option value="{{ $n->nominal }}">{{ number_format($n->nominal,0) }}</option>
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
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Save</span>
                    </button>
                </div>

            </div>
        </div>
    </div>
</form>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
            $('.pilihan').hide();
            $('.pilihan').attr('disabled', 'true');

            $(document).on('change', '.select-pilihan', function() {
                var id_pilihan = $(this).val();

                if (id_pilihan == '1') {
                    $('.input_manual').show();
                    $('.input_manual').removeAttr('disabled', 'true');
                    $('.dari_customer').hide();
                    $('.dari_customer').attr('disabled', 'true');
                } else {
                    $('.dari_customer').show();
                    $('.dari_customer').removeAttr('disabled', 'true');
                    $('.input_manual').hide();
                    $('.input_manual').attr('disabled', 'true');
                }
            })
            function loadNomedis(){
                $.ajax({
                    type: "GET",
                    url: "{{route('noMedis')}}",
                    success: function (r) {
                        $("#loadNomedis").html(r);
                        $('.choices').sele
                    }
                });
            }
            loadNomedis()
            $(document).on('change', '.pilih_rek', function() {
                var member_id = $(this).val();
                if(member_id == 'plusPasien'){
                    $('#tambahPasien').modal('show')
                }
                $.ajax({
                    url: "{{ route('get_pasien') }}",
                    data: {
                        member_id: member_id,
                    },
                    type: "GET",
                    success: function(data) {
                        $('.nama').val(data);
                    }
                });
            })

            $(document).on('click', '.pay', function() {
                var id_invoice = $(this).attr('id_invoice')
                $("#id_invoice").val(id_invoice);
            })

            $(".edit_invoice").click(function (e) { 
                e.preventDefault();
                var id_invoice = $(this).attr('id_invoice')
                $("#id_invoice").val(id_invoice);
            });
        });
</script>
@endsection