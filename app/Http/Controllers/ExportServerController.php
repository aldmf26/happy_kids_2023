<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ExportServerController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Export Data',
            'pasien' => DB::table('dt_pasien')->where('export', 'T')->count(),
            'inv' => DB::table('invoice')->where('export', 'T')->count(),
            'menu' => DB::table('tb_menu_dashboard')->whereNotIn('id', [8,9,10])->get()
        ];
        return view('export.export',$data);
    }

    public function exportPasien(Request $r)
    {
        $data  = DB::table('dt_pasien')->where('export', 'T')->get();

        $id_data = [];
        $datas = [];

        foreach($data as $n) {
            $id_data[] = $n->id_pasien;
            array_push($datas, [
                'id_pasien' => $n->id_pasien,
                'member_id' => $n->member_id,
                'nama_pasien' => $n->nama_pasien,
                'tgl_lahir' => $n->tgl_lahir,
                'no_hp' => $n->no_hp,
            ]);
        }
        $response = Http::acceptJson()->post('https://adm.klinikhappykids.com/api/dt_pasien', $datas);

        DB::table('dt_pasien')->whereIn('id_pasien', $id_data)->update(['export' => 'Y']);
        return redirect()->route('exportServer')->with('sukses', 'Data berhasil di export');
    }

    public function exportInv()
    {
        $inv  = DB::table('invoice')->where('export', 'T')->get();
        $invKunjungan  = DB::table('invoice_kunjungan')->where('export', 'T')->get();
        $invPeriksa  = DB::table('invoice_periksa')->where('export', 'T')->get();
        $invRegistrasi  = DB::table('invoice_registrasi')->where('export', 'T')->get();
        $invTp  = DB::table('invoice_therapy')->where('export', 'T')->get();
        $saldo  = DB::table('saldo_therapy')->where('export', 'T')->get();
        
        $idInv = [];
        $idKunjungan = [];
        $idPeriksa = [];
        $idRegistrasi = [];
        $idTp = [];
        $idSaldo = [];

        $datasInv = [];
        $datasKunjungan = [];
        $datasPeriksa = [];
        $datasRegistrasi = [];
        $datasTp = [];
        $datasSaldo = [];

        // invoice
        foreach($inv as $t) {
            $idInv[] = $t->id_invoice;
            array_push($datasInv, [
                'id_invoice' => $t->id_invoice,
                'tgl' => $t->tgl,
                'no_order' => $t->no_order,
                'urutan' => $t->urutan,
                'member_id' => $t->member_id,
                'rupiah' => $t->rupiah,
                'bayar' => $t->bayar,
                'selesai' => $t->selesai,
                'status' => $t->status,
                'pembayaran' => $t->pembayaran,
                'admin' => $t->admin,
                'keluhan' => $t->keluhan,
            ]);
        }
        $response = Http::acceptJson()->post('https://adm.klinikhappykids.com/api/invoice', $datasInv);
        DB::table('invoice')->whereIn('id_invoice', $idInv)->update(['export' => 'Y']);

        // inv kunjungan
        foreach($invKunjungan as $t) {
            $idKunjungan[] = $t->id_invoice_kunjungan;
            array_push($datasKunjungan, [
                'id_invoice_kunjungan' => $t->id_invoice_kunjungan,
                'tgl' => $t->tgl,
                'no_order' => $t->no_order,
                'urutan' => $t->urutan,
                'member_id' => $t->member_id,
                'admin' => $t->admin,
            ]);
        }
        $response = Http::acceptJson()->post('https://adm.klinikhappykids.com/api/invoice_kunjungan', $datasKunjungan);
        DB::table('invoice_kunjungan')->whereIn('id_invoice_kunjungan', $idKunjungan)->update(['export' => 'Y']);
        
        // inv periksa
        foreach($invPeriksa as $t) {
            $idPeriksa[] = $t->id_invoice_periksa;
            array_push($datasPeriksa, [
                'id_invoice_periksa' => $t->id_invoice_periksa,
                'tgl' => $t->tgl,
                'no_order' => $t->no_order,
                'urutan' => $t->urutan,
                'member_id' => $t->member_id,
                'admin' => $t->admin,
                'id_dokter' => $t->id_dokter,
                'pembayaran' => $t->pembayaran,
                'status' => $t->status,
                'rupiah' => $t->rupiah,
            ]);
        }
        $response = Http::acceptJson()->post('https://adm.klinikhappykids.com/api/invoice_periksa', $datasPeriksa);
        DB::table('invoice_periksa')->whereIn('id_invoice_periksa', $idPeriksa)->update(['export' => 'Y']);

        // inv registrasi
        foreach($invRegistrasi as $t) {
            $idRegistrasi[] = $t->id_registrasi;
            array_push($datasRegistrasi, [
                'id_registrasi' => $t->id_registrasi,
                'tgl' => $t->tgl,
                'no_order' => $t->no_order,
                'urutan' => $t->urutan,
                'member_id' => $t->member_id,
                'rupiah' => $t->rupiah,
                'status' => $t->status,
                'pembayaran' => $t->pembayaran,
                'admin' => $t->admin,
            ]);
        }
        $response = Http::acceptJson()->post('https://adm.klinikhappykids.com/api/invoice_registrasi', $datasRegistrasi);
        DB::table('invoice_registrasi')->whereIn('id_registrasi', $idRegistrasi)->update(['export' => 'Y']);

        // inv tp
        foreach($invTp as $t) {
            $idTp[] = $t->id_invoice_therapy;
            array_push($datasTp, [
                'id_invoice_therapy' => $t->id_invoice_therapy,
                'tgl' => $t->tgl,
                'no_order' => $t->no_order,
                'urutan' => $t->urutan,
                'member_id' => $t->member_id,
                'pembayaran' => $t->pembayaran,
                'rupiah' => $t->rupiah,
                'admin' => $t->admin,
            ]);
        }
        $response = Http::acceptJson()->post('https://adm.klinikhappykids.com/api/invoice_tp', $datasTp);
        DB::table('invoice_therapy')->whereIn('id_invoice_therapy', $idTp)->update(['export' => 'Y']);

        // saldo
        foreach($saldo as $t) {
            $idSaldo[] = $t->id_saldo_therapy;
            array_push($datasSaldo, [
                'id_saldo_therapy' => $t->id_saldo_therapy,
                'no_order' => $t->no_order,
                'debit' => $t->debit,
                'kredit' => $t->kredit,
                'tgl' => $t->tgl,
                'admin' => $t->admin,
                'id_paket' => $t->id_paket,
                'id_therapist' => $t->id_therapist,
                'total_rp' => $t->total_rp,
                'member_id' => $t->member_id,
            ]);
        }
        $response = Http::acceptJson()->post('https://adm.klinikhappykids.com/api/saldo', $datasSaldo);
        DB::table('saldo_therapy')->whereIn('id_saldo_therapy', $idSaldo)->update(['export' => 'Y']);

        return redirect()->route('exportServer')->with('sukses', 'Data berhasil di export');
    }
}
