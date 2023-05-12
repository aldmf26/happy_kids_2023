<div class="row mt-2 mb-2" id="row{{ $c }}">
    <div class="col-lg-4">
        <div class="form-group">
            <select name="customer[]" id="" class="form-control">
                <option value="">- Pilih Costumer -</option>
                @foreach ($invoice as $i)
                    <option value="{{ $i->id_invoice }}">{{ $i->nama_pasien }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <select name="dokter[]" id="" class="form-control">
                <option value="">- Pilih Dokter -</option>
                @foreach ($dokter as $i)
                    <option value="{{ $i->id_dokter }}">{{ $i->nm_dokter }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
            <input type="time" name="jam[]" class="form-control">
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
            <button type="button" class="btn btn-sm btn-warning remove_terapi" count="{{$c}}"><i class="bi bi-dash"></i></button>
        </div>
    </div>
</div>