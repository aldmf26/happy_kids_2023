<div class="row">
    <input type="hidden" name="page" value="screening">
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">No Rekam Medis</label>
            <input readonly required value="{{ $member_id + 1 }}" type="text" name="member_id" class="form-control">
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
</div>