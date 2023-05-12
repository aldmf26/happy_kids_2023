<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover" id="table1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Member ID</th>
                    <th>No Order</th>
                    <th>Dokter</th>
                    <th>Nama Pasien</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1;
                @endphp
                @foreach ($invoice_periksa as $n)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ date('d-m-Y', strtotime($n->tgl)) }}</td>
                    <td>{{ $n->member_id }}</td>
                    <td>{{ $n->no_order }}</td>
                    <td>{{ $n->nm_dokter }}</td>
                    <td>{{ $n->nama_pasien }}</td>
                    <td>
                        <span class="badge bg-{{ $n->status == 'Paid' ? 'primary' : 'warning' }}">{{
                            $n->status == 'Paid' ? "$n->status : " . strtoupper($n->pembayaran) : $n->status
                            }}</span>
                    </td>
                    <td>
                        <a href="#" id="hapusPeriksa" id_invoice="{{$n->no_order}}" 
                            class="btn btn-warning btn-sm"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>