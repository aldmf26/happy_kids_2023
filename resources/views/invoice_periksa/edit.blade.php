<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="">Nama Dokter</label>
            <select name="id_dokter" id="" class="choices form-select">
                <option value="">--Pilih dokter--</option>
                @foreach ($dokter as $d)
                <option value="{{$d->id_dokter}}">{{$d->nm_dokter}}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="form-group">
            <label for="">Pembayaran</label>
            <select name="pembayaran" id="" class="form-control choices">
                <option value="">- Pilih pembayaran -</option>
                <option value="CASH">CASH</option>
                <option value="BCA">BCA</option>
                <option value="MANDIRI">MANDIRI</option>
            </select>
        </div>
    </div>
</div>