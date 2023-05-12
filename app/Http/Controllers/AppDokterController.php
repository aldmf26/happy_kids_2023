<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppDokterController extends Controller
{
    public function index(Request $r)
    {
        $tgl = $r->view_tgl ?? date('Y-m-d');

        $tb_app_dokter = DB::select("SELECT * FROM `tb_app_dokter` as a
        LEFT JOIN dt_dokter as b ON a.nama_t = b.id_dokter where a.tanggal = '$tgl' group by b.id_dokter");

        $invoice = DB::select("SELECT b.nama_pasien, a.* FROM `invoice` as a
        LEFT JOIN dt_pasien as b ON a.member_id = b.member_id
        WHERE a.status = 'paid' AND a.no_order NOT IN (SELECT b.no_order FROM tb_order AS b)");

        $events = DB::select("SELECT a.*, b.*, c.* , d.nama_pasien FROM tb_order as a
        LEFT JOIN tb_app_dokter as b ON a.id_terapis = b.id_terapis
        LEFT JOIN dt_dokter as c ON c.id_dokter = b.nama_t
        LEFT JOIN dt_pasien AS d ON d.member_id = a.member_id
        WHERE a.tanggal = '$tgl'");

        $datas = [];
        $event = [];

        // ada validasi jika id role 1 ada total duit
        foreach ($tb_app_dokter as $app) {
            $d = [
                'id' => $app->id_dokter,
                'name' => $app->nm_dokter,
                'tzOffset' => $app->tzoffset,
            ];
            $datas[] = $d;
        }
        $now = date('Y-m-d');
        $now2 = date('D M d Y ', strtotime($now));



        foreach ($events as $e) {
            $start_t = $now2 . $e->start . ' GMT+0800 (Central Indonesia Time)';
            $end_t = $now2 . $e->end . ' GMT+0800 (Central Indonesia Time)';
            $d = [
                'name' =>   "($e->no_order)" . '-' . $e->nama_pasien,
                'location' =>  $e->location,
                'start' =>  $start_t,
                'end' =>   $end_t,
                'url' => $e->status,
                'className' => $e->bayar
            ];
            $event[] = $d;
        }


        $data = [
            'title' => 'Appointment Dokter',
            'tgl' => $tgl,
            'invoice' => $invoice,
            'dokter' => DB::table('dt_dokter')->get(),
            'datas' => json_encode($datas),
            'event' => json_encode($event),
        ];
        return view('app.app-dokter.dokter', $data);
    }

    public function tambah_terapi(Request $r)
    {
        $invoice = DB::select("SELECT * FROM `invoice` as a
        LEFT JOIN dt_pasien as b ON a.member_id = b.member_id
        WHERE a.status = 'paid'");
        $data = [
            'invoice' => $invoice,
            'dokter' => DB::table('dt_dokter')->get(),
            'c' => $r->c
        ];
        return view('app.tambah_terapi', $data);
    }

    public function save_dokter_app(Request $r)
    {
        $id_costumer = $r->customer;
        $dokter = $r->dokter;
        $start = $r->jam;

        $now = $r->tgl;



        $gagal = 0;
        for ($i = 0; $i < count($id_costumer); $i++) {
            $no_order = DB::table('invoice')->where('id_invoice', $id_costumer[$i])->first();
            $start2 = date('H:i:s', strtotime($start[$i]));
            // dd(Carbon::parse($start2));

            $end = date('H:i:s', strtotime('+2 Hours', strtotime($start2)));

            $ttl_jam = "2";
            $tgl = date('D M d Y ', strtotime($now));

            $start_t = $tgl . $start2 . ' GMT+0800 (Central Indonesia Time)';
            $end_t = $tgl . $end . ' GMT+0800 (Central Indonesia Time)';

            // $cek = DB::table('tb_order')->where([['start', $start[$i]], ['end', $end]])->first();
            $cek = DB::selectOne("SELECT a.no_order
            FROM tb_order AS a
            WHERE a.tanggal = '$now' AND '$end' > a.start AND '$start2' < a.end");
            if ($cek) {
                return redirect()->route('app_dokter')->with('error', 'Terjadi persamaan waktu didalam appoinment');
            } else {
                $data = [
                    'nama_t'    => $dokter[$i],
                    'tanggal'   => $now,
                    'tzoffset'  => '-10 * 60',
                    'ttl_jam' => "2"
                ];
                DB::table('tb_app_dokter')->insert($data);
                $id_terapis = DB::selectOne("SELECT id_terapis FROM tb_app_dokter ORDER BY id_terapis 
                DESC LIMIT 1");

                $data = [
                    'id_terapis'    => $id_terapis->id_terapis,
                    'id_customer'     => $id_costumer[$i],
                    'location'      => $dokter[$i],
                    'tanggal'       => $now,
                    'no_order'       => $no_order->no_order,
                    'member_id'       => $no_order->member_id,
                    'start'         => $start[$i],
                    'start_t'         => $start_t,
                    'end'           => $end,
                    'end_t'           => $end_t,
                    'total'           => 0
                ];
                DB::table('tb_order')->insert($data);
            }
        }

        return redirect()->route('app_dokter', ['view_tgl' => $now])->with('sukses', 'sukses');
    }

    public function hapus_dokter_app(Request $r)
    {
        $dokter = $r->dokter;
        $tgl = date('Y-m-d');

        $cek = DB::table('tb_order')->where([['id_terapis', $dokter], ['tanggal', $tgl]]);
        if ($cek) {
            return redirect()->route('app_dokter')->with('error', 'Ada dokter yang masih melakukan service');
        } else {
            DB::table('tb_app_dokter')->where([['nama_t', $dokter], ['tanggal', $tgl]])->delete();
        }
        return redirect()->route('app_dokter')->with('sukses', 'berhasil hapus appointment');
    }

    public function kelola_appoinment(Request $r)
    {
        $tgl = $r->view_tgl ?? date('Y-m-d');
        $dokter = DB::select("SELECT b.nm_dokter, a.*
        FROM tb_app_dokter AS a
        LEFT JOIN dt_dokter AS b ON b.id_dokter = a.nama_t
        WHERE a.tanggal = '$tgl' 
        GROUP BY a.nama_t");

        $invoice = DB::select("SELECT b.nama_pasien, a.* FROM `invoice` as a
        LEFT JOIN dt_pasien as b ON a.member_id = b.member_id
        WHERE a.status = 'paid' AND a.no_order NOT IN (SELECT b.no_order FROM tb_order AS b)");

        $data = [
            'title' => 'Kelola Appointment Dokter',
            'tgl' => $tgl,
            'dokter2' => $dokter,
            'invoice' => $invoice,
            'dokter' => DB::table('dt_dokter')->get(),
            'order' => DB::select("SELECT b.nama_pasien, a.*
            FROM tb_order AS a
            LEFT JOIN dt_pasien AS b ON b.member_id = a.member_id
            WHERE  a.tanggal = '$tgl'")
        ];
        return view('app.kelola_appoinment', $data);
    }

    public function edit_jam_appoinment(Request $r)
    {
        $id_order = $r->id_order;
        $start = $r->start;
        $end = $r->end;

        $tgl = $r->tgl;
        $dokter = $r->dokter;
        $id_terapis = $r->id_terapis;



        for ($x = 0; $x < count($id_order); $x++) {
            $start2 = date('H:i:s', strtotime($start[$x]));
            $end2 = date('H:i:s', strtotime($end[$x]));

            $tgl2 = date('D M d Y ', strtotime($tgl));
            $start_t = $tgl2 . $start2 . ' GMT+0800 (Central Indonesia Time)';
            $end_t = $tgl2 . $end2 . ' GMT+0800 (Central Indonesia Time)';

            $cek = DB::selectOne("SELECT a.no_order
            FROM tb_order AS a
            WHERE a.id_order != '$id_order[$x]' AND '$end2' > a.start AND '$start2' < a.end");

            if ($cek) {
                return redirect()->route('kelola_appoinment')->with('error', 'Terjadi persamaan waktu didalam appoinment');
            } else {
                $data = [
                    'start' => $start[$x],
                    'start_t'         => $start_t,
                    'end'           => $end[$x],
                    'end_t'           => $end_t,
                    'location' => $dokter[$x]
                ];
                DB::table('tb_order')->where('id_order', $id_order[$x])->update($data);
                $data = [
                    'nama_t'    => $dokter[$x],
                ];
                DB::table('tb_app_dokter')->where('id_terapis', $id_terapis[$x])->update($data);
            }
        }
        return redirect()->route('kelola_appoinment')->with('sukses', 'sukses');
    }

    public function cancel_appoinment(Request $r)
    {
        $id_order = $r->id_order;
        $id_terapis = $r->id_terapis;

        DB::table('tb_order')->where('id_order', $id_order)->delete();
        DB::table('tb_app_dokter')->where('id_terapis', $id_terapis)->delete();

        return redirect()->route('kelola_appoinment', ['view_tgl' => $r->tgl])->with('sukses', 'sukses');
    }
    public function selesai_appoinment(Request $r)
    {
        $id_order = $r->id_order;

        DB::table('tb_order')->where('id_order', $id_order)->update(['status' => 'Selesai']);


        return redirect()->route('kelola_appoinment', ['view_tgl' => $r->tgl])->with('sukses', 'sukses');
    }
    public function cancel_selesai_appoinment(Request $r)
    {
        $id_order = $r->id_order;

        DB::table('tb_order')->where('id_order', $id_order)->update(['status' => 'Berjalan']);


        return redirect()->route('kelola_appoinment', ['view_tgl' => $r->tgl])->with('sukses', 'sukses');
    }

    public function print_appoinment(Request $r)
    {
        if ($r->dokter == 'all') {
            $order = DB::select("SELECT b.nama_pasien, c.nm_dokter, a.*
            FROM tb_order AS a
            LEFT JOIN dt_pasien AS b ON b.member_id = a.member_id
            LEFT JOIN dt_dokter AS c ON c.id_dokter = a.location
            WHERE  a.tanggal between '$r->tgl1' and '$r->tgl2' ");
        } else {
            $order = DB::select("SELECT b.nama_pasien, c.nm_dokter, a.*
            FROM tb_order AS a
            LEFT JOIN dt_pasien AS b ON b.member_id = a.member_id
            LEFT JOIN dt_dokter AS c ON c.id_dokter = a.location
            WHERE  a.tanggal between '$r->tgl1' and '$r->tgl2' and a.location = '$r->dokter'");
        }

        $data = [
            'title' => 'Print Appoinment',
            'order' => $order,
            'tgl1' => $r->tgl1,
            'tgl2' => $r->tgl2
        ];

        return view('app.print_appoinment', $data);
    }
}
