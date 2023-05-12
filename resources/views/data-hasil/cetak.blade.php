<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

</head>

<body>
    <div style="font-size: 14px; page-break-before:always">

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <table width="100% ">
                    <td width="25%"><img src="{{ asset('images-upload') }}/logo.png" alt="" width="120px"
                            height="120px">
                    </td>
                    <td style="text-align: center" width="50%">
                        <h5>
                            <dt>KLINIK TUMBUH KEMBANG HAPPY KIDS</dt>
                        </h5>
                        <p>Jalan K.S. Tubun No. 165 – Banjarmasin</p>
                        <p>Telp/Fax: 0511 3271 463, HP: 0811 5066 777</p>
                        <p>Website : www.klinikhappykids.com</p>
                    </td>
                    <td width="25%">
                        <div
                            style="border: 1px solid black; margin: 2rem;padding: 1rem; text-align: center; padding-bottom: 2rem">
                            <u>NO PASIEN</u>
                            <dt>{{ $no_order }}</dt>
                        </div>
                    </td>
                </table>
                <center>
                    <h5>REKAM MEDIS PASIEN</h5>
                </center>
                <div style="padding: 10px">
                    <table width="100%">
                        <tr>
                            <th width="25%">Nama Pasien</th>
                            <th width="1%">:</th>
                            <td style="border-bottom: 1px solid black;border-style: dashed;" colspan="4">&nbsp;
                                {{ $pasien->nama_pasien }} <span
                                    style="float: right">{{ $pasien->jenis_kelamin }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th width="25%">Golongan Darah</th>
                            <th width="1%">:</th>
                            <td style="border-bottom: 1px solid black;border-style: dashed;" colspan="4">&nbsp;
                                {{ $pasien->golongan_darah }}</td>
                        </tr>
                        <tr>
                            <th width="25%">Alergi Obat</th>
                            <th width="1%">:</th>
                            <td style="border-bottom: 1px solid black;border-style: dashed;" colspan="4">&nbsp;
                                {{ $pasien->alergi_obat }}</td>
                        </tr>
                        <tr>
                            <th width="25%">Tempat, Tanggal Lahir</th>
                            <th width="1%">:</th>
                            <td style="border-bottom: 1px solid black;border-style: dashed;" colspan="4">&nbsp;
                                {{ $pasien->tempat }},{{ date('d F Y', strtotime($pasien->tgl_lahir)) }}</td>
                        </tr>
                        <tr>
                            <th width="25%">Alamat Tinggal</th>
                            <th width="1%">:</th>
                            <td style="border-bottom: 1px solid black;border-style: dashed;" colspan="4">&nbsp;
                                {{ $pasien->alamat }}
                            </td>
                        </tr>
                        <tr>
                            <th width="25%"></th>
                            <th width="1%">:</th>
                            <th width="10%">KELURAHAN</th>
                            <td style="border-bottom: 1px solid black;border-style: dashed;">
                                {{ $pasien->kelurahan }}
                            </td>
                            <th width="10%">KECAMATAN</th>
                            <td style="border-bottom: 1px solid black;border-style: dashed;; white-space: nowrap;">
                                {{ $pasien->kecamatan }}
                            </td>
                        </tr>
                        <tr>
                            <th width="25%"></th>
                            <th width="1%">:</th>
                            <th width="10%">KOTA/KABUPATEN</th>
                            <td style="border-bottom: 1px solid black;border-style: dashed;; white-space: nowrap;">
                                {{ $pasien->kota }}
                            </td>
                            <th width="10%">PROVINSI</th>
                            <td style="border-bottom: 1px solid black;border-style: dashed;; white-space: nowrap;">
                                {{ $pasien->provinsi }}
                            </td>
                        </tr>
                        <tr>
                            <th width="25%">No Hp Ibu</th>
                            <th width="1%">:</th>
                            <td style="border-bottom: 1px solid black;border-style: dashed;">&nbsp;
                                {{ $pasien->nohp_ibu }}
                            </td>
                            <th width="25%" style="text-align: center">No Hp Ayah</th>
                            <td style="border-bottom: 1px solid black;border-style: dashed;" colspan="2">&nbsp;
                                {{ $pasien->nohp_ayah }}
                            </td>
                        </tr>
                        <tr>
                            <th width="25%">Alamat Email</th>
                            <th width="1%">:</th>
                            <td style="border-bottom: 1px solid black;border-style: dashed;" colspan="4">&nbsp;
                                {{ $pasien->email }}
                            </td>
                        </tr>
                    </table>
                    <br>
                    <h5>DATA ORANG TUA / WALI</h5>

                    <table width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th style="text-align: center">AYAH</th>
                                <th></th>
                                <th style="text-align: center">Ibu</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th width="25%">Nama</th>
                                <th width="1%">:</th>
                                <td style="border-bottom: 1px solid black;border-style: dashed;">
                                    &nbsp;{{ $ayah->nama_orang_tua }}</td>
                                <td></td>
                                <td style="border-bottom: 1px solid black;border-style: dashed;">
                                    &nbsp;{{ $ibu->nama_orang_tua }}</td>
                            </tr>
                            <tr>
                                @php
                                    $uayah = new DateTime($ayah->tgl_lahir);
                                    $today = new DateTime();
                                    $u_ayah = $today->diff($uayah);
                                    
                                    $uibu = new DateTime($ayah->tgl_lahir);
                                    $today = new DateTime();
                                    $u_ibu = $today->diff($uibu);
                                @endphp
                                <th width="25%">Usia saat ini</th>
                                <th width="1%">:</th>
                                <td style="border-bottom: 1px solid black;border-style: dashed;">
                                    &nbsp;{{ $u_ayah->y }} Tahun</td>
                                <td></td>
                                <td style="border-bottom: 1px solid black;border-style: dashed;">
                                    &nbsp;{{ $u_ibu->y }} Tahun</td>
                            </tr>
                            <tr>
                                <th width="25%">Agama</th>
                                <th width="1%">:</th>
                                <td style="border-bottom: 1px solid black;border-style: dashed;">
                                    &nbsp;{{ $ayah->agama }}</td>
                                <td></td>
                                <td style="border-bottom: 1px solid black;border-style: dashed;">
                                    &nbsp;{{ $ibu->agama }}</td>
                            </tr>
                            <tr>
                                <th width="25%">Suku Bangsa</th>
                                <th width="1%">:</th>
                                <td style="border-bottom: 1px solid black;border-style: dashed;">
                                    &nbsp;{{ $ayah->suku_bangsa }}</td>
                                <td></td>
                                <td style="border-bottom: 1px solid black;border-style: dashed;">
                                    &nbsp;{{ $ibu->suku_bangsa }}</td>
                            </tr>
                            <tr>
                                <th width="25%">Perkawinan ke</th>
                                <th width="1%">:</th>
                                <td style="border-bottom: 1px solid black;border-style: dashed;">
                                    &nbsp;{{ $ayah->perkawinan_ke }}</td>
                                <td></td>
                                <td style="border-bottom: 1px solid black;border-style: dashed;">
                                    &nbsp;{{ $ibu->perkawinan_ke }}</td>
                            </tr>
                            <tr>
                                <th width="25%">Usia saat menikah</th>
                                <th width="1%">:</th>
                                <td style="border-bottom: 1px solid black;border-style: dashed;">
                                    &nbsp;{{ $ayah->usia_saat_menikah }}</td>
                                <td></td>
                                <td style="border-bottom: 1px solid black;border-style: dashed;">
                                    &nbsp;{{ $ibu->usia_saat_menikah }}</td>
                            </tr>
                            <tr>
                                <th width="25%">Pendidikan </th>
                                <th width="1%">:</th>
                                <td style="border-bottom: 1px solid black;border-style: dashed;">
                                    &nbsp;{{ $ayah->pendidikan }}</td>
                                <td></td>
                                <td style="border-bottom: 1px solid black;border-style: dashed;">
                                    &nbsp;{{ $ibu->pendidikan }}</td>
                            </tr>
                            <tr>
                                <th width="25%">Pekerjaan </th>
                                <th width="1%">:</th>
                                <td style="border-bottom: 1px solid black;border-style: dashed;">
                                    &nbsp;{{ $ayah->pekerjaan }}</td>
                                <td></td>
                                <td style="border-bottom: 1px solid black;border-style: dashed;">
                                    &nbsp;{{ $ibu->pekerjaan }}</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>

    </div>
    <div style="font-size: 14px; page-break-before:always">

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <center>
                    <h4>Psikomotorik</h4>
                </center>
            </div>
            <div class="col-lg-8">
                <table class="table table-bordered">
                    <tr>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                    </tr>
                    @foreach ($per1 as $p1)
                        <tr>

                            <td>{{ $p1->pertanyaan }}</td>
                            <td>{{ $p1->jawaban1 }} Bulan</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
    <div style="font-size: 14px; page-break-before:always">

        <div class="row justify-content-center">

            <div class="col-lg-12">

                <br>
                <center>
                    <h4>KPSP Pada Anak 48 Bulan</h4>
                </center>
            </div>

            <div class="col-lg-12">
                <table class="table table-bordered" style="color: #787878">
                    <thead>
                        <tr>
                            <th colspan="2"></th>
                            <th></th>
                            <th>Ya</th>
                            <th>Tidak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                            $ya = 1;
                            $tdk = 1;
                        @endphp
                        @foreach ($kel_kpsp as $k)
                            @php
                                $kpsp = DB::select("SELECT * FROM pertanyaan as a left join kelompok_gerak as b on b.id_gerak = a.id_gerak where a.kelompok_pertanyaan = '2' and id_kel_kpsp = $k->id_kel_kpsp");
                            @endphp
                            <tr>
                                <th colspan="2">{{ $k->nm_kpsp }}</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>

                            @foreach ($kpsp as $p)
                                @php
                                    $jawaban = DB::selectOne("SELECT a.jawaban2 FROM jawaban2 as a where a.id_pertanyaan = '$p->id_pertanyaan'");
                                    
                                    $centang = '';
                                @endphp
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        {{ $p->pertanyaan }}
                                    </td>
                                    @php
                                        if ($p->id_gerak == '1') {
                                            $warna = 'bg-primary text-white';
                                        } elseif ($p->id_gerak == '2') {
                                            $warna = 'bg-success text-white';
                                        } elseif ($p->id_gerak == '3') {
                                            $warna = 'bg-warning text-white';
                                        } else {
                                            $warna = 'bg-danger text-white';
                                        }
                                    @endphp

                                    <td style="vertical-align: middle;" class="{{ $warna }}">
                                        {{ $p->nm_gerak }}</td>
                                    <td style="vertical-align: middle; text-align: center">
                                        <i
                                            class="{{ $jawaban->jawaban2 == 'Ya' ? 'bi bi-check text-success' : '' }}"></i>

                                    </td>
                                    <td style="vertical-align: middle; text-align: center">
                                        <i
                                            class="{{ $jawaban->jawaban2 == 'Tidak' ? 'bi bi-check text-success' : '' }}"></i>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach



                    </tbody>



                </table>
            </div>
        </div>

    </div>
    <div style="font-size: 14px; page-break-before:always">

        <div class="row">
            <div class="col-lg-12">
                <center>
                    <h4 class="font-normal">Parents Evaluation of Development Status </h4>
                </center>
                <br>
                <table width="100%">
                    <tr>
                        <th>Nama Anak</th>
                        <th>:</th>
                        <td>{{ $pasien->nama_pasien }}</td>
                        <th>Nama Orang Tua</th>
                        <th>:</th>
                        <td>{{ $ayah->nama_orang_tua }} & {{ $ibu->nama_orang_tua }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <th>:</th>
                        <td>{{ date('d F Y', strtotime($pasien->tgl_lahir)) }}</td>
                        <th>Tanggal Pemeriksaan </th>
                        <th>:</th>
                        <td>{{ date('d F Y') }}</td>
                    </tr>
                    <tr>
                        @php
                            $totalKerja = new DateTime($pasien->tgl_lahir);
                            $today = new DateTime();
                            $tKerja = $today->diff($totalKerja);
                        @endphp
                        <th>Umur</th>
                        <th>:</th>
                        <td>{{ $tKerja->m }} Bulan</td>
                    </tr>
                </table>
            </div>

            <div class="col-lg-12 ">
                <br>

                <table width="100%">
                    @php
                        $i = 1;
                        $tdk = 1;
                        $ya = 1;
                        $sdk = 1;
                        $ksng = 1;
                    @endphp
                    @foreach ($per3 as $p)
                        <tr>
                            <th>{{ $i++ }}.</th>
                            <th>{{ $p->pertanyaan }}</th>
                        </tr>
                        @if ($p->pilihan != 'kosong')
                            <tr>
                                <td></td>
                                <td>Pilih : {{ $p->pilihan }}</td>
                            </tr>
                        @else
                        @endif

                        <tr>
                            <td></td>
                            <td>Komentar : {{ $p->jawaban3 }}
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    @endforeach


                </table>
            </div>
        </div>
    </div>
    <div style="font-size: 14px; page-break-before:always">

        <div class="row">
            <div class="col-lg-12">
                <center>
                    <h4 class="font-normal">M-CHAT-R (Modified Checklist for Autism in Toddlers, Revised)</h4>
                </center>
                <br>
            </div>

            <div class="col-lg-12 ">
                <br>

                <table width="100%">
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($per4 as $p)
                        <tr>
                            <th style="vertical-align: top;">{{ $i++ }}.</th>
                            <th>{{ $p->pertanyaan }}</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Jawaban : {{ $p->jawaban4 }}</td>
                        </tr>
                    @endforeach


                </table>
            </div>
        </div>
    </div>
</body>

<script>
    window.print()
</script>

</html>
