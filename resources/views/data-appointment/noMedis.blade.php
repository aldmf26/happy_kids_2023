<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
        <label for="">No Rekam Medis</label>
        <select  name="member_id" id="" class="select2 form-select pilih_rek">
            <option value="">--Pilih data--</option>
            <option value="plusPasien"><a href="{{ route('data_pasien') }}">+ Pasien</a></option>
            @foreach ($dt_pasien as $d)
                <option value="{{$d->member_id}}">{{$d->member_id}} - {{ $d->nama_pasien }} - {{ $d->tgl_lahir }}</option>
            @endforeach
        </select>
    </div>
    </div>
    
</div>