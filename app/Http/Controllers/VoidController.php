<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoidController extends Controller
{
    public function index(Request $r)
    {
        $id_user = Auth::user()->id;
        $data = [
            'title' => 'Data Void',
            'void_menu' => DB::table('tb_menu_void')->get(),
            'id_user' => $id_user,
            'countPermission' => DB::table('void_permission')->where('id_user', $id_user)->count()
            // 'inv_screening' => DB::select("SELECT a.pembayaran,a.id_invoice,a.tgl, a.no_order, b.nama_pasien, b.member_id, a.status FROM invoice as a left join dt_pasien as b on b.member_id = a.member_id where a.tgl between '$tgl1' and '$tgl2' order by a.id_invoice DESC")
        ];

        return view('void.void', $data);
    }

    public function loadScreening(Request $r)
    {
        $data = [
            'inv_screening' => DB::select("SELECT a.pembayaran,a.id_invoice,a.tgl, a.no_order, b.nama_pasien, b.member_id, a.status FROM invoice as a left join dt_pasien as b on b.member_id = a.member_id where a.tgl between '$r->tgl1' and '$r->tgl2' order by a.id_invoice DESC")
        ];
        return view('void.loadScreening',$data);

    }

    public function loadPeriksa(Request $r)
    {
        $data = [
            'invoice_periksa' => DB::select("SELECT a.id_dokter,a.pembayaran,a.id_invoice_periksa, a.status, a.tgl, a.no_order, b.nama_pasien, b.member_id , c.nm_dokter
            FROM invoice_periksa as a 
            left join dt_pasien as b on b.member_id = a.member_id 
            left join dt_dokter as c on c.id_dokter = a.id_dokter
            where a.tgl BETWEEN '$r->tgl1' and '$r->tgl2' GROUP BY a.no_order order by a.id_invoice_periksa DESC"),
        ];
        return view('void.loadPeriksa',$data);

    }

    public function loadTerapi(Request $r)
    {
        $data = [
            'invoice_tp' => DB::select("SELECT a.pembayaran, a.id_invoice_therapy, a.tgl, a.no_order, b.nama_pasien, a.member_id, c.saldo
            FROM invoice_therapy AS a
            LEFT JOIN dt_pasien AS b ON b.member_id = a.member_id
            LEFT JOIN (
            SELECT a.id_paket, SUM(a.debit - a.kredit) AS saldo, a.no_order
            FROM saldo_therapy AS a
            GROUP BY a.no_order, a.id_paket
            HAVING SUM(a.debit - a.kredit) = 1
            ) AS c ON c.no_order = a.no_order
            WHERE a.tgl BETWEEN '$r->tgl1' AND '$r->tgl2'
            GROUP BY a.no_order
            ORDER BY a.id_invoice_therapy DESC"),
        ];
        return view('void.loadTerapi',$data);

    }

    public function loadKunjungan(Request $r)
    {
        $data = [
            'invoice_kunjungan' => DB::select("SELECT a.id_invoice_kunjungan, a.tgl, a.no_order, b.nama_pasien, a.member_id
            FROM invoice_kunjungan AS a
            LEFT JOIN dt_pasien AS b ON b.member_id = a.member_id
            WHERE a.tgl BETWEEN '$r->tgl1' AND '$r->tgl2'
            ORDER BY a.id_invoice_kunjungan DESC"),
        ];
        return view('void.loadKunjungan', $data);
    }
}
