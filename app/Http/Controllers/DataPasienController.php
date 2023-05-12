<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataPasienController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Pasien',
            'pasien' => DB::table('dt_pasien')->get()
        ];
        return view('data-pasien.data-pasien', $data);
    }

    public function load_view_pasien(Request $r)
    {
        $datas = DB::table('dt_pasien')->where('member_id', $r->member_id)->first();
        $data = [
            'datas' => $datas
        ];
        return view('data-pasien.view', $data);
    }
    public function load_view_member(Request $r)
    {
        $datas = DB::select("SELECT * FROM `jawaban1` WHERE member_id = '$r->member_id' GROUP BY no_order");
       
        $data = [
            'datas' => $datas
        ];
        return view('data-pasien.view_member', $data);
    }
}
