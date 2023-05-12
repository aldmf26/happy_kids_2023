<table class="table table-hover" id="table1">
    <thead>
        <tr>
            <th>#</th>
            <th>No Invoice</th>
            <th>Nama Therapish</th>
            <th>Nama Paket</th>
            <th>Jumlah Paket</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoice_tp as $no => $i)
        <tr>
            <td>{{$no+1}}</td>
            <td>{{$i->no_order}}</td>
            <td>{{$i->nama_therapy}}</td>
            <td>{{$i->nama_paket}}</td>
            <td>{{$i->debit - $i->kredit}}</td>
            <td>
                <span class="badge bg-{{ $i->debit - $i->kredit != '1' ? 'success' : 'danger' }}">
                    {{ $i->debit - $i->kredit != '1' ? 'ok' : 'Paket mau habis' }}
                </span>
            <td>
                <a href="#" class="btn btn-primary btn-sm view2" no_order="{{$i->no_order}}"
                    id_paket="{{$i->id_paket}}"><i class="bi bi-folder-check"></i>
                </a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>