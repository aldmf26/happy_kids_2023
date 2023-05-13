<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Cetak Invoice</title>

    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }
    </style>
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

    <div class="top">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 ">
                    <img class="float-start" src="{{ asset('images-upload/logo.png') }}" width="120" height="120"
                        alt="">
                    <h6 class="text-start mt-4">Klinik Tumbuh Kembang "Happy Kids" <br> Jl. Ks Tubun No 165 <br>
                        Telp/wa 0811 5066 777</h6>
                </div>
                <div class="col-lg-12">
                    <table style="font-size: 12px;">
                        <tr>
                            <td>Invoice</td>
                            <td>:</td>
                            <td>{{ $invoice2->no_order }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ ucwords($invoice2->nama_pasien) }}</td>
                        </tr>
                        <tr>
                            <td>No.RM</td>
                            <td>:</td>
                            <td>{{ kode($invoice2->member_id) }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ ucwords($invoice2->alamat) }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-12 mt-2">
                    <table class="table table-sm" style="font-size: 12px;">
                        <tr class="table-active">
                            <th>Keterangan</th>
                            <th style="text-align: right">Nominal</th>
                        </tr>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($invoice as $a)
                            @php
                                $total += $a->rupiah;
                            @endphp
                            <tr>
                                <td>{{ ucwords($a->nm_jenis) }}</td>
                                <td align="right">Rp. {{ number_format($a->rupiah, 0) }}</td>
                            </tr>
                        @endforeach

                        <tr>
                            <td>Administrasi</td>
                            <td align="right">Rp. {{ number_format($invoice3->nominal, 0) }}</td>
                        </tr>

                        <tr>
                            <th style="text-align: center">
                                {{ \Nasution\Terbilang::convert($total + $invoice3->nominal) }}
                                rupiah</th>
                            <th style="text-align: right">Total Rp.{{ number_format($total + $invoice3->nominal, 0) }}

                            </th>
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
                    <p class="ttd">Banjarmasin,{{ date('F d, Y', strtotime($invoice2->tgl)) }}</p>
                    <br>
                    <br>
                    <p class="ttd fw-bold">( {{ Auth::user()->name }} ) </p>
                </div>

            </div>


        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->
</body>


<script>
    window.print()
</script>

</html>
