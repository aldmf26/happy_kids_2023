
    
    <div class="form-group">
        <input type="hidden" id="id_saldo_therapy" value="{{ $id_saldo_therapy }}">
        <input type="hidden" id="id_terapi_sebelum" value="{{ $id_terapi }}">
        <label for="">Nama Therapist</label>
        <select name="" class="select2" id="namaTerapi">
            @foreach ($data_tp as $t)
                <option {{$t->id_therapy == $id_terapi ? 'selected' : ''}} value="{{ $t->id_therapy }}">{{ $t->nama_therapy }}</option>
            @endforeach
        </select>
    </div>