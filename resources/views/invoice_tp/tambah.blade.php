<div class="row" id="row{{$count}}">
    <div class="col-lg-4 mt-2">

        <select name="id_paket[]" member_id="{{$member_id}}" id="" class=" form-select pilih_paket select2"
            count="{{$count}}">
            <option value="">--Pilih data--</option>
            @foreach ($paket as $p)
            <option value="{{$p->id_paket}}">{{$p->nama_paket}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-3 mt-2">

        <select name="" id="terapiBelumLoad{{$count}}" class="form-control" disabled>
            <option value="">- Pilih Therapis -</option>
        </select>
        <div id="loadTerapis{{$count}}"></div>
    </div>

    <div class="col-lg-2 mt-2">

        <input type="number" name="jumlah[]" class="form-control jumlah jumlah{{$count}}" value="1" count="{{$count}}">
    </div>
    <div class="col-lg-2 mt-2">
        <input type="number" name="total_rp[]" class="form-control rp{{$count}}" readonly>
        <input type="hidden" class="form-control jlh{{$count}}">
    </div>
    <div class="col-lg-1 mt-2">
        <a href="#" class="btn btn-sm btn-warning remove_monitoring" count="{{$count}}"><i
                class="bi bi-dash-square-fill"></i></a>
    </div>
    <div class="col-lg-4 mt-2">
        <div class="form-group">
            <label for="">Invoice Registrasi</label> &nbsp;
            <input type="checkbox" class="show show{{$count}}" detail="{{$count}}" name="" id=""
                style="transform: scale(2)">
        </div>
    </div>
    <div class="col-lg-8">
        <p class="infoRegistrasi{{$count}} text-danger"></p>
    </div>
    <div class="col-lg-4 reg reg{{$count}}">
        <div class="form-group">
            <label for="">Invoice</label>
            <select name="id_invoice" class="form-control inp-reg inp-reg{{$count}} select2" detail='{{$count}}'>
                <option value="">- Pilih Invoice -</option>
                @foreach ($nominal as $n)
                <option value="{{ $n->id_nominal }}">{{ $n->nm_jenis }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 reg reg{{$count}}">
        <div class="form-group">
            <label for="">Nominal</label>
            <input type="text" name="rupiah[]" class="form-control nm-regitrasi{{$count}}" readonly>
        </div>
    </div>
    <div class="col-lg-12">
        <hr>
    </div>
</div>