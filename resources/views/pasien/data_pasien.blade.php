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

                    <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn icon icon-left btn-primary"
                        style="float: right; margin-left:5px;"><i class="bi bi-plus"></i>
                        Tambah</a>
                    @if (Auth::user()->role == 'Presiden')
                    <a href="#" data-bs-toggle="modal" data-bs-target="#import" class="btn icon icon-left btn-primary"
                        style="float: right;"><i class="fas fa-file-import"></i>
                        Import</a>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No Rekam Medis</th>
                                <th>Nama</th>
                                <th >Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pasien as $no => $n)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $n->member_id }}</td>
                                @if (strlen($n->nama_pasien) > 60)
                                <td>
                                    <span class="teksLimit{{ $n->id_pasien }}">
                                        {{ Str::limit($n->nama_pasien, 60, '...') }}
                                        <a href="#" class="readMore" id="{{ $n->id_pasien }}">read
                                            more</a>
                                    </span>
                                    <span class="teksFull{{ $n->id_pasien }}" style="display:none">{{ $n->nama_pasien }} <a
                                            href="#" class="less" id="{{ $n->id_pasien }}">less</a></span>
                                </td>
                                @else
                                <td>
                                    {{ $n->nama_pasien }}
                                </td>
                                @endif


                                <td>
                                    <a href="#" class="btn btn-primary btn-sm detail" data-bs-toggle="modal"
                                        data-bs-target="#detail" id_pasien="{{ $n->id_pasien }}"><i
                                            class="bi bi-eye"></i></a>
                                    <a href="#" class="btn btn-primary btn-sm edit" data-bs-toggle="modal"
                                        data-bs-target="#edit" id_pasien="{{ $n->id_pasien }}"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a onclick="return confirm('yakin dihapus ?')"
                                        href="{{ route('delete_pasien', ['id_pasien' => $n->id_pasien]) }}"
                                        class="btn btn-warning btn-sm"><i class="bi bi-trash"></i></a>
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
<form action="{{ route('save_pasien') }}" method="post">
    @csrf
    <div class="modal fade text-left" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog  modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Tambah Data Paisen
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">No Rekam Medis</label>
                                <input value="{{ $member_id }}" required type="text" name="member_id"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Tanggal Lahir</label>
                                <input required type="date" name="tgl_lahir" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Nama Pasien</label>
                                <input required type="text" name="nama" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">No Telpon / Hp</label>
                                <input required type="text" name="no_telpon" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input required type="text" name="alamat" class="form-control">
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

{{-- detail pasien --}}
<div class="modal fade text-left" id="detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">
                    Detail Paisen
                </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="detail_modal"></div>
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


{{-- edit pasien --}}
<form action="{{ route('edit_pasien') }}" method="post">
    @csrf
    <div class="modal fade text-left" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
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

{{-- import --}}
<div class="modal fade" id="import" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('importPaketPasien') }}" enctype="multipart/form-data" method="post">
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
                                    <a href="{{ route('exportFormatPasien') }}" class="btn btn-primary btn-sm"><i
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
        <div class="modal fade text-left" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
            aria-hidden="true">
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
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
            $(document).on('click', '.edit', function(e){
                e.preventDefault()
                var id_pasien = $(this).attr('id_pasien');
                $.ajax({
                    url: "{{ route('get_edit_pasien') }}?id_pasien=" + id_pasien,
                    method: "Get",
                    success: function(data) {
                        $('#edit_modal').html(data);
                    }
                });
            })
            
            $(document).on('click', '.detail', function(e){
                e.preventDefault()
                var id_pasien = $(this).attr('id_pasien');
                $.ajax({
                    url: "{{ route('detail_pasien') }}?id_pasien=" + id_pasien,
                    method: "Get",
                    success: function(data) {
                        $('#detail_modal').html(data);
                    }
                });
            })


            function readMore() {
                $(document).on('click', '.readMore', function(e) {
                    e.preventDefault()
                    var id = $(this).attr('id')
                    $(".teksLimit" + id).css('display', 'none')
                    $(".teksFull" + id).css('display', 'block')
                })
                $(document).on('click', '.less', function(e) {
                    e.preventDefault()
                    var id = $(this).attr('id')
                    $(".teksLimit" + id).css('display', 'block')
                    $(".teksFull" + id).css('display', 'none')
                })
            }
            readMore()


        });
</script>
@endsection