<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class inv_registrasi extends Controller
{
    public function index(Request $r)
    {
        $tgl1 = $r->tgl1 ?? date('Y-m-1');
        $tgl2 = $r->tgl2 ?? date('Y-m-t');
        $data = [
            'title' => 'Invoice Registrasi',
            'invoice' => DB::select("SELECT a.pembayaran,a.id_registrasi,a.tgl, a.no_order, b.nama_pasien, b.member_id, a.status FROM invoice_registrasi as a left join dt_pasien as b on b.member_id = a.member_id where a.tgl between '$tgl1' and '$tgl2' order by a.id_registrasi DESC"),
            'dt_pasien' => DB::table('dt_pasien')->get(),
            'nominal' => DB::table('tb_nominal')->where('jenis', 'inv_registrasi')->get()
        ];
        return view('invoice_registrasi.registrasi', $data);
    }

    public function save_registrasi(Request $r)
    {
        $member_id = $r->member_id;
        $pembayaran = $r->pembayaran;
        $rupiah = $r->rupiah;
        $invoice = DB::selectOne("SELECT max(a.urutan) as urutan FROM invoice_registrasi as a");


        $no_order = empty($invoice->urutan) ? 1001 : $invoice->urutan + 1;


        $data = [
            'no_order' => 'HK' . $no_order,
            'urutan' => $no_order,
            'member_id' => $member_id,
            'tgl' => $r->tgl,
            'rupiah' => $rupiah,
            'pembayaran' => $pembayaran,
            'status' => 'paid',
            'admin' => Auth::user()->name

        ];
        DB::table('invoice_registrasi')->insert($data);


        return redirect()->route('inv_registrasi')->with('sukses', 'Berhasil tambah invoice');
    }

    public function cetak_registrasi(Request $r)
    {
        $data = [
            'invoice' => DB::table('invoice_registrasi')->where('id_registrasi', $r->id_registrasi)->first(),
            'alamat' => DB::table('h1')->where('id_h1', '12')->first()
        ];
        return view('invoice_registrasi.cetak_invoice_new', $data);
    }
}
