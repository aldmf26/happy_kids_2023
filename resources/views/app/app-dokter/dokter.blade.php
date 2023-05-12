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
                    <a href="#" data-bs-toggle="modal" data-bs-target="#view-tgl"
                        class="btn icon icon-left btn-primary"><i class="bi bi-calendar-check"></i>
                        View Tgl lain
                    </a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#plus-appointment"
                        class="btn icon btn-primary"><i class="bi bi-plus"></i>
                        Appointment
                    </a>
                    <a href="{{ route('kelola_appoinment', ['view_tgl' => $tgl]) }}" class="btn icon btn-primary"><i
                            class="bi bi-card-checklist"></i>
                        Kelola Appointment
                    </a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#print-appointment"
                        class="btn icon btn-primary"><i class="bi bi-printer"></i>
                        Print Appointment
                    </a>
                </div>
                <div class="card-body">
                    <div id="sked2"></div>
                </div>
            </div>
        </section>
    </div>

</div>


{{-- form view tanggal --}}
<form action="{{ route('print_appoinment') }}" method="get">
    <div class="modal fade text-left" id="print-appointment" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Pilih Tanggal
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
                                <input type="date" name="tgl1" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Sampai</label>
                                <input type="date" name="tgl2" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Dokter</label>
                                <select name="dokter" id="" class="form-control">
                                    <option value="all">All</option>
                                    @foreach ($dokter as $i)
                                    <option value="{{ $i->id_dokter }}">{{ $i->nm_dokter }}</option>
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

            </div>
        </div>
    </div>
</form>
{{-- form view tanggal --}}
{{-- form view tanggal --}}
<form action="" method="get">
    <div class="modal fade text-left" id="view-tgl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        View Tanggal
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" name="view_tgl" class="form-control">
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
{{-- form view tanggal --}}

{{-- plus app --}}
<form id="save_terapi" action="{{ route('save_dokter_app') }}" method="post">
    @csrf
    <div class="modal fade text-left" id="plus-appointment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
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
                            <input type="hidden" name="tgl" value="{{ $tgl }}">
                            <div class="form-group">
                                <label for="">Pasien</label>
                                <select name="customer[]" id="" class="form-control">
                                    <option value="">- Pilih Pasien -</option>
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
                                <input type="time" name="jam[]" min="09:00" max="15:00" class="form-control">
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
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Save</span>
                    </button>
                </div>

            </div>
        </div>
    </div>
</form>
{{-- end plus app --}}

{{-- form view tanggal --}}
<form action="{{ route('hapus_dokter_app') }}" method="post">
    @csrf
    <div class="modal fade text-left" id="hapus-appointment" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Hapus Appointment
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Dokter</label>
                        <select name="dokter" id="" class="form-control">
                            <option value="">- Pilih Dokter -</option>
                            @foreach ($dokter as $i)
                            <option value="{{ $i->id_dokter }}">{{ $i->nm_dokter }}</option>
                            @endforeach
                        </select>
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
{{-- form view tanggal --}}
<?php
    $tgl2 = date('Y-m-d');
    $awal = date_create($tgl2);
    $akhir = date_create();
    $diff = date_diff($awal, $akhir);
    $hari = $diff->d;
    $jam = $diff->h;
    $convert_jam = $hari * 24;
    ?>

<input type='hidden' id='jam' value='<?= $convert_jam ?>'>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
            var c = 1
            tambahTerapi(c)

            function tambahTerapi(c) {
                $(document).on('click', '#tambah_terapi', function() {
                    c++
                    $.ajax({
                        type: "GET",
                        url: "{{ route('tambah_terapi') }}?c=" + c,
                        success: function(r) {
                            $("#view_tambah_terapi").append(r);
                        }
                    });
                })
                $(document).on('click', '.remove_terapi', function() {
                    var delete_row = $(this).attr("count");
                    $('#row' + delete_row).remove();
                })
            }
            var locations = <?= $datas ?>;
            var events = <?= $event ?>;
            // -------------------------- Helpers ------------------------------
            function today(hours, minutes) {
                var date = new Date();
                date.setHours(hours, minutes, 0, 0);
                return date;
            }

            function custom(hours, minutes) {
                var hour = document.getElementById("jam").value;
                var a = parseInt(hour);
                var date = today(hours, minutes);
                date.setTime(date.getTime() - a * 60 * 60 * 1000);
                return date;
            }

            function besok(hours, minutes) {
                var hour = document.getElementById("jam").value;
                var a = parseInt(hour);
                var date = today(hours, minutes);
                date.setTime(date.getTime() + a * 60 * 60 * 1000);
                return date;
            }

            function yesterday(hours, minutes) {
                var date = today(hours, minutes);
                date.setTime(date.getTime() - 24 * 60 * 60 * 1000);
                return date;
            }

            function tomorrow(hours, minutes) {
                var date = today(hours, minutes);
                date.setTime(date.getTime() + 24 * 60 * 60 * 1000);
                return date;
            }
            var sked2Config = {
                caption: 'Dokter',
                start: besok(9, 0),
                end: besok(17, 0),
                showEventTime: true,
                showEventDuration: true,
                locations: locations.map(function(location) {
                    var newLocation = $.extend({}, location);
                    delete newLocation.tzOffset;
                    return newLocation;
                }),
                events: events.slice(),
                tzOffset: 0,
                sorting: true,
                orderBy: 'name',
                formatters: {
                    date: function(date) {
                        return $.fn.skedTape.format.date(date, "l", ".");
                    },
                    duration: function(ms, opts) {
                        return $.fn.skedTape.format.duration(ms, {
                            hrs: " jam.",
                            min: " menit."
                        });
                    },
                },
                postRenderEvent: function($el, event) {
                    if (event.className == 'Y') {
                        $el.prepend('<span class="text-warning"><strong>PAID</strong></span> ');
                    } else {
                        if (event.url == 'Selesai') {
                            $el.prepend('<i class="fas fa-thumbs-up"></i> ');
                        } else {
                            $el.prepend('<i class="fas fa-times-circle"></i>');
                        }
                    }

                }
            };
            var $sked2 = $.skedTape(sked2Config);
            $sked2.appendTo('#sked2').skedTape('render');
            //$sked2.skedTape('destroy');
            $sked2.skedTape(sked2Config);
        });
</script>
<script>
    $(document).ready(function() {
            $(".sked-tape__event").each(function() {
                var colorR = Math.floor((Math.random() * 256));
                var colorG = Math.floor((Math.random() * 256));
                var colorB = Math.floor((Math.random() * 256));
                $(this).css("background-color", "rgb(" + colorR + "," + colorG + "," + colorB + ")");
            });
        });
</script>
@endsection