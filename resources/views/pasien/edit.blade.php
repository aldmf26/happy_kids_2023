<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">No Rekam Medis</label>
            <input required type="text" name="member_id" class="form-control" value="{{$pasien->member_id}}">
            <input required type="hidden" name="id_pasien" class="form-control" value="{{$pasien->id_pasien}}">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Tanggal Lahir</label>
            <input required type="date" name="tgl_lahir" class="form-control" value="{{$pasien->tgl_lahir}}">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Nama</label>
            <input required type="text" name="nama" class="form-control" value="{{$pasien->nama_pasien}}">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">No Telpon / Hp</label>
            <input required type="text" name="no_telpon" class="form-control" value="{{$pasien->no_hp}}">
        </div>
    </div>
    <div class="col-lg-8">
        <div class="form-group">
            <label for="">Alamat</label>
            <input required type="text" value="{{ $pasien->alamat }}" name="alamat" class="form-control">
        </div>
    </div>
</div>