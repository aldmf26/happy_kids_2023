<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Invoice_periksa extends Controller
{
    function index(Request $r)
    {

        if (empty($r->tgl1)) {
            $tgl1 = date('Y-m-01');
            $tgl2 = date('Y-m-t');
        } else {
            $tgl1 = $r->tgl1;
            $tgl2 =  $r->tgl2;
        }
        $data = [
            'title' => 'Data Invoive Periksa',
            'dt_pasien' => DB::table('dt_pasien')->where('nonaktif', 'T')->get(),
            'invoice_periksa' => DB::select("SELECT a.id_dokter,a.pembayaran,a.id_invoice_periksa, a.status, a.tgl, a.no_order, b.nama_pasien, b.member_id , c.nm_dokter
            FROM invoice_periksa as a 
            left join dt_pasien as b on b.id_pasien = a.member_id 
            left join dt_dokter as c on c.id_dokter = a.id_dokter
            where a.tgl BETWEEN '$tgl1' and '$tgl2' group by a.no_order order by a.id_invoice_periksa DESC"),
            'dokter' => DB::table('dt_dokter')->where('nonaktif', 'T')->get(),
            'nominal' => DB::table('tb_nominal')->where('jenis', 'inv_periksa')->get(),
            'btnTeks' => 'Export',
        ];
        return view('invoice_periksa.index', $data);
    }

    public function edit_invoice_periksa(Request $r)
    {
        DB::table('invoice_periksa')->where('id_invoice_periksa', $r->id_invoice_periksa)->update(
            [
                'id_dokter' => $r->id_dokter,
                'pembayaran' => $r->pembayaran
            ]
        );
        return redirect()->route('inv_periksa')->with('sukses', 'Berhasil edit invoice periksa');
    }

    public function editInput(Request $r)
    {
        $data = [
            'dokter' => DB::table('dt_dokter')->get(),
            'id_inv_periksa' => $r->id,
        ];
        return view('invoice_periksa.edit', $data);
    }

    public function save_invoice_periksa(Request $r)
    {
        $member_id = $r->member_id;
        $pembayaran = $r->pembayaran;
        $id_dokter = $r->id_dokter;
        $invoice = DB::selectOne("SELECT max(a.urutan) as urutan FROM invoice_periksa as a");

        $pasien = DB::table('dt_pasien')->where('id_pasien', $member_id)->first();

        if (empty($invoice->urutan)) {
            $no_order = 1001;
        } else {
            $no_order = $invoice->urutan + 1;
        }

        $data = [
            'no_order' => 'HK' . $no_order,
            'urutan' => $no_order,
            'member_id' => $member_id,
            'id_dokter' => $id_dokter,
            'tgl' => $r->tgl,
            'rupiah' => $r->rupiah,
            'pembayaran' => $pembayaran,
            'jenis' => $r->id_jenis,
            'status' => 'paid',
            'admin' => Auth::user()->name
        ];
        DB::table('invoice_periksa')->insert($data);
        if ($pasien->kartu == 'T') {
            $data = [
                'no_order' => 'HK' . $no_order,
                'urutan' => $no_order,
                'member_id' => $member_id,
                'id_dokter' => $id_dokter,
                'tgl' => $r->tgl,
                'rupiah' => '10000',
                'pembayaran' => $pembayaran,
                'jenis' => $r->id_jenis,
                'status' => 'paid',
                'admin' => Auth::user()->name,
                'ket' => 'Bikin Kartu'
            ];
            DB::table('invoice_periksa')->insert($data);

            DB::table('dt_pasien')->where('member_id', $member_id)->update(['kartu' => 'Y', 'no_order' => 'HK' . $no_order]);
        }

        $data = [
            'no_order' => 'HK' . $no_order,
            'urutan' => $no_order,
            'member_id' => $member_id,
            'id_dokter' => $id_dokter,
            'tgl' => $r->tgl,
            'rupiah' => '25000',
            'pembayaran' => $pembayaran,
            'jenis' => $r->id_jenis,
            'status' => 'paid',
            'admin' => Auth::user()->name,
            'ket' => 'Administrasi'
        ];
        DB::table('invoice_periksa')->insert($data);


        return redirect()->route('inv_periksa')->with('sukses', 'Berhasil tambah pertanyaan');
    }

    public function hapus_invoice_periksa(Request $r)
    {
        DB::table('invoice_periksa')->where('no_order', $r->id_invoice_periksa)->update(['nonaktif' => 'Y']);
        $cek = DB::table('dt_pasien')->where('no_order', $r->id_invoice_periksa)->first();
        if(!empty($cek)) {
            DB::table('dt_pasien')->where('no_order', $r->id_invoice_periksa)->update([
                'kartu' => 'T'
            ]);
        }
        // return redirect()->route('inv_periksa')->with('sukses', 'Berhasil tambah pertanyaan');
    }

    public function cetak_inv_periksa(Request $r)
    {
        $invoice = DB::select("SELECT * FROM invoice_periksa as a left join tb_nominal as b on b.id_nominal = a.jenis where a.no_order =  '$r->no_order' and a.ket is NULL");
        $invoice3 = DB::selectOne("SELECT sum(a.rupiah) as nominal FROM invoice_periksa as a left join tb_nominal as b on b.id_nominal = a.jenis where a.no_order =  '$r->no_order' and a.ket is NOT NULL");
        
        $invoice2 = DB::selectOne("SELECT  a.*, b.nama_pasien,b.member_id as memberPasien, b.alamat FROM invoice_periksa as a left join dt_pasien as b on b.id_pasien =  a.member_id where a.no_order = '$r->no_order'");
       
        $data = [
            'invoice2' => $invoice2,
            'invoice' =>  $invoice,
            'invoice3' =>  $invoice3,
            'alamat' => DB::table('h1')->where('id_h1', '12')->first()
        ];

        return view('invoice_periksa.cetak_invoice_new', $data);
    }
}
