<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Data_paket_pasien extends Controller
{
    public function index(Request $r)
    {
        $tgl = DB::selectOne("SELECT min(a.tgl) as tgl, a.penutup FROM saldo_therapy as a WHERE a.penutup = 'T'");  
        $tgl1Tutup = date('Y-m-01', strtotime($tgl->tgl));
        $tgl2Tutup = date('Y-m-t', strtotime($tgl->tgl));

        $data = [
            'title' => 'Data Paket Pasien',
            'data_paket_pasien' => DB::select("SELECT b.member_id,b.id_pasien, b.nama_pasien, c.saldo
            FROM invoice_therapy AS a
            LEFT JOIN dt_pasien AS b ON b.id_pasien = a.member_id
            LEFT JOIN (
            SELECT a.id_paket, SUM(a.debit - a.kredit) AS saldo, a.no_order
            FROM saldo_therapy AS a
            GROUP BY a.member_id, a.id_paket
            HAVING SUM(a.debit - a.kredit) = 1
            ) AS c ON c.no_order = a.no_order
            GROUP BY a.member_id ORDER BY b.member_id DESC"),
            'dt_pasien' => DB::table('dt_pasien')->where('nonaktif', 'T')->orderBy('member_id', 'DESC')->get(),
            'paket' => DB::table('dt_paket')->where('nonaktif', 'T')->get(),

            'tgl1Tutup' => $tgl1Tutup,
            'tgl2Tutup' => $tgl2Tutup,
        ];
        return view('dt_paket_pasien.index', $data);
    }

    public function view_paket_pasien(Request $r)
    {
        $member_id =  $r->member_id;
        $data = [
            'invoice' => DB::select("SELECT a.id_saldo_therapy,a.id_paket, b.nama_paket,b.harga, c.id_therapy,c.nama_therapy, sum(a.debit) as debit, sum(a.kredit) as kredit, a.total_rp, a.no_order, a.member_id
            FROM saldo_therapy as a 
            LEFT JOIN dt_paket as b on b.id_paket = a.id_paket
            LEFT JOIN dt_therapy AS c ON c.id_therapy = a.id_therapist
            WHERE a.member_id = '$member_id' 
            GROUP BY a.id_paket"),
        ];
        return view('dt_paket_pasien.view', $data);
    }

    public function view_paket_pasien2(Request $r)
    {
        $member_id =  $r->member_id;
        $id_paket =  $r->id_paket;

        $data = [
            'invoice_tp' => DB::select("SELECT a.tgl, b.nama_paket, a.id_paket, c.nama_therapy, a.debit, a.kredit, a.total_rp, a.no_order
            FROM saldo_therapy as a 
            LEFT JOIN dt_paket as b on b.id_paket = a.id_paket
            LEFT JOIN dt_therapy AS c ON c.id_therapy = a.id_therapist
            WHERE a.member_id = '$member_id' AND a.id_paket = '$id_paket'
            GROUP BY a.id_saldo_therapy"),
            'member_id' => $member_id,
            'paket' => DB::table('dt_paket')->where('id_paket', $id_paket)->first()
        ];
        return view('dt_paket_pasien.view2', $data);
    }

    public function viewEditTerapi(Request $r)
    {
        $member_id =  $r->member_id;
        $id_paket =  $r->id_paket;
        $data = [
            'invoice' => DB::select("SELECT a.id_saldo_therapy,a.id_paket, b.nama_paket, c.nama_therapy, sum(a.debit) as debit, sum(a.kredit) as kredit, a.total_rp, a.no_order, a.member_id
            FROM saldo_therapy as a 
            LEFT JOIN dt_paket as b on b.id_paket = a.id_paket
            LEFT JOIN dt_therapy AS c ON c.id_therapy = a.id_therapist
            WHERE a.member_id = '$member_id'
            GROUP BY a.id_paket"),
            'data_tp' => DB::table('dt_therapy')->get(),
            'id_terapi' => $r->id_terapi,
            'id_saldo_therapy' => $r->id_saldo_therapy
        ];
        return view('dt_paket_pasien.viewEditTerapi', $data);
    }

    public function editPaketTerapi(Request $r)
    {
        DB::table('saldo_therapy')->where([['id_therapist', $r->id_terapi_sebelum], ['kredit', 0]])->update([
            'id_therapist' => $r->id_terapi
        ]);
        $member = DB::table('saldo_therapy')->where('id_saldo_therapy', $r->id_saldo_terapi)->first()->member_id;
        echo $member;
    }

    public function tambah_paket_saldo(Request $r)
    {
        $data = [
            'title' => 'paket',
            'count' => $r->count,
            'member_id' => $r->member_id,
            'paket' => DB::table('dt_paket')->where('nonaktif', 'T')->get(),
            'therapist' => DB::table('dt_therapy')->where('nonaktif', 'T')->get(),
            'nominal' => DB::table('tb_nominal')->where([['jenis', 'inv_registrasi'], ['nonaktif', 'T']])->get()

        ];
        return view('dt_paket_pasien.tambah', $data);
    }

    public function save_saldo_pasien(Request $r)
    {
        $invoice = DB::selectOne("SELECT max(a.urutan) as urutan FROM invoice_therapy as a");
        $no_order = empty($invoice->urutan) ? 1001 : $invoice->urutan + 1;

        for ($i = 0; $i < count($r->id_paket); $i++) {
            $harga = DB::table('dt_paket')->where('id_paket', $r->id_paket[$i])->first()->harga;
            DB::table('saldo_therapy')->insert([
                'no_order' => 'HK-' . $no_order,
                'id_paket' => $r->id_paket[$i],
                'debit' => $r->jumlah[$i],
                'id_therapist' => $r->id_therapist[$i],
                'kredit' => 0,
                'total_rp' => $harga * $r->jumlah[$i],
                'member_id' => $r->member_id,
                'tgl' => date('Y-m-d'),
                'admin' => auth()->user()->name,
            ]);
        }
        DB::table('invoice_therapy')->insert([
            'no_order' => 'HK-' . $no_order,
            'urutan' => $no_order,
            'pembayaran' => 'CASH',
            'rupiah' => 0,
            'member_id' => $r->member_id,
            'tgl' => date('Y-m-d'),
            'admin' => auth()->user()->name,
        ]);

        return redirect()->route('dt_paket_pasien')->with('sukses', 'Data Berhasil ditambahkan');
    }

    public function penutup(Request $r)
    {
        $tgl = DB::selectOne("SELECT min(a.tgl) as tgl FROM saldo_therapy as a WHERE a.penutup = 'T'")->tgl;

        $tgl1 = date('Y-m-01', strtotime($tgl));
        $tgl2 = date('Y-m-t', strtotime($tgl));
        $nextMonth = Carbon::parse($tgl1)->addMonth()->toDateString();

        $saldo = DB::select("SELECT *
            FROM saldo_therapy as a 
            WHERE a.tgl BETWEEN '$tgl1' and '$tgl2' AND a.penutup = 'T'
            group by a.member_id");

        foreach ($saldo as $d) {

            // $max = DB::table('saldo_therapy')
            //     ->where('penutup', 'Y')
            //     ->max(DB::raw("REPLACE(no_order, 'HK-', '')"));

            // $no_order = empty($max) ? 1000 : $max + 1;

            $invoice = DB::selectOne("SELECT max(a.urutan) as urutan FROM invoice_therapy as a");
            $no_order = empty($invoice->urutan) ? 1001 : $invoice->urutan + 1;

            $data = [
                'no_order' => 'HK-' . $no_order,
                'debit' => $d->debit,
                'kredit' => $d->kredit,
                'tgl' => $nextMonth,
                'admin' => auth()->user()->name,
                'id_paket' => $d->id_paket,
                'id_therapist' => $d->id_therapist,
                'total_rp' => $d->total_rp,
                'member_id' => $d->member_id,
                'penutup' => 'T',
                'ket' => 'Penutup'
            ];

            DB::table('saldo_therapy')->insert($data);
            DB::table('saldo_therapy')
                ->where('id_saldo_therapy', $d->id_saldo_therapy)
                ->update(['penutup' => 'Y', 'nonaktif' => 'Y']);
        }
        return redirect()->route('dt_paket_pasien')->with(['tgl1Penutup' => $tgl1, 'tgl2Penutup' => $tgl2, 'count' => count($saldo)]);
    }
}
