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
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs">

                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('inv_periksa') ? 'active' : '' }}" aria-current="page"
                                href="{{ route('inv_periksa') }}">Periksa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('invoice_tp') ? 'active' : '' }}" aria-current="page"
                                href="{{ route('invoice_tp') }}">Therapy & Paket</a>
                        </li>
                    </ul>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn icon icon-left btn-primary"
                        style="float: right;"><i class="bi bi-plus"></i>
                        Buat Invoice Baru</a>
                    <x-btn-aldi />

                </div>
                <div class="card-body">
                    <table class="table table-hover" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Member ID</th>
                                <th>No Order</th>
                                <th>Dokter</th>
                                <th>Nama Pasien</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($invoice_periksa as $n)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ date('d-m-Y', strtotime($n->tgl)) }}</td>
                                <td>{{ kode($n->member_id) }}</td>
                                <td>{{ $n->no_order }}</td>
                                <td>
                                    <span class="teksLimit{{ $n->id_dokter }}">{{ Str::limit($n->nm_dokter, '14', '...')
                                        }}
                                        @if (strlen($n->nm_dokter) > 14)

                                        <a href="#" class="readMore" id="{{ $n->id_dokter }}">read
                                            more</a></span>
                                    @endif
                                    <span class="teksFull{{ $n->id_dokter }}" style="display:none">{{ $n->nm_dokter }}
                                        <a href="#" class="less" id="{{ $n->id_dokter }}">less</a></span>
                                </td>
                                <td>{{ $n->nama_pasien }}</td>
                                <td>
                                    <span class="badge bg-{{ $n->status == 'Paid' ? 'primary' : 'warning' }}">{{
                                        $n->status == 'Paid' ? "$n->status : " . strtoupper($n->pembayaran) : $n->status
                                        }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('cetak_inv_periksa', ['no_order' => $n->no_order]) }}"
                                        class="btn btn-primary btn-sm"><i class="bi bi-printer"></i>
                                    </a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

</div>

@foreach ($invoice_periksa as $i)
<form action="{{ route('edit_invoice_periksa') }}" method="post">
    @csrf
    <div class="modal fade text-left" id="edit{{ $i->id_invoice_periksa }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Edit Dokter dan Pembayaran
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id_invoice_periksa" id="id_edit">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nama Dokter</label>
                                <select name="id_dokter" id="" class="choices form-select">
                                    @foreach ($dokter as $d)
                                    <option {{ $d->id_dokter == $n->id_dokter ? 'selected' : '' }}
                                        value="{{ $d->id_dokter }}">{{ $d->nm_dokter }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Pembayaran</label>
                                <select name="pembayaran" id="" class="form-control choices">
                                    <option {{ $i->pembayaran == 'cash' ? 'selected' : '' }} value="CASH">CASH
                                    </option>
                                    <option {{ $i->pembayaran == 'bca' ? 'selected' : '' }} value="BCA">BCA
                                    </option>
                                    <option {{ $i->pembayaran == 'mandiri' ? 'selected' : '' }} value="MANDIRI">
                                        MANDIRI
                                    </option>
                                </select>
                            </div>
                        </div>
                        {{-- <div id="editInput"></div> --}}

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
@endforeach

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

<form action="{{ route('save_invoice_periksa') }}" method="post">
    @csrf
    <div class="modal fade text-left" id="tambah">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Tambah Data Invoice Periksa
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">No Rekam Medis</label>
                            <select name="member_id" id="" class="select2 pilih_rek">
                                <option value="">--Pilih data--</option>
                                @foreach ($dt_pasien as $d)
                                <option value="{{ $d->id_pasien }}">{{ kode($d->member_id) }} - {{ $d->nama_pasien }}
                                    - {{ $d->tgl_lahir }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mt-2">
                            <div class="form-group">
                                <label for="">Nama Dokter</label>
                                <select name="id_dokter" id="" class="select2 form-select">
                                    <option value="">--Pilih dokter--</option>
                                    @foreach ($dokter as $d)
                                    <option value="{{ $d->id_dokter }}">{{ $d->nm_dokter }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input required type="date" name="tgl" value="{{ date('Y-m-d') }}" class="form-control">
                            </div>
                        </div>

                        


                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Pembayaran</label>
                                <select name="pembayaran" id="" class="form-control select2">
                                    <option value="">- Pilih pembayaran -</option>
                                    <option value="CASH">CASH</option>
                                    <option value="BCA">BCA</option>
                                    <option value="MANDIRI">MANDIRI</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Jenis Inv</label>
                                <select name="id_jenis" class="form-control select2" id="pilihJenis">
                                    <option value="">- Pilih Jenis -</option>
                                    @foreach ($nominal as $n)
                                    <option nominal="{{ $n->nominal }}" value="{{ $n->id_nominal }}">
                                        {{ $n->nm_jenis }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nominal</label>
                                <input type="text" id="nominalBayar" name="rupiah" readonly class="form-control">

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

{{-- form tambah --}}
<form action="{{ route('save_status') }}" method="post">
    @csrf
    <div class="modal fade text-left" id="pay" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Pembayaran Screening
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <input type="hidden" id="id_invoice" name="id_invoice">
                <div class="modal-body">
                    <div class="row text-center">
                        <h5>--Product--</h5>
                        <table width="100%" class="table">
                            <tr>
                                <td style="text-align: left">Appointment</td>
                                <td style="text-align: right">200,000</td>
                            </tr>
                        </table>
                        <table width="100%" class="table">
                            <tr>
                                <th>Pembayaran</th>
                                <th>
                                    <select name="pembayaran" id="" class="form-control choices">
                                        <option value="">- Pilih pembayaran -</option>
                                        <option value="CASH">CASH</option>
                                        <option value="BCA">BCA</option>
                                        <option value="MANDIRI">MANDIRI</option>
                                    </select>
                                </th>
                            </tr>

                        </table>
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

            </div>
        </div>
    </div>
</form>
{{-- form tambah --}}
<div class="modal fade text-left" id="view_member" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load_view_member"></div>


        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
            $('.select2').select2({
                dropdownParent: $('#tambah')
            });
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
            $(document).on('change', '.pilih_rek', function() {
                var member_id = $(this).val();
                $.ajax({
                    url: "{{ route('get_pasien') }}",
                    data: {
                        member_id: member_id,
                    },
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        $('.nama').val(data.nama);
                    }
                });
            })

            $(document).on('click', '.pay', function() {
                var id_invoice = $(this).attr('id_invoice')
                $("#id_invoice").val(id_invoice);
            })

            $(document).on('click', '.edit_invoice', function() {
                var id_invoice_periksa = $(this).attr('id_invoice_periksa')
                $("#id_edit").val(id_invoice_periksa);

                $.ajax({
                    type: "GET",
                    url: "{{ route('editInput') }}?id=" + id_invoice_periksa,
                    success: function(r) {

                        $("#editInput").html(r);
                    }
                });
            })

            $("#pilihJenis").on("change", function() {
                var nominal = $('option:selected', this).attr('nominal');
                $('#nominalBayar').val(nominal)
            });

            function readMore() {
                $(document).on('click', '.readMore', function() {
                    var id = $(this).attr('id')
                    $(".teksLimit" + id).css('display', 'none')
                    $(".teksFull" + id).css('display', 'block')
                })
                $(document).on('click', '.less', function() {
                    var id = $(this).attr('id')
                    $(".teksLimit" + id).css('display', 'block')
                    $(".teksFull" + id).css('display', 'none')
                })
            }
            readMore()

        });
</script>
@endsection