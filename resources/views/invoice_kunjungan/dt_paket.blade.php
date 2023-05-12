<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover">
            <tr>
                <th>Therapist</th>
                <th>Paket</th>
                <th>Sisa</th>
                <th width="20%">Dipakai</th>
            </tr>
            @foreach ($invoice_kunjungan as $i)
            @php
                $ttl = $i->debit - $i->kredit;
            @endphp
            @if ($ttl > 0)
            <tr>
                <td>
                    {{$i->nama_therapy}}
                    <input type="hidden" name="id_therapist[]" value="{{$i->id_therapist}}">
                </td>
                <td>
                    {{$i->nama_paket}}
                    <input type="hidden" name="id_paket[]" value="{{$i->id_paket}}">
                </td>
                <td>{{$ttl}}</td>
                <td><input type="number" name="kredit[]" min="0" max="{{$ttl}}" style="text-align: right" class="form-control" value="0"></td>
            </tr>
            @endif
            
            @endforeach
        </table>
    </div>

</div>