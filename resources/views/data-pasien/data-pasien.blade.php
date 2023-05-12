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
                    <a href="#" data-bs-toggle="modal" data-bs-target="#tambah"
                        class="btn icon icon-left btn-primary"><i class="bi bi-plus-circle"></i> Tambah</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Member ID</th>
                                {{-- <th>No Order</th> --}}
                                <th>Tgl</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pasien as $no => $p)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $p->nama_pasien }}</td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#view_member" class="klik_member"
                                        member_id="{{ $p->member_id }}">{{ $p->member_id }}</a>
                                </td>
                                {{-- <td>{{ $p->no_order }}</td> --}}
                                <td>{{ $p->tgl }}</td>
                                <td>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#view"
                                        class="btn btn-sm icon btn-primary klik_view" member_id="{{ $p->member_id }}"><i
                                            class="bi bi-eye"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit"
                                        class="btn btn-sm icon btn-primary"><i class="bi bi-pencil"></i></a>
                                    <a href="#" class="btn btn-sm icon btn-danger"><i class="bi bi-trash"></i></a>
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
<div class="modal fade text-left" id="view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load_view_pasien"></div>


        </div>
    </div>
</div>
{{-- form tambah --}}
<div class="modal fade text-left" id="view_member" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load_view_member"></div>


        </div>
    </div>
</div>


{{-- form edit --}}
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
                    <label>Email: </label>
                    <div class="form-group">
                        <input type="text" placeholder="Email Address" class="form-control" />
                    </div>
                    <label>Password: </label>
                    <div class="form-group">
                        <input type="password" placeholder="Password" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {

            $(document).on('click', '.klik_view', function() {
                var member_id = $(this).attr('member_id')
                $.ajax({
                    type: "GET",
                    url: "{{ route('load_view_pasien') }}?member_id=" + member_id,
                    success: function(r) {
                        $("#load_view_pasien").html(r);
                    }
                });
            })

            $(document).on('click', '.klik_member', function() {
                var member_id = $(this).attr('member_id')
                $.ajax({
                    type: "GET",
                    url: "{{ route('load_view_member') }}?member_id=" + member_id,
                    success: function(r) {
                        $("#load_view_member").html(r);
                    }
                });
            })
        });
</script>
@endsection