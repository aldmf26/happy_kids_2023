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
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <div class="col-6 ">
                <div class="float-start">
                    <img src="{{ asset('images-upload/logo.png') }}" width="120" height="120" alt="">
                </div>
            </div>
            <div class="col-6 mt-4">
                <div class="float-end">
                    Invoice #: {{$invoice->no_order}}
                    <br />
                    Created: {{ date('F d, Y',strtotime($invoice->tgl)) }}<br />
                    Due: {{ date('F d, Y') }}
                </div>
            </div>
            <div class="col-6 mt-4">
                <div class="float-start">
                    Happy Kids<br />
                    {{$alamat->isi}}
                </div>

            </div>
            <div class="col-lg-12 mt-2">
                <table class="table table-sm">
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
                    $total += $p->total_rp;
                    @endphp
                    <tr class="details">
                        <td>{{$p->nama_paket}}</td>
                        <td align="right">{{$p->debit}}</td>
                        <td align="right">Rp. {{number_format($p->total_rp / $p->debit,0)}}</td>
                        <td align="right">Rp. {{number_format($p->total_rp ,0)}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="3"></th>
                        <th style="text-align: right">Total: Rp. {{number_format($total,0)}}</th>
                    </tr>

                </table>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12">
                <hr>
            </div>
            <div class="col-6 ">
                <div class="float-start">
                    <img src="{{ asset('images-upload/logo.png') }}" width="120" height="120" alt="">
                </div>
            </div>
            <div class="col-6 mt-4">
                <div class="float-end">
                    Invoice #: {{$invoice->no_order}}
                    <br />
                    Created: {{ date('F d, Y',strtotime($invoice->tgl)) }}<br />
                    Due: {{ date('F d, Y') }}
                </div>
            </div>
            <div class="col-6 mt-4">
                <div class="float-start">
                    Happy Kids<br />
                    {{$alamat->isi}}
                </div>

            </div>
            <div class="col-lg-12 mt-2">
                <table class="table table-sm">
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
                    $total += $p->total_rp;
                    @endphp
                    <tr class="details">
                        <td>{{$p->nama_paket}}</td>
                        <td align="right">{{$p->debit}}</td>
                        <td align="right">Rp. {{number_format($p->total_rp / $p->debit,0)}}</td>
                        <td align="right">Rp. {{number_format($p->total_rp ,0)}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="3"></th>
                        <th style="text-align: right">Total: Rp. {{number_format($total,0)}}</th>
                    </tr>

                </table>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>


<script>
    window.print()
</script>

</html>