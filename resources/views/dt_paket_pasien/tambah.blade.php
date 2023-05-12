

<div class="row" id="row{{ $count }}">
    <div class="col-lg-4">
        <div class="form-group">
            <select name="id_paket[]" id="" member_id="" class=" form-select pilih_paket select2"
                count="{{ $count }}">
                <option value="">--Pilih data--</option>
                @foreach ($paket as $p)
                    <option value="{{ $p->id_paket }}">{{ $p->nama_paket }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <select name="" id="terapiBelumLoad{{ $count }}" class="form-control" disabled>
            <option value="">- Pilih Therapis -</option>
        </select>
        <div id="loadTerapis{{ $count }}"></div>

    </div>

    <div class="col-lg-2">
        <input type="number" name="jumlah[]" class="form-control jumlah jumlah{{ $count }}" value="1"
            count="{{ $count }}">
    </div>
    <div class="col-lg-2">
        <a href="#" class="btn btn-sm btn-warning remove_monitoring" count="{{ $count }}"><i
            class="bi bi-dash-square-fill"></i></a>
    </div>
</div>
