<!DOCTYPE html>
<html>

<head>
    <title>Print Invoice Therapi & Paket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        @media print {

            /* Set ukuran halaman A4 */
            @page {
                size: A4;
            }

            /* Mengatur properti margin halaman */
            body {
                margin: 0;
                height: 100%;
                font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            }

            /* Bagian atas halaman */
            .top {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 50%;

            }

            /* Bagian bawah halaman */
            .bottom {
                position: absolute;
                top: 50%;
                left: 0;
                width: 100%;
                height: 50%;
            }

        }
    </style>
</head>

<body>
    <!-- Bagian atas halaman -->
    <div class="top">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 ">

                    <img class="float-start" src="{{ asset('images-upload/logo.png') }}" width="120" height="120"
                        alt="">
                    <h6 class="text-start mt-4">Klinik Tumbuh Kembang "Happy Kids" <br> Jl. Ks Tubun No 165 <br>
                        Telp/wa 0811 5066 777</h6>


                </div>
                <div class="col-6">

                </div>
                <div class="col-lg-12">
                    <table style="font-size: 12px;">
                        <tr>
                            <td>Invoice</td>
                            <td>:</td>
                            <td>{{$invoice->no_order}}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ucwords($invoice->nama_pasien)}}</td>
                        </tr>
                        <tr>
                            <td>No. RM</td>
                            <td>:</td>
                            <td>{{$invoice->member_id}}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ucwords($invoice->alamat)}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-12 mt-3">
                    <table class="table table-sm table-bordered" style="font-size: 12px;">
                        <tr class="table-active">
                            <th>Paket</th>
                            <th style="text-align: right">Qty</th>
                            <th style="text-align: right">Harga Satuan</th>
                            <th style="text-align: right">Total Harga</th>
                        </tr>
                        @php
                        $total = 0;
                        @endphp
                        @foreach ($paket as $p)
                        @php
                            if($p->debit == 0 || $p->total_rp == 0) {
                                continue;
                            } else {
                                $total += $p->total_rp;
                            }
                        @endphp
                        <tr class="details">
                            <td>{{ucwords($p->nama_paket)}}</td>
                            <td align="right">{{$p->debit}}</td>
                     
                            <td align="right">Rp. {{ number_format($p->total_rp / $p->debit,0)}}</td>
                            <td align="right">Rp. {{number_format($p->total_rp ,0)}}</td>
                        </tr>
                        @endforeach
                        @php
                        $total2 =0;
                        @endphp
                        @foreach ($invoice2 as $a)
                        @php
                        $total2 += $a->rupiah;
                        @endphp
                        <tr>
                            <td>Registrasi {{$a->nama_paket}}</td>
                            <td align="right">1</td>
                            <td align="right">Rp. {{ number_format($a->rupiah,0)}}</td>
                            <td align="right">Rp. {{ number_format($a->rupiah,0)}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th style="text-align: center" colspan="3">{{\Nasution\Terbilang::convert($total +
                                $total2);}} rupiah</th>
                            <th style="text-align: right">Total Rp. {{number_format($total + $total2 ,0)}}</th>
                        </tr>

                    </table>

                </div>

                <div class="col-8 ">

                </div>
                <style>
                    .ttd {
                        text-align: center;
                        font-size: 12px;
                    }
                </style>
                <div class="col-4">
                    <p class="ttd">Banjarmasin, {{ date('F d, Y',strtotime($invoice->tgl)) }}</p>
                    <br>
                    <br>
                    <p class="ttd fw-bold">( {{ ucwords(Auth::user()->name) }} )</p>
                </div>

            </div>


        </div>
    </div>

    <!-- Bagian bawah halaman -->
    <script>
        window.print()
    </script>

</body>

</html>