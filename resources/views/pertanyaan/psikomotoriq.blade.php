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
                                <li class="breadcrumb-item"><a href="#">{{ $sub_title }}</a></li>
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
                            @php
                                $pertanyaan = ['pertanyaan/1', 'pertanyaan/2', 'pertanyaan/3', 'pertanyaan/4'];
                            @endphp
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('pertanyaan/1') ? 'active' : '' }}" aria-current="page"
                                    href="{{ route('pertanyaan', 1) }}">Psikomotorik</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('pertanyaan/2') ? 'active' : '' }}"
                                    href="{{ route('pertanyaan', 2) }}">KPSP
                                    Pada Anak</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('pertanyaan/3') ? 'active' : '' }}"
                                    href="{{ route('pertanyaan', 3) }}">PEDS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('pertanyaan/4') ? 'active' : '' }}"
                                    href="{{ route('pertanyaan', 4) }}">M-Chat-R</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-header">
                        <a href="#" id="sukses" data-bs-toggle="modal" data-bs-target="#tambah"
                            class="btn icon icon-left btn-primary"><i class="bi bi-plus-circle"></i> Tambah</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Pertanyaan</th>
                                    @if ($kelompok == 2)
                                        <th>Gerak</th>
                                        <th>Kpsp</th>
                                    @endif
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $no => $d)
                                    <tr>
                                        <td class="text-center">{{ $no + 1 }}</td>
                                        <td>{{ $d->pertanyaan }}</td>
                                        @if ($kelompok == 2)
                                            <td>{{ $d->nm_gerak }}</td>
                                            <td>{{ $d->nm_kpsp }}</td>
                                        @endif
                                        <td style="white-space: nowrap">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#edit"
                                                class="btn btn-sm icon btn-primary klik_edit"
                                                pertanyaan="{{ $d->pertanyaan }}" id_pertanyaan="{{ $d->id_pertanyaan }}"
                                                id_gerak="{{ $d->id_gerak }}" id_kel_kpsp="{{ $d->id_kel_kpsp }}"><i
                                                    class="bi bi-pencil"></i></a>
                                            <a href="{{ route('del_pertanyaan', [$d->id_pertanyaan, $kelompok]) }}"
                                                onclick="return confirm('Yakin dihapus ?')"
                                                class="btn btn-sm icon btn-danger"><i class="bi bi-trash"></i></a>
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

    {{-- form tambah --}}
    <form action="{{ route('add_pertanyaan') }}" method="post">
        @csrf
        <div class="modal fade text-left" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">
                            Login Form
                        </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="#">
                        <div class="modal-body">
                            <input type="hidden" name="kelompok" value="{{ $kelompok }}">
                            <label>Pertanyaan :</label>
                            <div class="form-group">
                                <textarea class="form-control" rows="2" name="pertanyaan" id="val_pertanyaan">

            </textarea>

                            </div>
                            @if ($kelompok == 2)
                                <label>Kelompok Gerak :</label>
                                <div class="form-group">
                                    <select name="id_gerak" class="choices form-select" id="">
                                        <option value="0">- Pilih Gerak -</option>
                                        @foreach ($kel_gerak as $k)
                                            <option value="{{ $k->id_gerak }}">{{ $k->nm_gerak }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label>Kelompok Kpsp :</label>
                                <div class="form-group">
                                    <select name="id_kpsp" class="choices form-select" id="">
                                        <option value="0">- Pilih Kpsp -</option>
                                        @foreach ($kel_kpsp as $k)
                                            <option value="{{ $k->id_kel_kpsp }}">{{ $k->nm_kpsp }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            @if ($kelompok == 3)
                                <div class="form-check form-switch">
                                    <input name="pilih" class="form-check-input" type="checkbox"
                                        id="flexSwitchCheckChecked" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Pilihan</label>
                                </div>
                            @endif
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

    {{-- form edit --}}
    <form action="{{ route('edit_pertanyaan') }}" method="post">
        @csrf
        <div class="modal fade text-left" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">
                            Edit Form
                        </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="#">
                        <div class="modal-body">
                            <label>Pertanyaan :</label>
                            <div class="form-group">
                                <input type="hidden" name="kelompok" value="{{ $kelompok }}">
                                <input type="hidden" name="id_pertanyaan" id="load_id_pertanyaan">

                                <textarea rows="2" name="pertanyaan" id="load_pertanyaan" class="form-control"></textarea>
                                {{-- <input autofocus name="pertanyaan" type="text" id="load_pertanyaan"  class="form-control" /> --}}
                            </div>
                            @if ($kelompok == 2)
                                <label>Kelompok Gerak :</label>
                                <div class="form-group">
                                    <div id="load_kel_gerak"></div>


                                </div>
                                <label>Kelompok Kpsp :</label>
                                <div class="form-group">
                                    <div id="load_kel_kpsp"></div>

                                </div>
                            @endif
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
            $(document).on('click', '.klik_edit', function(e) {
                e.preventDefault();
                var pertanyaan = $(this).attr('pertanyaan')
                var id_pertanyaan = $(this).attr('id_pertanyaan')
                var id_gerak = $(this).attr('id_gerak')
                var id_kpsp = $(this).attr('id_kel_kpsp')

                $("#load_pertanyaan").val(pertanyaan);
                $("#load_id_pertanyaan").val(id_pertanyaan);

                $.ajax({
                    type: "GET",
                    url: "{{ route('get_gerak') }}?id_gerak=" + id_gerak,
                    success: function(r) {
                        $("#load_kel_gerak").html(r);
                    }
                });

                $.ajax({
                    type: "GET",
                    url: "{{ route('get_kpsp') }}?id_kpsp=" + id_kpsp,
                    success: function(r) {
                        $("#load_kel_kpsp").html(r);
                    }
                });

            })

        });
    </script>
@endsection
