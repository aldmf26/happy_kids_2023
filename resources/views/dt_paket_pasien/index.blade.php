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
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                @if (Auth::user()->role == 'Presiden')
                                <a href="#" data-bs-toggle="modal" data-bs-target="#tambah"
                                        class="btn icon icon-left btn-primary" style="float: right;"><i
                                            class="bi bi-plus"></i>
                                        Saldo Akhir</a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#import"
                                        class="btn icon icon-left btn-primary me-1" style="float: right;"><i
                                            class="fas fa-file-import"></i>
                                        Import</a>
                                    
                                @endif
                                <x-btn-aldi />
                            </div>
                            <div class="card-body">
                                <table class="table table-hover" id="table1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Member ID</th>
                                            <th>Nama Pasien</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($data_paket_pasien as $n)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ kode($n->member_id) }}</td>
                                                <td>{{ $n->nama_pasien }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $n->saldo == null ? 'success' : 'danger' }}">
                                                        {{ $n->saldo == null ? 'Ok' : 'Paket mau habis' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#view"
                                                        class="btn btn-primary btn-sm view"
                                                        member_id="{{ $n->id_pasien }}"><i class="bi bi-folder-check"></i>
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
    {{-- form tambah --}}
    <form action="{{ route('save_saldo_pasien') }}" method="post">
        @csrf
        <div class="modal fade text-left" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">
                            Tambah Saldo Pasien
                        </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
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
                                    <label for="">Paket</label>
                                    <select name="id_paket[]" id="" member_id=""
                                        class=" form-select pilih_paket select2" count="1">
                                        <option value="">--Pilih data--</option>
                                        @foreach ($paket as $p)
                                            <option value="{{ $p->id_paket }}">{{ $p->nama_paket }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label for="">Therapist</label>
                                <select name="" id="terapiBelumLoad1" class="form-control" disabled>
                                    <option value="">- Pilih Therapis -</option>
                                </select>
                                <div id="loadTerapis1"></div>

                            </div>

                            <div class="col-lg-2">
                                <label for="">Jumlah</label>
                                <input type="number" name="jumlah[]" class="form-control  jumlah1 jumlah" value="1"
                                    count="1">
                            </div>
                            <div class="col-lg-2">
                                <label for="">Aksi</label><br>
                                <a href="#" class="btn btn-sm btn-primary tambah_paket" member_id=""><i
                                        class="bi bi-plus-square-fill"></i></a>
                            </div>
                        </div>
                        <div id="tambah_paket">

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


    {{-- import --}}
    <div class="modal fade" id="import" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('importSaldoPaket') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="modal-content ">
                    <div class="modal-header btn-costume">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Import {{ $title }}</h5>
                        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <table>
                                <tr>
                                    <td width="100" class="pl-2">
                                        <img width="80px" src="{{ asset('images-upload/') }}/1.png" alt="">
                                    </td>
                                    <td>
                                        <span style="font-size: 20px;"><b> Download Excel template</b></span><br>
                                        File ini memiliki kolom header dan isi yang sesuai dengan data produk
                                    </td>
                                    {{-- <td>
                                    <a href="{{ route('exportPaket') }}" class="btn btn-primary btn-sm"><i
                                            class="fa fa-download"></i> DOWNLOAD TEMPLATE</a>
                                </td> --}}
                                    <td>
                                        <a href="{{ route('exportFormatPaket') }}" class="btn btn-primary btn-sm"><i
                                                class="fa fa-download"></i> DOWNLOAD TEMPLATE</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <hr>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="100" class="pl-2">
                                        <img width="80px" src="{{ asset('images-upload/') }}/2.png" alt="">
                                    </td>
                                    <td>
                                        <span style="font-size: 20px;"><b> Upload Excel template</b></span><br>
                                        Setelah mengubah, silahkan upload file.
                                    </td>
                                    <td>
                                        <input type="file" name="file" class="form-control">
                                    </td>
                                </tr>
                            </table>

                        </div>
                        <div class="row">
                            <div class="col-12">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
        </div>
        </form>

        {{-- edit pasien --}}
        <form action="{{ route('edit_pasien') }}" method="post">
            @csrf
            <div class="modal fade text-left" id="edit" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel33" aria-hidden="true">
                <div class="modal-dialog  modal-lg modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">
                                Edit Data Paisen
                            </h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="edit_modal"></div>
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
            $('.select2').select2({
                dropdownParent: $('#tambah .modal-content')
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

            var count = 1;
            $(document).on('click', '.tambah_paket', function() {
                var id_akun = $(this).attr('id_akun');
                var member_id = $(this).attr('member_id');
                count = count + 1;
                $.ajax({
                    url: "{{ route('tambah_paket_saldo') }}?count=" + count + "&member_id=" +
                        member_id,
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

            function loadView(member_id) {
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
                    url: "{{ route('view_paket_pasien2') }}?member_id=" + member_id +
                        "&id_paket=" + id_paket,
                    type: "Get",
                    success: function(data) {
                        $('#view_paket2').html(data);
                        $('#view2').modal('show');
                    }
                });
            });
            $(document).on('click', '.editSaldo', function() {
                var member_id = $(this).attr('member_id')
                var id_paket = $(this).attr('id_paket')
                var id_terapi = $(this).attr('id_terapi')
                var id_saldo_therapy = $(this).attr('id_saldo_therapy')
                // alert(id_terapi)

                $("#viewEditSaldo").modal('show')
                $.ajax({
                    type: "GET",
                    url: "{{ route('viewEditTerapi') }}",
                    data: {
                        member_id: member_id,
                        id_paket: id_paket,
                        id_terapi: id_terapi,
                        id_saldo_therapy: id_saldo_therapy,
                    },
                    success: function(r) {
                        $("#viewEditTerapi").html(r)
                        $('.select2').select2({
                            dropdownParent: $('#viewEditSaldo')
                        });
                    }
                });
            })

            $(document).on('submit', '#submitEditTerapi', function(e) {
                e.preventDefault()
                var namaTerapi = $("#namaTerapi").val()
                var id_saldo_therapy = $("#id_saldo_therapy").val()
                var id_terapi_sebelum = $("#id_terapi_sebelum").val()

                $.ajax({
                    type: "GET",
                    url: "{{ route('editPaketTerapi') }}",
                    data: {
                        id_terapi: namaTerapi,
                        id_saldo_terapi: id_saldo_therapy,
                        id_terapi_sebelum: id_terapi_sebelum,
                    },
                    success: function(r) {
                        loadView(r)
                    }
                });
            })

        });
    </script>
@endsection
