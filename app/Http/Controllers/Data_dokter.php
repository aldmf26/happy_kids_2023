<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nonaktif;

class Data_dokter extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Data Dokter',
            'dokter' => DB::table('dt_dokter')->where('nonaktif', '!=', 'Y')->orderBy('id_dokter', 'desc')->get()
        ];
        return view('dokter.index', $data);
    }

    public function tbh_dokter(Request $r)
    {

        $data = ['nm_dokter' => $r->nm_dokter];
        DB::table('dt_dokter')->insert($data);

        return redirect()->route('tb_dokter')->with('sukses', 'sukses');
    }
    public function edit_dokter(Request $r)
    {
        Nonaktif::edit('dt_dokter', 'id_dokter', $r->id_dokter, ['nm_dokter' => $r->nm_dokter]);

        return redirect()->route('tb_dokter')->with('sukses', 'sukses');
    }
    public function hps_dokter(Request $r)
    {
        DB::table('dt_dokter')->where('id_dokter', $r->id_dokter)->update(['nonaktif' => 'Y']);

        return redirect()->route('tb_dokter')->with('sukses', 'sukses');
    }
}
