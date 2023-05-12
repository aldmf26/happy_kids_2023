<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nonaktif;

class NominalController extends Controller
{
    public function index()
    {
        return redirect()->route('data_nominal',2);
    }

    public function data_nominal($tipe)
    {
        switch($tipe) {
            case '1':
                $title = "Screening";
                $jenis = 'inv_screening';
                break;
            case '2':
                $title = "Periksa";
                $jenis = 'inv_periksa';
                break;
            case '3':
                $title = "Registrasi";
                $jenis = 'inv_registrasi';
                break;
            case '4':
                $title = "Theraphy & Paket";
                $jenis = 'inv_tp';
                break;
            case '5':
                $title = "Kunjungan";
                $jenis = 'inv_kunjungan';
                break;
        }

        $data = [
            'title' => $title,
            'query' => DB::table('tb_nominal')->where([['jenis', $jenis],['nonaktif', '!=', 'Y']])->get(),
            'tipe' => $tipe,
            'jenis' => $jenis
        ];
        return view('nominal.tb_nominal',$data);
    }

    public function tambah_nominal($tipe, Request $r)
    {
        
        DB::table('tb_nominal')->where('jenis', $r->jenisInv)->insert([
            'nominal' => $r->nominal,
            'jenis' => $r->jenisInv,
            'nm_jenis' => $r->nm_jenis
        ]);

        return redirect()->route('data_nominal', $tipe)->with('sukses', 'Berhasil tambah nominal');
    }

    public function hapus_nominal($id,$tipe)
    {
        DB::table('tb_nominal')->where('id_nominal', $id)->update(['nonaktif' => 'Y']);
        return redirect()->route('data_nominal', $tipe)->with('sukses', 'Berhasil hapus nominal');
    }

    public function edit_nominal(Request $r)
    {
        Nonaktif::edit('tb_nominal', 'id_nominal', $r->id_nominal, [
            'nominal' => $r->nominal,
            'jenis' => $r->jenisInv,
            'nm_jenis' => $r->nm_jenis
        ]);
        return redirect()->route('data_nominal', $r->tipe)->with('sukses', 'Berhasil edit nominal');
    }
}
