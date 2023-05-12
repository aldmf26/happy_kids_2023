<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="">Nama Paket</label>
            <input required type="text" name="nama_paket" class="form-control" value="{{$paket->nama_paket}}">
            <input required type="hidden" name="id_paket" class="form-control" value="{{$paket->id_paket}}">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="">Harga</label>
            <input required type="text" name="harga" class="form-control" value="{{$paket->harga}}">
        </div>
    </div>
</div>