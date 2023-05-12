<table class="table table-hover" id="table1">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Therapist</th>
            <th>Nama Paket</th>
            <th>Jumlah Paket</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoice as $no => $i)
        <tr>
            <td>{{$no+1}}</td>
            <td>
                <a href="#" class="editSaldo" id_saldo_therapy="{{$i->id_saldo_therapy}}" id_terapi="{{$i->id_therapy}}" member_id="{{$i->member_id}}" id_paket="{{$i->id_paket}}">{{$i->nama_therapy}}</a>
            </td>
            <td>{{$i->nama_paket}}</td>
            <td>{{$i->debit - $i->kredit}}</td>
            <td>
                <span class="badge bg-{{ $i->debit - $i->kredit != '1' ? 'success' : 'danger' }}">
                    {{ $i->debit - $i->kredit != '1' ? 'ok' : 'Paket mau habis' }}
                </span>
            <td>
                <a href="#" class="btn btn-primary btn-sm view2" member_id="{{$i->member_id}}"
                    id_paket="{{$i->id_paket}}">History
                </a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>