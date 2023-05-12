<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisInvController extends Controller
{
    public function index()
    {
  
        $data = [
            'title' => 'Jenis Invoice Periksa',
            'jenis_inv' => DB::table('jenis_inv')->get()
        ];

        return view('jenis_inv.jenis_inv',$data);
    }

    public function tbh_jenis_inv(Request $r)
    {
        DB::table('jenis_inv')->insert([
            'nm_jenis' => $r->nm_jenis,
            'nominal' => $r->nominal,
        ]);

        return  redirect()->route('jenis_inv')->with('sukses', 'Berhasil tambah jenis inv');
    }

    public function edit_jenis_inv(Request $r)
    {
        DB::table('jenis_inv')->where('id_jenis_inv', $r->id_jenis_inv)->update([
            'nm_jenis' => $r->nm_jenis,
            'nominal' => $r->nominal,
        ]);
        return redirect()->route('jenis_inv')->with('sukses', 'sukses');
    }

    public function hps_jenis_inv(Request $r)
    {
        DB::table('jenis_inv')->where('id_jenis_inv', $r->id_jenis_inv)->delete();
        return redirect()->route('jenis_inv')->with('sukses', 'sukses');
    }
}
