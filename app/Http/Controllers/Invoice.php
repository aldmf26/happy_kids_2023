<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Invoice extends Controller
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
        $member_id = DB::selectOne("SELECT max(member_id) as member_id FROM `dt_pasien` ORDER BY member_id ASC;");
        $data = [
            'title' => 'Data Invoice Screening',
            'dt_pasien' => DB::table('dt_pasien')->orderBy('member_id', 'DESC')->get(),
            'invoice' => DB::select("SELECT a.pembayaran,a.id_invoice,a.tgl, a.no_order, b.nama_pasien, b.member_id, a.status FROM invoice as a left join dt_pasien as b on b.member_id = a.member_id where a.tgl between '$tgl1' and '$tgl2' order by a.id_invoice DESC"),
            'member_id' => empty($member_id) ? '50001' : $member_id->member_id,
            'nominal' => DB::table('tb_nominal')->where('jenis', 'inv_screening')->get(),
        ];
        return view('data-appointment.appointment', $data);
    }

    public function save_invoice(Request $r)
    {
        $member_id = $r->member_id;
        $pembayaran = $r->pembayaran;
        $rupiah = $r->rupiah;
        $keluhan = $r->keluhan;
        $invoice = DB::selectOne("SELECT max(a.urutan) as urutan FROM invoice as a");

        if (empty($invoice->urutan)) {
            $no_order = 1001;
        } else {
            $no_order = $invoice->urutan + 1;
        }


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
        DB::table('invoice')->insert($data);


        return redirect()->route('invoice')->with('sukses', 'Berhasil tambah invoice');
    }

    public function edit_invoice(Request $r)
    {
        if (!$r->pembayaran) {
            return redirect()->back()->with('error', 'Pembayaran tidak diisi');
        }
        DB::table('invoice')->where('id_invoice', $r->id_invoice)->update(['pembayaran' => $r->pembayaran]);
        return redirect()->route('invoice')->with('sukses', 'Berhasil ubah pembayaran');
    }

    public function cetak_invoice(Request $r)
    {
        $data = [
            'invoice' => DB::table('invoice')->where('id_invoice', $r->id_invoice)->first(),
            'alamat' => DB::table('h1')->where('id_h1', '12')->first()
        ];
        return view('data-appointment.cetak_invoice_new', $data);
    }

    public function save_status(Request $r)
    {
        DB::table('invoice')->where('id_invoice', $r->id_invoice)->update(['pembayaran' => $r->pembayaran, 'status' => 'paid']);
        return redirect()->route('invoice')->with('sukses', 'Berhasil paid appointment');
    }

    public function hapus_invoice(Request $r)
    {
        DB::table('invoice')->where('id_invoice', $r->id_invoice)->delete();
        // return redirect()->route('invoice')->with('sukses', 'Berhasil hapus invoice');
    }

    public function noMedis(Request $r)
    {
        $data = [
            'dt_pasien' => DB::table('dt_pasien')->orderBy('member_id', 'DESC')->get(),
        ];
        return view('data-appointment.noMedis', $data);
    }

    public function loadTambahPasien(Request $r)
    {
        $member_id = DB::selectOne("SELECT max(member_id) as member_id FROM `dt_pasien` ORDER BY member_id ASC;");
        $data = [
            'member_id' => empty($member_id) ? '50001' : $member_id->member_id,
        ];
        return view('data-appointment.tambahPasien', $data);
    }
}
