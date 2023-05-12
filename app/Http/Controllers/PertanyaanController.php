<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PertanyaanController extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Pertanyaan',
            'sub_title' => 'Pertanyaan',
            'datas' => DB::select("SELECT * FROM `pertanyaan` as a
            LEFT JOIN kelompok_gerak as b ON a.id_gerak = b.id_gerak
            LEFT JOIN kel_kpsp as c ON a.id_kel_kpsp = c.id_kel_kpsp
            WHERE a.kelompok_pertanyaan = '1'"),
            'kel_gerak' => DB::table('kelompok_gerak')->get(),
            'kel_kpsp' => DB::table('kel_kpsp')->get(),
            'kelompok' => 1
        ];
        return view("pertanyaan.index", $data);
    }
    public function pertanyaan($kelompok)
    {
        switch ($kelompok) {
            case '1':
                $title = 'Psikomotoriq';
                break;
            case '2':
                $title = 'KPSP Pada Anak';
                break;
            case '3':
                $title = 'PEDS';
                break;
            case '4':
                $title = 'M-Chat-R';
                break;

            default:
                return redirect()->back()->with('error', 'Halaman tidak ada');
                break;
        }

        $data = [
            'title' => $title,
            'sub_title' => 'Pertanyaan',
            'datas' => DB::select("SELECT * FROM `pertanyaan` as a
            LEFT JOIN kelompok_gerak as b ON a.id_gerak = b.id_gerak
            LEFT JOIN kel_kpsp as c ON a.id_kel_kpsp = c.id_kel_kpsp
            WHERE a.kelompok_pertanyaan = '$kelompok'"),
            'kel_gerak' => DB::table('kelompok_gerak')->get(),
            'kel_kpsp' => DB::table('kel_kpsp')->get(),
            'kelompok' => $kelompok
        ];
        return view('pertanyaan.psikomotoriq', $data);
    }

    public function add_pertanyaan(Request $r)
    {

        DB::table('pertanyaan')->insert([
            'pertanyaan' => $r->pertanyaan,
            'kelompok_pertanyaan' => $r->kelompok,
            'id_gerak' => $r->id_gerak ?? 0,
            'id_kel_kpsp' => $r->id_kpsp ?? 0,
            'pilih' => empty($r->pilih) ? 'T' : 'Y',
        ]);
        return redirect()->route('pertanyaan', $r->kelompok)->with('sukses', 'Berhasil tambah pertanyaan');
    }

    public function get_gerak(Request $r)
    {
        $gerak = DB::table('kelompok_gerak')->get();
        echo '<select name="id_gerak" class="choices form-select" id="">';

        echo '<option selected value="0">- Pilih Gerak -</option>';
        foreach ($gerak as $k) {
            $selected = $k->id_gerak == $r->id_gerak ? "selected" : "";
            echo '<option ' . $selected . ' value=' . $k->id_gerak . '>' . $k->nm_gerak . '</option>';
        }
    }

    public function get_kpsp(Request $r)
    {
        $gerak = DB::table('kel_kpsp')->get();
        echo '<select name="id_kpsp" class="choices form-select" id="">';
        echo '<option selected value="0">- Pilih Kpsp -</option>';
        foreach ($gerak as $k) {
            $selected = $k->id_kel_kpsp == $r->id_kpsp ? "selected" : "";
            echo '<option ' . $selected . ' value=' . $k->id_kel_kpsp . '>' . $k->nm_kpsp . '</option>';
        }
    }

    public function edit_pertanyaan(Request $r)
    {
        DB::table('pertanyaan')->where('id_pertanyaan', $r->id_pertanyaan)->update([
            'pertanyaan' => $r->pertanyaan,
            'id_gerak' => $r->id_gerak ?? 0,
            'id_kel_kpsp' => $r->id_kpsp ?? 0,
        ]);

        return redirect()->route('pertanyaan', $r->kelompok)->with('sukses', 'Berhasil edit pertanyaan');
    }

    public function del_pertanyaan($id, $kelompok)
    {
        DB::table('pertanyaan')->where('id_pertanyaan', $id)->delete();

        return redirect()->route('pertanyaan', $kelompok)->with('sukses', 'Berhasil hapus pertanyaan');
    }
}
