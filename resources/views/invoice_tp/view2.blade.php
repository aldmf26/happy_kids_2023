<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel33">
        No Order : {{$no_order}} | Paket : {{$paket->nama_paket}}
    </h4>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <i data-feather="x"></i> X
    </button>
</div>
<div class="modal-body">
    <table class="table table-hover" id="table1">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Nama Therapish</th>
                <th>Beli</th>
                <th>Dipakai</th>
                <th>Sisa</th>
            </tr>
        </thead>
        <tbody>
            @php
            $saldo = 0;
            @endphp
            @foreach ($invoice_tp as $no => $i)
            @php
            $saldo += $i->debit - $i->kredit
            @endphp
            <tr>
                <td>{{$no+1}}</td>
                <td>{{date('d-m-Y',strtotime($i->tgl))}}</td>
                <td>{{$i->nama_therapy}}</td>
                <td>{{$i->debit }}</td>
                <td>{{$i->kredit }}</td>
                <td>{{$saldo }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>