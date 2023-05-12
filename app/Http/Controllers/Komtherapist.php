<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Komtherapist extends Controller
{
    public function index(Request $r)
    {
        if (empty($r->tgl1)) {
            $tgl1 = date('Y-m-01');
            $tgl2 = date('Y-m-t');
        } else {
            $tgl1 = $r->tgl1;
            $tgl2 = $r->tgl2;
        }

        $data = [
            'title' => 'Data Paket Pasien',
            'komisi' => DB::select("SELECT a.*, b.saldo, c.nominal,c.level
            FROM dt_therapy as a
            left join (
            SELECT b.id_therapist, sum(b.kredit) as saldo
               FROM saldo_therapy as b
                where b.tgl BETWEEN '$tgl1' and '$tgl2'
                group by b.id_therapist
            ) as b on b.id_therapist = a.id_therapy
            left join level_therapist as c on c.id_level_therapist = a.id_level"),
        ];
        return view('kom_therapis.index', $data);
    }
}
