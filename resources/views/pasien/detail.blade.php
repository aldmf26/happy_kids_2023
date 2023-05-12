<table class="table">
    @php
        $data = [
            'Member ID' => $pasien->member_id,
            'Nama' => $pasien->nama_pasien,
            'Tgl Lahir' => $pasien->tgl_lahir,
            'Alamat' => $pasien->alamat,
            'No HP' => $pasien->no_hp,
        ]
    @endphp
    @foreach ($data as $d => $i)
    <tr>
        <td width="15%">{{ $d }}</td>
        <td width="5%">:</td>
        <td>{{ $i }}</td>
    </tr>
    @endforeach
</table>
