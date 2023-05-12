<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Pertanyaan extends Controller
{
    public function Index(Request $r)
    {
        if (empty($r->hal)) {
            $hal = '1';
        } else {
            $hal = $r->hal;
        }
        $data = [
            'title' => 'Isi Formulir',
            'per' => DB::table('pertanyaan')->whereBetween('id_pertanyaan', [1, 5])->get(),
            'per2' => DB::table('pertanyaan')->whereBetween('id_pertanyaan', [6, 10])->get(),
            // 'per3' => DB::table('pertanyaan')->where('kelompok_pertanyaan', '2')->get(),
            'kel_kpsp' => DB::table('kel_kpsp')->get(),
            'peds' => DB::table('pertanyaan')->where('kelompok_pertanyaan', '3')->get(),
            'chat' => DB::table('pertanyaan')->where('kelompok_pertanyaan', '4')->paginate(5),
            'hal' =>  $hal,
            'no_order' => $r->no_order,
            'member_id' => $r->member_id,
        ];
        return view("isiformulir.index", $data);
    }

    public function form1(Request $r)
    {
        $data = [
            'title' => 'Isi Formulir',
            'per' => DB::table('pertanyaan')->whereBetween('id_pertanyaan', [1, 5])->get(),
            'per2' => DB::table('pertanyaan')->whereBetween('id_pertanyaan', [6, 10])->get(),
            // 'per3' => DB::table('pertanyaan')->where('kelompok_pertanyaan', '2')->get(),
            'kel_kpsp' => DB::table('kel_kpsp')->get(),
            'peds' => DB::table('pertanyaan')->where('kelompok_pertanyaan', '3')->get(),
            'chat' => DB::table('pertanyaan')->where('kelompok_pertanyaan', '4')->paginate(5),
            'no_order' => $r->no_order,
            'member_id' => $r->member_id,
        ];
        return view("isiformulir.step1", $data);
    }

    public function tbh_pertanyaan1(Request $r)
    {
        $jawaban = $r->jawaban;
        $id_pertanyaan = $r->id_pertanyaan;

        for ($x = 0; $x < count($id_pertanyaan); $x++) {
            DB::table('jawaban1')->where(['no_order' => $r->no_order, 'member_id' => $r->member_id, 'id_pertanyaan' => $id_pertanyaan[$x]])->delete();
            $data = [
                'jawaban1' => $jawaban[$x],
                'id_pertanyaan' => $id_pertanyaan[$x],
                'no_order' => $r->no_order,
                'tgl' => date('Y-m-d'),
                'member_id' => $r->member_id
            ];
            DB::table('jawaban1')->insert($data);
        }
    }
    public function form2(Request $r)
    {
        $data = [
            'title' => 'Isi Formulir',
            'per' => DB::table('pertanyaan')->whereBetween('id_pertanyaan', [1, 5])->get(),
            'per2' => DB::table('pertanyaan')->whereBetween('id_pertanyaan', [6, 10])->get(),
            // 'per3' => DB::table('pertanyaan')->where('kelompok_pertanyaan', '2')->get(),
            'kel_kpsp' => DB::table('kel_kpsp')->get(),
            'peds' => DB::table('pertanyaan')->where('kelompok_pertanyaan', '3')->get(),
            'chat' => DB::table('pertanyaan')->where('kelompok_pertanyaan', '4')->paginate(5),
            'no_order' => $r->no_order,
            'member_id' => $r->member_id,
        ];
        return view("isiformulir.step2", $data);
    }

    public function tbh_pertanyaan2(Request $r)
    {
        $jawaban = $r->jawaban;
        $id_pertanyaan = $r->id_pertanyaan;

        for ($x = 0; $x < count($id_pertanyaan); $x++) {
            DB::table('jawaban2')->where(['no_order' => $r->no_order, 'member_id' => $r->member_id, 'id_pertanyaan' => $id_pertanyaan[$x]])->delete();
            $l = 1;
            $data = [
                'jawaban2' => $jawaban[$x],
                'id_pertanyaan' => $id_pertanyaan[$x],
                'no_order' => $r->no_order,
                'tgl' => date('Y-m-d'),
                'member_id' => $r->member_id
            ];
            DB::table('jawaban2')->insert($data);
            $l++;
        }
    }
    public function form3(Request $r)
    {
        $data = [
            'title' => 'Isi Formulir',
            'per' => DB::table('pertanyaan')->whereBetween('id_pertanyaan', [1, 5])->get(),
            'per2' => DB::table('pertanyaan')->whereBetween('id_pertanyaan', [6, 10])->get(),
            // 'per3' => DB::table('pertanyaan')->where('kelompok_pertanyaan', '2')->get(),
            'kel_kpsp' => DB::table('kel_kpsp')->get(),
            'peds' => DB::table('pertanyaan')->where('kelompok_pertanyaan', '3')->get(),
            'chat' => DB::table('pertanyaan')->where('kelompok_pertanyaan', '4')->paginate(5),
            'no_order' => $r->no_order,
            'member_id' => $r->member_id,
            'pasien' => DB::table('dt_pasien')->where('member_id', $r->member_id)->first(),
            'ayah' => DB::table('dt_orang_tua')->where(['member_id_pasien' => $r->member_id, 'orang_tua' => 'Ayah'])->first(),
            'ibu' => DB::table('dt_orang_tua')->where(['member_id_pasien' => $r->member_id, 'orang_tua' => 'Ibu'])->first(),

        ];
        return view("isiformulir.step3", $data);
    }

    public function tbh_pertanyaan3(Request $r)
    {
        $komentar = $r->komentar;
        $id_pertanyaan = $r->id_pertanyaan;
        $pilihan = $r->pilihan;

        for ($x = 0; $x < count($id_pertanyaan); $x++) {
            DB::table('jawaban3')->where(['no_order' => $r->no_order, 'member_id' => $r->member_id, 'id_pertanyaan' => $id_pertanyaan[$x]])->delete();
            $l = 1;
            $data = [
                'jawaban3' => $komentar[$x],
                'id_pertanyaan' => $id_pertanyaan[$x],
                'pilihan' => $pilihan[$x],
                'tgl' => date('Y-m-d'),
                'no_order' => $r->no_order,
                'member_id' => $r->member_id
            ];
            DB::table('jawaban3')->insert($data);
            $l++;
        }
    }

    public function form4(Request $r)
    {
        if (empty($r->page)) {
            $page =  1;
        } else {
            $page =  $r->page + 1;
        }



        $data = [
            'title' => 'Isi Formulir',
            'per' => DB::table('pertanyaan')->whereBetween('id_pertanyaan', [1, 5])->get(),
            'per2' => DB::table('pertanyaan')->whereBetween('id_pertanyaan', [6, 10])->get(),
            // 'per3' => DB::table('pertanyaan')->where('kelompok_pertanyaan', '2')->get(),
            'kel_kpsp' => DB::table('kel_kpsp')->get(),
            'peds' => DB::table('pertanyaan')->where('kelompok_pertanyaan', '3')->get(),
            'chat' => DB::table('pertanyaan')->where('kelompok_pertanyaan', '4')->paginate(5),
            'page' => $page,
            'no_order' => $r->no_order,
            'member_id' => $r->member_id,
        ];
        return view('isiformulir.step4', ['page' => 1], $data)->render();
    }

    public function tbh_pertanyaan4(Request $r)
    {
        $jawaban = $r->jawaban;
        $id_pertanyaan = $r->id_pertanyaan;


        // dd($jawaban);

        for ($x = 0; $x < count($id_pertanyaan); $x++) {
            $l = 1;
            DB::table('jawaban4')->where(['no_order' => $r->no_order, 'member_id' => $r->member_id, 'id_pertanyaan' => $id_pertanyaan[$x]])->delete();
            $data = [
                'jawaban4' => $jawaban[$x],
                'id_pertanyaan' => $id_pertanyaan[$x],
                'no_order' => $r->no_order,
                'tgl' => date('Y-m-d'),
                'member_id' => $r->member_id
            ];
            DB::table('jawaban4')->insert($data);
            $l++;
        }
    }
}
