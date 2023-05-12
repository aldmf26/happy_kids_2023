<div class="row">
    <div class="col-lg-12">
        <table class="table" id="table1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Member ID</th>
                    <th>No Order</th>
                    <th>Nama Pasien</th>
                    <th>Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1;
                @endphp
                @foreach ($invoice_tp as $n)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ date('d-m-Y', strtotime($n->tgl)) }}</td>
                    <td>{{ $n->member_id }}</td>
                    <td>{{ $n->no_order }}</td>
                    <td>{{ $n->nama_pasien }}</td>
                    <td>
                        <span class="badge bg-{{ $n->pembayaran != 'belum' ? 'primary' : 'warning' }}">{{
                            $n->pembayaran != 'belum' ? "Paid : " . strtoupper($n->pembayaran) :
                            "Unpaid"
                            }}
                        </span>
                    </td>

                    <td>
                        <a href="#" id="hapusTerapi" id_invoice="{{$n->no_order}}"
                          class="btn btn-warning btn-sm"><i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>