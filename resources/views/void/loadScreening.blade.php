<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover" id="table1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Member ID</th>
                    <th>No Order</th>
                    <th>Nama Pasien</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1;
                @endphp
                @foreach ($inv_screening as $n)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ date('d-m-Y', strtotime($n->tgl)) }}</td>
                    <td>{{ $n->member_id }}</td>
                    <td>{{ $n->no_order }}</td>
                    <td>{{ $n->nama_pasien }}</td>
                    <td>
                        <span class="badge bg-{{ $n->status == 'paid' ? 'primary' : 'warning' }}">{{
                            $n->status == 'paid' ? "$n->status : " . strtoupper($n->pembayaran) : $n->status
                            }}</span>
                    </td>
                    <td>
                        <a href="#" id="hapusScreening" id_invoice="{{$n->id_invoice}}"
                            class="btn btn-warning btn-sm"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>