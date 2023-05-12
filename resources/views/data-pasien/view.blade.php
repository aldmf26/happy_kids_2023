
<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel33">
        Detail Pasien  
    </h4>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
      <i data-feather="x"></i>
    </button>
  </div>
<div class="modal-body">
    <table class="table table-md">
        <tr>
            <td>Nama Pasien </td>
            <td>:</td>
            <td width="70%">{{ $datas->nama_pasien }} , Gol : {{ $datas->golongan_darah }} </td>
            
        </tr>
        <tr>
            <td>Jenis Kelamin </td>
            <td>:</td>
            <td width="70%">{{ $datas->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir </td>
            <td>:</td>
            <td width="70%">{{ $datas->tgl_lahir }}</td>
            
        </tr>
        <tr>
            <td>Alergi Obat </td>
            <td>:</td>
            <td width="70%">{{ $datas->alergi_obat }}</td>
        </tr>
        <tr>
            <td>Tempat </td>
            <td>:</td>
            <td width="70%">{{ $datas->tempat }}</td>
            
        </tr>
        <tr>
            <td>Alamat </td>
            <td>:</td>
            <td width="70%">{{ $datas->alamat }}</td>
        </tr>
        <tr>
            <td>Provinsi </td>
            <td>:</td>
            <td width="70%">{{ $datas->provinsi }}</td>
        </tr>
        <tr>
            <td>Kota </td>
            <td>:</td>
            <td width="70%">{{ $datas->kota }}</td>
        </tr>
        <tr>
            <td>Kecamatan </td>
            <td>:</td>
            <td width="70%">{{ $datas->kecamatan }}</td>
        </tr>
        <tr>
            <td>Kelurahan </td>
            <td>:</td>
            <td width="70%">{{ $datas->kelurahan }}</td>
        </tr>
        <tr>
            <td>No HP </td>
            <td>:</td>
            <td width="70%">Ibu ({{ $datas->nohp_ibu }}) / Ayah ({{ $datas->nohp_ayah }})</td>
        </tr>
    </table>

</div>