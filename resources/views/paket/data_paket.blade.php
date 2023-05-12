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
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#tambah"
                                class="btn icon icon-left btn-primary" style="float: right;"><i class="bi bi-plus"></i>
                                Tambah</a>
                        </div>
                        <div class="card-body">
                            <table class="table " id="table1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="text-align: center">Nama Paket</th>
                                        <th style="text-align: center">Harga</th>
                                        <th style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paket as $no => $n)
                                    <tr>
                                        <td>{{ $no+1 }}</td>
                                        <td style="text-align: center">{{ $n->nama_paket }}</td>
                                        <td align="right">{{ number_format($n->harga,0) }}</td>
                                        <td style="text-align: center">
                                            <a href="#" class="btn btn-primary btn-sm edit" data-bs-toggle="modal"
                                                data-bs-target="#edit" id_paket="{{$n->id_paket}}"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            <a href="{{route('delete_paket',['id_paket' =>$n->id_paket ])}}"
                                                class="btn btn-warning btn-sm"><i class="bi bi-trash"></i></a>
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
<form action="{{ route('save_paket') }}" method="post">
    @csrf
    <div class="modal fade text-left" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Tambah Data Paket
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nama Paket</label>
                                <input required type="text" name="nama_paket" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Harga</label>
                                <input required type="text" name="harga" class="form-control">
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
<form action="{{ route('edit_paket') }}" method="post">
    @csrf
    <div class="modal fade text-left" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog  " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Edit Data Paket
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



@endsection
@section('scripts')
<script>
    $(document).ready(function() {
            $('.edit').click(function() {
             
                var id_paket = $(this).attr('id_paket');
                $.ajax({
                    url: "{{ route('get_edit_paket') }}?id_paket="+id_paket,
                    method: "Get",
                    success: function(data) {
                        $('#edit_modal').html(data);
                        
                    }
                });

            });

            
        });
</script>
@endsection