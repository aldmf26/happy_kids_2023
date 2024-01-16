<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Nonaktif;

class Data_pasien extends Controller
{
    public function index(Request $r)
    {
        $member_id = DB::selectOne("SELECT max(member_id) as member_id FROM `dt_pasien` ORDER BY member_id ASC;");
        $data = [
            'title' => 'Data Pasien',
            'pasien' => DB::table('dt_pasien')->where('nonaktif', 'T')->orderBy('member_id', 'DESC')->get(),
            
            'member_id' => empty($member_id->member_id) ? '5001' : $member_id->member_id + 1,
        ];
        return view('pasien.data_pasien', $data);
    }

    public function save_pasien(Request $r)
    {
        $member_id = $r->member_id;
        $tgl_lahir = $r->tgl_lahir;
        $nama = $r->nama;
        $no_telpon = $r->no_telpon;
        $cek = DB::table('dt_pasien')->where('member_id', $member_id)->first();



        if ($cek) {
            if ($r->page == 'screening') {
                echo 'gagal';
            } else {
                return redirect()->route('data_pasien')->with('error', 'Member ID sudah ada');
            }
        }
        $data = [
            'member_id' => $member_id,
            'nama_pasien' => $nama,
            'tgl_lahir' => $tgl_lahir,
            'no_hp' => $no_telpon,
            'alamat' => $r->alamat,
            'tgl' => date('Y-m-d'),
        ];

        DB::table('dt_pasien')->insert($data);
        if ($r->page == 'screening') {
            echo 'sukses';
        } else {
            return redirect()->route('data_pasien')->with('sukses', 'Berhasil disimpan');
        }
    }

    public function delete_pasien(Request $r)
    {
        DB::table('dt_pasien')->where('id_pasien', $r->id_pasien)->update(['nonaktif' => 'Y']);
        return redirect()->route('data_pasien')->with('sukses', 'Berhasil dihapus');
    }

    public function get_edit_pasien(Request $r)
    {
        $data = [
            'title' => 'Data Pasien',
            'pasien' => DB::table('dt_pasien')->where('id_pasien', $r->id_pasien)->first(),
        ];

        return view('pasien.edit', $data);
    }

    public function detail_pasien(Request $r)
    {
        $data = [
            'title' => 'Data Detail Pasien',
            'pasien' => DB::table('dt_pasien')->where('id_pasien', $r->id_pasien)->first(),
        ];

        return view('pasien.detail', $data);
    }

    public function edit_pasien(Request $r)
    {
        $member_id = $r->member_id;
        $tgl_lahir = $r->tgl_lahir;
        $nama = $r->nama;
        $no_telpon = $r->no_telpon;

        $data = [
            'member_id' => $member_id,
            'nama_pasien' => $nama,
            'tgl_lahir' => $tgl_lahir,
            'no_hp' => $no_telpon,
            'export' => 'T',
            'alamat' => $r->alamat,
        ];

        Nonaktif::edit('dt_pasien', 'id_pasien', $r->id_pasien, $data);

        return redirect()->route('data_pasien')->with('sukses', 'Berhasil disimpan');
    }

    public function get_pasien(Request $r)
    {
        $pasien = DB::table('dt_pasien')->where('member_id', $r->member_id)->first();
      
        // $kunjungan = DB::table('saldo_therapy')->where('member_id', $r->member_id)->first();
        $kunjungan = DB::selectOne("SELECT * FROM saldo_therapy as a where a.member_id = '$r->member_id' and a.id_paket = '$r->id_paket'");
        $kunjungan6bulan = DB::selectOne("SELECT tgl FROM saldo_therapy as a WHERE a.member_id = '$r->member_id' and  a.id_paket = '$r->id_paket' ORDER BY id_saldo_therapy  DESC LIMIT 1");

        if (empty($kunjungan)) {
            $kunjungan = false;
        } else {
            $kunjungan = true;
            $today = Carbon::today();
            $targetDate = Carbon::create($kunjungan6bulan->tgl);

            $diffInMonths = $today->diffInMonths($targetDate);

            $tgl = $diffInMonths;
        }

        return json_encode([
            'nama' => $pasien->nama_pasien,
            'kunjungan' => $kunjungan,
            'tglTerakhir' => $kunjungan ? $tgl : ''
        ]);
    }
}
