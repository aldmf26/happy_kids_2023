<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel33">
        Paket : {{$paket->nama_paket}}
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
                <th>No Order</th>
                <th>Nama Therapist</th>
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
            
            @if($i->debit+$i->kredit != 0)
            <tr>
                <td>{{$no+1}}</td>
                <td>{{date('d-m-Y',strtotime($i->tgl))}}</td>
                <td>{{$i->no_order}}</td>
                <td>{{$i->nama_therapy}}</td>
                <td>{{$i->debit }}</td>
                <td>{{$i->kredit }}</td>
                <td>{{$saldo }}</td>
            </tr>
            @endif
            @endforeach

        </tbody>
    </table>
</div>