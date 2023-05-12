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
                            <li class="breadcrumb-item"><a href="index.html">{{ $title }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                  <form action="{{ route('add_foto') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
            
                        <div class="col-md-6">
                            <input type="file" name="image" class="form-control">
                        </div>
             
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">Upload</button>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#setting" class="btn btn-primary"><i class="bi bi-wrench"></i> Setting Foto</a>
                        </div>
                     
                    </div>
                </form>

                </div>
                <div class="card-body">
                    <table class="table table-hover" id="table1">
                        <thead>
                            <tr>
                              <th class="text-center">Foto</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($foto as $no => $f)
                                
                            <tr>
                              <td class="text-center">
                                <a class="view_foto" nm_foto="{{$f->nm_foto}}" href="#" data-bs-toggle="modal" data-bs-target="#edit">
                                  <img src="{{ asset("images-upload/$f->nm_foto") }}"  width="80" height="80">
                                </a>
                              </td>
                              <td>
                                
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

{{-- form setting foto web --}}
<div class="modal fade text-left" id="setting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel33">
          Setting Image
        </h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <form action="#">
        <div class="modal-body">
            <div class="row">
              <div class="col-6">
                <select name="example" class="form-control select2" id="">
                    <option value="">- Pilih Gambar -</option>
                    @foreach ($foto as $f)
                        <option value="{{ $f->id_foto }}">{{ $f->nm_foto }}</option>
                    @endforeach
                </select>
              </div>
              <div class="col-6">
                <input type="text" readonly value="Hero Image" class="form-control">
              </div>
            </div>
        </div>
      </form>
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
          View Image
        </h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <form action="#">
        <div class="modal-body">
          <img id="load_foto" alt="" width="100%" height="50%">
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('scripts')
  <script>
    $(document).ready(function () {
      $(".view_foto").click(function (e) { 
        e.preventDefault();
        var nm_foto = $(this).attr('nm_foto')
        var nm_foto = `{{ asset('images-upload/${nm_foto}') }}`
        $("#load_foto").attr('src', nm_foto);
      });
    });
  </script>
@endsection
