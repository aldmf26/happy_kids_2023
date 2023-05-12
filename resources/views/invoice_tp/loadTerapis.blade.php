<select name="id_therapist[]" id="" class="form-control select2">
    <option value="">--Pilih data--</option>
    @foreach ($therapist as $p)
    <option value="{{$p->id_therapy}}">{{$p->nama_therapy}}</option>
    @endforeach
</select>