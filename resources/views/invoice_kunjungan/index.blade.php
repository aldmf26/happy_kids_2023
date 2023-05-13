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
                    <x-btn-aldi  />
                  
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
                                {{-- <th>Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($invoice_kunjungan as $n)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ date('d-m-Y', strtotime($n->tgl)) }}</td>
                                <td>{{ kode($n->member) }}</td>
                                <td>{{ $n->no_order }}</td>
                                <td>
                                    
                                   <a href="#" data-bs-toggle="modal" class="detailSaldo" no_order="{{$n->no_order}}" data-bs-target="#detailSaldo" member_id="{{$n->member_id}}">
                                    {{ $n->nama_pasien }}
                                    </a>
                                </td>
                                {{-- <td>
                                    <a href="#" class="btn btn-primary edit_invoice btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#edit" id_invoice_kunjungan="{{$n->id_invoice_kunjungan}}"><i
                                            class="bi bi-pencil-square"></i>
                                    </a>
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

<form action="{{ route('save_invoice_kunjungan') }}" method="post">
    @csrf
    <div class="modal fade text-left" id="tambah">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Tambah {{$title}}
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                            <label for="">No Rekam Medis</label>
                            <select name="member_id" id="" class="choices form-select pilih_rek">
                                <option value="">--Pilih data--</option>
                                @foreach ($dt_pasien as $d)
                                <option value="{{$d->id_pasien}}">{{kode($d->member_id)}} - {{$d->nama_pasien}} - {{$d->tgl_lahir}}</option>
                                @endforeach
                            </select>
                        </div>

                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input  required type="date" name="tgl" value="{{date('Y-m-d')}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        

                        {{-- <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nama Pasien</label>
                                <input required type="text" class="form-control nama" disabled>
                            </div>
                        </div> --}}

                        <div class="col-lg-12">
                            <hr>
                        </div>
                        <div id="dt_paket"></div>

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
<div class="modal fade text-left" id="detailSaldo">
    <div class="modal-dialog  modal-lg" role="document">
        <div id="loadDetailSaldo"></div>
        
    </div>
</div>




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

                $.ajax({
                    url: "{{ route('data_paket_kunjungan') }}",
                    data: {
                        member_id: member_id,
                    },
                    type: "GET",
                    success: function(data) {
                        $('#dt_paket').html(data);   
                    }
                });
            });
            $(document).on('change', '.pilih_rek', function() {
                var member_id = $(this).val();
                $.ajax({
                    url: "{{ route('get_pasien') }}",
                    data: {
                        member_id: member_id,
                    },
                    type: "GET",
                    dataType : 'json',
                    success: function(data) {
                        $('.nama').val(data.nama);
                    }
                });
                $.ajax({
                    url: "{{ route('get_paket_kunjungan') }}",
                    data: {
                        member_id: member_id,
                    },
                    type: "GET",
                    success: function(data) {
                        
                        $('#id_order').html(data);
                    }
                });
            });
          
            $(document).on('change', '.pilih_paket', function() {
                var count =  $(this).attr('count');
                var id_paket = $(this).val();
                
            
                $.ajax({
                    url: "{{ route('get_paket') }}",
                    data: {
                        id_paket: id_paket,
                    },
                    type: "GET",
                    success: function(data) {
                        var harga =  parseFloat(data);
                        var jumlah =  $('.jumlah' + count).val();
                        var total = harga * jumlah;
                        $('.rp' + count).val(total);
                        $('.jlh' + count).val(harga);
                        
                    }
                });
            });
            
            
            $(document).on('keyup', '.jumlah', function() {
                var count =  $(this).attr('count');   
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
                count = count + 1;
                $.ajax({
                    url: "{{ route('tambah_paket') }}?count=" + count,
                    type: "Get",
                    success: function(data) {
                        $('#tambah_paket').append(data);
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
                    url: "{{ route('view_paket2') }}?no_order=" + no_order + "&id_paket=" + id_paket,
                    type: "Get",
                    success: function(data) {
                        $('#view_paket2').html(data);
                        $('#view2').modal('show'); 
                    }
                });
            });

            $(document).on('click', '.detailSaldo', function(){
                var member_id = $(this).attr('member_id')
                var no_order = $(this).attr('no_order')

                $.ajax({
                    type: "GET",
                    url: "{{route('detailSaldo')}}",
                    data:{
                        member_id:member_id,
                        no_order:no_order
                    },
                    success: function (r) {
                        $("#loadDetailSaldo").html(r);
                    }
                });
            })

        });
</script>
@endsection