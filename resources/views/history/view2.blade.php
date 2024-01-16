
   @if (empty($detail))
   <h3 class="text-danger"><em>Data Tidak Ada !</em></h3>
   @else
   <table class="table table-hover" id="table1">
       <thead class="bg-primary">
           <tr>
               <th>#</th>
               <th>Tanggal</th>
               <th>No Order</th>
               <th>Member ID</th>
               <th>Nama Pasien</th>
               <th>Nama Paket</th>
               <th class="text-end">Paket Terpakai</th>
           </tr>
       </thead>
       <tbody>
           @foreach ($detail as $no => $d)
               <tr>
                   <td>{{ $no+1 }}</td>
                   <td>{{ $d->tgl }}</td>
                   <td>{{ $d->no_order }}</td>
                   <td>{{ kode($d->member_id) }}</td>
                   <td>{{ $d->nama_pasien }}</td>
                   <td>{{ $d->nama_paket }}</td>
                   <td align="right">{{ $d->kredit }}</td>
               </tr>
           @endforeach
       </tbody>
   </table>
   @endif