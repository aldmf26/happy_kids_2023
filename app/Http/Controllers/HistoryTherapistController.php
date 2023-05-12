<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryTherapistController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'History Paket',
            'history' => DB::table('dt_therapy')->get()
        ];
        return view('history.history',$data);
    }

    public function historyDetail(Request $r)
    {
        $tgl1 = $r->tgl1 ?? date('Y-m-1');
        $tgl2 = $r->tgl2 ?? date('Y-m-t');
        
        $data = [
            'detail' => DB::select("SELECT b.no_order,b.tgl,a.nama_therapy,b.kredit,c.nama_paket,d.member_id,d.nama_pasien FROM dt_therapy a
            LEFT JOIN saldo_therapy b ON a.id_therapy = b.id_therapist
            LEFT JOIN dt_paket c ON b.id_paket = c.id_paket
            LEFT JOIN dt_pasien as d ON b.member_id = d.member_id
            WHERE b.tgl BETWEEN '$tgl1' AND '$tgl2' AND a.id_therapy = '$r->id_therapy' AND b.kredit != 0
            GROUP BY b.id_saldo_therapy")
        ];
        return view('history.view2', $data);
    }
}
