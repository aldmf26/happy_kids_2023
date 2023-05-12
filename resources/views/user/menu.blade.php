@extends('theme.app')
@section('content')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">

        <section class="section">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 style="float: left;">Menu</h3>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn icon icon-left btn-primary" style="float: right;"><i
                                    class="bi bi-plus"></i>
                                Tambah</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" >
                                <thead>
                                    <tr>
                                        <th>Sub Menu</th>
                                        <th>Urutan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menu as $no => $n)
                                        <tr>
                                            <td>{{ $n->urutan }}</td>
                                            <td>{{ $n->sub_menu }}</td>
                                  
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-caret-down-fill"></i>
                                                      </button>
                                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                         
                                                          <a href="#" data-bs-toggle="modal" data-bs-target="#edit{{ $n->id_sub_menu }}"
                                                            class="dropdown-item"
                                                            >Edit</a>
                                                          <a onclick="return confirm('Yakin dihapus ?')" href="{{ route("delMenu", ['id' => $n->id_sub_menu, 'jenis' => 1]) }}" class="dropdown-item">Hapus</a>
                                                      </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 style="float: left;">Dashboard</h3>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn icon icon-left btn-primary" style="float: right;"><i
                                    class="bi bi-plus"></i>
                                Tambah</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" >
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th>Urutan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dashboard as $no => $n)
                                        <tr>
                                            <td>{{ $n->urutan }}</td>
                                            <td>{{ $n->teks }}</td>
                                  
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-caret-down-fill"></i>
                                                      </button>
                                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                         
                                                          <a href="#" data-bs-toggle="modal" data-bs-target="#edit{{ $n->id }}"
                                                            class="dropdown-item"
                                                            >Edit</a>
                                                          <a onclick="return confirm('Yakin dihapus ?')" href="{{ route("delMenu", ['id' => $n->id, 'jenis' => 2]) }}" class="dropdown-item">Hapus</a>
                                                      </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 style="float: left;">Void</h3>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn icon icon-left btn-primary" style="float: right;"><i
                                    class="bi bi-plus"></i>
                                Tambah</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" >
                                <thead>
                                    <tr>
                                        <th>Sub Menu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($void as $no => $n)
                                        <tr>
                                            <td>{{ $n->teks }}</td>
                                  
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-caret-down-fill"></i>
                                                      </button>
                                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                         
                                                          <a href="#" data-bs-toggle="modal" data-bs-target="#edit{{ $n->id }}"
                                                            class="dropdown-item"
                                                            >Edit</a>
                                                          <a onclick="return confirm('Yakin dihapus ?')" href="{{ route("delMenu", ['id' => $n->id, 'jenis' => 3]) }}" class="dropdown-item">Hapus</a>
                                                      </ul>
                                                </div>
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
@endsection