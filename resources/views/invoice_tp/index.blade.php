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
                        <a href="#" data-bs-toggle="modal" data-bs-target="#tambah"
                            class="btn icon icon-left btn-primary" style="float: right;"><i class="bi bi-plus"></i>
                            Buat Invoice Baru</a>
                        <x-btn-aldi />

                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Member ID</th>
                                    <th>No Order</th>
                                    <th>Nama Pasien</th>
                                    <th>Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($invoice_tp as $n)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ date('d-m-Y', strtotime($n->tgl)) }}</td>
                                        <td>{{ kode($n->member) }}</td>
                                        <td>{{ $n->no_order }}</td>
                                        <td>{{ $n->nama_pasien }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $n->pembayaran != 'belum' ? 'primary' : 'warning' }}">{{ $n->pembayaran != 'belum' ? 'Paid : ' . strtoupper($n->pembayaran) : 'Unpaid' }}
                                            </span>
                                        </td>

                                        <td>
                                            <a target="_blank"
                                                href="{{ route('cetak_invoice_tp', ['id_invoice_therapy' => $n->id_invoice_therapy, 'member_id' => $n->member_id]) }}"
                                                class="btn btn-primary btn-sm"><i class="bi bi-printer"></i></a>

                                            {{-- <a href="#" class="btn btn-primary edit_invoice btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#edit" id_invoice_therapy="{{$n->id_invoice_therapy}}"><i
                                            class="bi bi-pencil-square"></i>
                                    </a> --}}
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

    <form action="{{ route('save_tp') }}" method="post">
        @csrf
        <div id="tambah" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">>
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">
                            Tambah Data Invoive Therapy & Paket
                        </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <label for="">No Rekam Medis</label>
                                    <select name="member_id" id="" class="select2 pilih_rek">
                                        <option value="">--Pilih data--</option>
                                        @foreach ($dt_pasien as $d)
                                            <option value="{{ $d->id_pasien }}">{{ kode($d->member_id) }} -
                                                {{ $d->nama_pasien }} - {{ $d->tgl_lahir }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input required type="date" name="tgl" value="{{ date('Y-m-d') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Pembayaran</label>
                                    <select required name="pembayaran" id="" class="select2">
                                        <option value="">- Pilih pembayaran -</option>
                                        <option value="CASH">CASH</option>
                                        <option value="BCA">BCA</option>
                                        <option value="MANDIRI">MANDIRI</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <hr>
                            </div>


                            <div class="col-lg-4">
                                <label for="">Paket</label>
                                <select name="id_paket[]" id="" member_id=""
                                    class=" form-select pilih_paket select2" count="1">
                                    <option value="">--Pilih data--</option>
                                    @foreach ($paket as $p)
                                        <option value="{{ $p->id_paket }}">{{ $p->nama_paket }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-3">
                                <label for="">Therapist</label>
                                <select name="" id="terapiBelumLoad1" class="form-control" disabled>
                                    <option value="">- Pilih Therapis -</option>
                                </select>
                                <div id="loadTerapis1"></div>

                            </div>


                            <div class="col-lg-2">
                                <label for="">Jumlah</label>
                                <input type="number" name="jumlah[]" class="form-control  jumlah1 jumlah"
                                    value="1" count="1">
                            </div>
                            <div class="col-lg-2">
                                <label for="">Total Rupiah</label>
                                <input type="number" name="total_rp[]" class="form-control rp1" readonly>
                                <input type="hidden" class="form-control jlh1">
                            </div>
                            <div class="col-lg-1">
                                <label for="">Aksi</label>
                                <a href="#" class="btn btn-sm btn-primary tambah_paket" member_id=""><i
                                        class="bi bi-plus-square-fill"></i></a>
                            </div>
                            <div class="col-lg-4 mt-2">
                                <div class="form-group">
                                    <label for="">Invoice Registrasi</label> &nbsp;
                                    <input type="checkbox" class="show show1" detail="1" name=""
                                        id="" style="transform: scale(2)">
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <p class="text-danger infoRegistrasi1"></p>
                            </div>
                            <div class="col-lg-4 reg reg1">
                                <div class="form-group">
                                    <label for="">Invoice</label>
                                    <select name="id_invoice" class="form-control inp-reg inp-reg1 select2"
                                        detail='1'>
                                        <option value="">- Pilih Invoice -</option>
                                        @foreach ($nominal as $n)
                                            <option value="{{ $n->id_nominal }}">{{ $n->nm_jenis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 reg reg1">
                                <div class="form-group">
                                    <label for="">Nominal</label>
                                    <input type="text" name="rupiah[]" class="form-control nm-regitrasi1" readonly>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <hr>
                            </div>
                            <div id="tambah_paket">

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
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                dropdownParent: $('#tambah .modal-content')
            });

            $('.pilihan').hide();
            $('.pilihan').attr('disabled', 'true');
            $('.reg').hide();
            $('.inp-reg').attr('disabled', 'true');

            $(document).on('click', '.show', function() {
                var detail = $(this).attr('detail');
                if ($('.show' + detail).prop("checked") == true) {
                    $('.reg' + detail).show();
                    $('.inp-reg' + detail).removeAttr('disabled');
                } else if ($('.show' + detail).prop("checked") == false) {
                    $('.reg' + detail).hide();
                    $('.inp-reg' + detail).attr('disabled', 'true');
                }

            });

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
            });

            $(document).on('change', '.pilih_rek', function() {
                var member_id = $(this).val();
                $('.pilih_paket').attr('member_id', member_id);
                $('.tambah_paket').attr('member_id', member_id);
            });

            $(document).on('change', '.pilih_paket', function() {
                var count = $(this).attr('count');
                var member_id = $(this).attr('member_id');
                var id_paket = $(this).val();


                $.ajax({
                    url: "{{ route('get_pasien') }}",
                    data: {
                        id_paket: id_paket,
                        member_id: member_id,
                    },
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        if (data.kunjungan) {
                            if (data.tglTerakhir >= 6) {
                                $(".infoRegistrasi" + count).text(
                                    'Maaf anda harus membayar registrasi lagi karena telah melebihi batas registrasi '
                                )
                                $(".show" + count).attr('checked', 'true')
                                $('.reg' + count).show();
                                $('.inp-reg' + count).removeAttr('disabled');
                            } else {
                                $(".infoRegistrasi" + count).text('')
                                $(".show" + count).removeAttr('checked')
                                $('.reg' + count).hide();
                                $('.inp-reg' + count).attr('disabled');
                            }

                        } else {
                            $(".infoRegistrasi" + count).text(
                                'Maaf anda harus bayar registrasi untuk pertama kali')
                            $(".show" + count).attr('checked', 'true')
                            $('.reg' + count).show();
                            $('.inp-reg' + count).removeAttr('disabled');
                        }
                        $('.nama').val(data.nama);
                    }
                });

                $.ajax({
                    url: "{{ route('get_paket') }}",
                    data: {
                        id_paket: id_paket,
                    },
                    type: "GET",
                    success: function(data) {
                        var harga = parseFloat(data);
                        var jumlah = $('.jumlah' + count).val();
                        var total = harga * jumlah;
                        $('.rp' + count).val(total);
                        $('.jlh' + count).val(harga);

                    }
                });

                $.ajax({
                    type: "GET",
                    url: "{{ route('loadTerapis') }}?id_paket=" + id_paket,
                    success: function(r) {
                        $('#loadTerapis' + count).html(r)
                        $('.select2').select2({
                            dropdownParent: $('#tambah .modal-content')
                        });
                        $('#terapiBelumLoad' + count).css('display', 'none')
                    }
                });
            });
            $(document).on('keyup change', '.jumlah', function() {
                var count = $(this).attr('count');
                var jumlah = $(this).val();
                var harga = $('.jlh' + count).val();
                var total = harga * jumlah;
                $('.rp' + count).val(total);
            });


            $(document).on('click', '.pay', function() {
                var id_invoice = $(this).attr('id_invoice')
                $("#id_invoice").val(id_invoice);
            });

            var count = 1;
            $(document).on('click', '.tambah_paket', function() {
                var id_akun = $(this).attr('id_akun');
                var member_id = $(this).attr('member_id');

                count = count + 1;
                $.ajax({
                    url: "{{ route('tambah_paket') }}?count=" + count + "&member_id=" + member_id,
                    type: "Get",
                    success: function(data) {
                        $('#tambah_paket').append(data);
                        $(".select2").select2({
                            dropdownParent: $('#tambah .modal-content')
                        });
                        $('.reg' + count).hide();
                        $('.inp-reg' + count).attr('disabled', 'true');
                    }
                });
            });

            $(document).on('click', '.remove_monitoring', function() {
                var delete_row = $(this).attr('count');
                $('#row' + delete_row).remove();
            });

            $(document).on('click', '.view', function() {
                var no_order = $(this).attr('no_order')
                $.ajax({
                    url: "{{ route('view_paket') }}?no_order=" + no_order,
                    type: "Get",
                    success: function(data) {
                        $('#view_paket').html(data);
                    }
                });
            });
            $(document).on('click', '.view2', function() {
                var no_order = $(this).attr('no_order');
                var id_paket = $(this).attr('id_paket');
                $.ajax({
                    url: "{{ route('view_paket2') }}?no_order=" + no_order + "&id_paket=" +
                        id_paket,
                    type: "Get",
                    success: function(data) {
                        $('#view_paket2').html(data);
                        $('#view2').modal('show');
                    }
                });
            });
            $(document).on('change', '.inp-reg', function() {
                var detail = $(this).attr('detail');
                var id_nominal = $('.inp-reg' + detail).val();


                $.ajax({
                    url: "{{ route('nominal_invoice_registrasi') }}?id_nominal=" + id_nominal +
                        "&detail=" + detail,
                    type: "Get",
                    success: function(data) {
                        $('.nm-regitrasi' + detail).val(data);
                    }
                });
            });

        });
    </script>
@endsection
