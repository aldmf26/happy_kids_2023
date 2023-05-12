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
                        {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn icon icon-left btn-primary" style="float: right;"><i
                                class="bi bi-plus"></i>
                            Tambah</a> --}}
                    </div>
                    <div class="card-body">
                        <table class="table table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Verifikasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $no => $n)
                                    <tr>
                                        <td>{{ $no+1 }}</td>
                                        <td>{{ $n->name }}</td>
                                        <td>{{ $n->email }}</td>
                                        <td>{{ $n->role }}</td>
                                        <td>
                                            <a href="{{ route('verifikasi', [$n->verifikasi == 'Y' ? 'T' : 'Y', $n->id]) }}" class="btn btn-sm btn-{{$n->verifikasi == 'Y' ? 'primary' : 'warning'}}"><i class="bi bi-{{$n->verifikasi == 'Y' ? 'check' : 'x-circle'}}"></i></a>
                                        </td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal" id_user="{{ $n->id }}" data-bs-target="#permission"
                                                class="btn btn-primary btn-sm permission"
                                                ><i class="bi bi-key"></i></a>
                                            <a onclick="return confirm('Yakin dihapus ?')" href="{{ route("delete_user", $n->id) }}" class="btn btn-warning btn-sm"><i
                                                    class="bi bi-trash"></i></a>
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
    <form action="{{ route('save_user') }}" method="post">
        @csrf
        <div class="modal fade text-left" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
            aria-hidden="true">
            <div class="modal-dialog  modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">
                            Tambah User
                        </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input required placeholder="masukan nama" type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input required type="email" placeholder="masukan email" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input required type="password" name="password" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Role</label>
                                    <select required class="form-select" name="role" id="">
                                        <option value="">- Pilih Role -</option>
                                        <option value="Presiden">Presiden</option>
                                        <option value="Admin">Admin</option>
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

    {{-- permission --}}
    <form action="{{ route('save_permission') }}" method="post">
        @csrf
        <div class="modal fade text-left" id="permission" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">
                            Permission User
                        </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="data_permission"></div>
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
@section('scripts')
<script>
    $(document).ready(function() {
            $('.permission').click(function() {
                var id = $(this).attr('id_user');

                $.ajax({
                    url: "{{ route('permission') }}?id="+id,
                    method: "Get",
                    success: function(data) {
                        $('#data_permission').html(data);
                    }
                });

            });
        });
</script>
@endsection

