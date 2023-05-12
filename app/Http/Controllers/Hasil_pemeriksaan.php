<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hasil_pemeriksaan extends Controller
{
    public function index(Request $r)
    {
        if (empty($r->tgl1)) {
            $tgl1 = date('Y-m-01');
            $tgl2 = date('Y-m-t');
        } else {
            $tgl1 = $r->tgl1;
            $tgl2 =  $r->tgl2;
        }

        $data = [
            'title' => 'Data Hasil Pemeriksaan',
            'invoice' => DB::select("SELECT a.tgl, a.no_order, b.nama_pasien, b.member_id,a.status FROM invoice as a left join dt_pasien as b on b.member_id = a.member_id where a.tgl between '$tgl1' and '$tgl2'")
        ];
        return view('data-hasil.hasil', $data);
    }

    public function cetak(Request $r)
    {
        $data = [
            'title' => 'Data Hasil Pemeriksaan',
            'no_order' => $r->no_order,
            'per1' => DB::select("SELECT a.no_order, b.pertanyaan, a.jawaban1
            FROM jawaban1 AS a
            LEFT JOIN pertanyaan AS b ON b.id_pertanyaan = a.id_pertanyaan
            WHERE a.no_order = '$r->no_order'"),

            'per3' => DB::select("SELECT a.no_order, b.pertanyaan, a.jawaban3, a.pilihan
            FROM jawaban3 AS a
            LEFT JOIN pertanyaan AS b ON b.id_pertanyaan = a.id_pertanyaan
            WHERE a.no_order = '$r->no_order'"),

            'per4' => DB::select("SELECT a.no_order, b.pertanyaan, a.jawaban4
            FROM jawaban4 AS a
            LEFT JOIN pertanyaan AS b ON b.id_pertanyaan = a.id_pertanyaan
            WHERE a.no_order = '$r->no_order'"),

            'peds' => DB::table('pertanyaan')->where('kelompok_pertanyaan', '3')->get(),

            'pasien' => DB::table('dt_pasien')->where('member_id', $r->member_id)->first(),
            'ayah' => DB::table('dt_orang_tua')->where(['member_id_pasien' => $r->member_id, 'orang_tua' => 'Ayah'])->first(),
            'ibu' => DB::table('dt_orang_tua')->where(['member_id_pasien' => $r->member_id, 'orang_tua' => 'Ibu'])->first(),
            'kel_kpsp' => DB::table('kel_kpsp')->get(),


        ];
        return view('data-hasil.cetak', $data);
    }
}
