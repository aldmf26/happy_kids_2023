<?php

namespace App\Http\Controllers;

use App\Mail\kunjungan;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Invoice_kunjungan extends Controller
{
    function index(Request $r)
    {
        $tgl1 = $r->tgl1 ?? date('Y-m-1');
        $tgl2 =  $r->tgl2 ?? date('Y-m-t');

        $data = [
            'title' => 'Data Invoice Kunjungan',
            'dt_pasien' => DB::table('dt_pasien')->where('nonaktif', 'T')->get(),
            'invoice_kunjungan' => DB::select("SELECT b.member_id as member, a.id_invoice_kunjungan, a.tgl, a.no_order, b.nama_pasien, a.member_id
            FROM invoice_kunjungan AS a
            LEFT JOIN dt_pasien AS b ON b.id_pasien = a.member_id
            WHERE a.tgl BETWEEN '$tgl1' AND '$tgl2'
            ORDER BY a.id_invoice_kunjungan DESC"),
            'paket' => DB::table('dt_paket')->where('nonaktif', 'T')->get(),
            'therapist' => DB::table('dt_therapy')->where('nonaktif', 'T')->get(),

        ];
        return view('invoice_kunjungan.index', $data);
    }

    public function data_paket_kunjungan(Request $r)
    {
        $member_id = $r->member_id;
        $pasien = DB::table('dt_pasien')->where('id_pasien',$member_id)->first();
        $data = [
            'invoice_kunjungan' => DB::select("SELECT a.id_paket, a.id_therapist,  b.nama_paket, c.nama_therapy, sum(a.debit) as debit, sum(a.kredit) as kredit, a.total_rp, a.no_order
            FROM saldo_therapy as a 
            LEFT JOIN dt_paket as b on b.id_paket = a.id_paket
            LEFT JOIN dt_therapy AS c ON c.id_therapy = a.id_therapist
            LEFT JOIN dt_pasien as d ON d.id_pasien = a.member_id
            WHERE d.member_id = '$pasien->member_id'
            GROUP BY a.id_paket"),
        ];
        return view('invoice_kunjungan.dt_paket', $data);
    }

    public function save_invoice_kunjungan(Request $r)
    {
        $tgl = $r->tgl;
        $member_id = $r->member_id;
        $invoice = DB::selectOne("SELECT max(a.urutan) as urutan FROM invoice_kunjungan as a");

        $no_order = empty($invoice->urutan) ? 1001 : $invoice->urutan + 1;

        $id_therapist = $r->id_therapist;
        $id_paket = $r->id_paket;
        $kredit = $r->kredit;
        $kosong = true;

        foreach ($kredit as $k) {
            if ($k != 0) {
                $kosong = false;
            }
        }

        if ($kosong) {
            return redirect()->back()->with('error', 'Data kosong semua');
        }

        for ($x = 0; $x < count($id_therapist); $x++) {
            $data = [
                'id_therapist' => $id_therapist[$x],
                'id_paket' => $id_paket[$x],
                'kredit' => $kredit[$x],
                'no_order' => 'Hk-' . $no_order,
                'tgl' => $tgl,
                'member_id' => $member_id,
                'admin' => Auth::user()->name
            ];
            DB::table('saldo_therapy')->insert($data);
        }

        $data =  [
            'tgl' => $tgl,
            'no_order' => 'Hk-' . $no_order,
            'member_id' => $member_id,
            'urutan' => $no_order,
            'admin' => Auth::user()->name
        ];
        DB::table('invoice_kunjungan')->insert($data);

        return redirect()->route('invoice_kunjungan')->with('sukses', 'Berhasil tambah pertanyaan');
    }

    public function hapus_invoice_kunjungan(Request $r)
    {
        $no_order = $r->no_order;
        DB::table('invoice_kunjungan')->where('no_order', $no_order)->update(['nonaktif' => 'Y']);
        DB::table('saldo_therapy')->where([['no_order', $no_order], ['debit', 0]])->update(['nonaktif' => 'Y']);

        return redirect()->route('invoice_kunjungan')->with('sukses', 'Berhasil hapus pertanyaan');
    }

    public function detailSaldo(Request $r)
    {
        $member_id = $r->member_id;
        $no_order = $r->no_order;
        $nama = DB::table('dt_pasien')->where('id_pasien', $member_id)->first()->nama_pasien;
        $data = [
            'invoice_kunjungan' => DB::select("SELECT a.debit,a.kredit,a.no_order,c.nama_therapy,b.nama_paket FROM `saldo_therapy` as a
            LEFT JOIN dt_paket as b on b.id_paket = a.id_paket
            LEFT JOIN dt_therapy AS c ON c.id_therapy = a.id_therapist
            WHERE a.no_order = '$no_order' AND a.kredit != 0"),
            'nama' => $nama
        ];
        return view('invoice_kunjungan.detailSaldo', $data);
    }

    public function export_cronjob(Request $r)
    {
        $tgl1 = date('Y-m-d');

        $kunjungan = DB::selectOne("SELECT c.member_id as member,a.tgl, a.no_order, c.member_id, c.nama_pasien, b.nama_therapy, d.nama_paket, a.kredit
        FROM saldo_therapy as a
        left JOIN dt_therapy as b on b.id_therapy = a.id_therapist
        left join dt_pasien as c on c.id_pasien = a.member_id
        left join dt_paket as d on d.id_paket = a.id_paket
        where a.tgl = '$tgl1' and  a.kredit != '0';");

        $user = DB::table('users')->where('role', 'presiden')->get();

        if (empty($kunjungan->tgl)) {
        } else {
            foreach ($user as $u) {
                $email = $u->email;
                Mail::to($email)->send(new kunjungan($email));
            }
        }
    }

    public function download_cronjob(Request $r)
    {
        $tgl1 = $r->tgl1;

        $kunjungan = DB::select("SELECT a.tgl, a.no_order, c.member_id, c.nama_pasien, b.nama_therapy, d.nama_paket, a.kredit
        FROM saldo_therapy as a
        left JOIN dt_therapy as b on b.id_therapy = a.id_therapist
        left join dt_pasien as c on c.id_pasien = a.member_id
        left join dt_paket as d on d.id_paket = a.id_paket
        where a.tgl = '$tgl1' and  a.kredit != '0';");


        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0);
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Kunjungan');

        $sheet
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Tanggal')
            ->setCellValue('C1', 'No Order')
            ->setCellValue('D1', 'Member ID')
            ->setCellValue('E1', 'Nama Pasien')
            ->setCellValue('F1', 'Nama Therapist')
            ->setCellValue('G1', 'Nama Paket')
            ->setCellValue('H1', 'Paket Dipakai');
        $sheet->getStyle("A1:H1")->getFont()->setBold(true);

        $kolom = 2;

        foreach ($kunjungan as $no => $d) {
            $sheet->setCellValue("A$kolom", $no + 1)
                ->setCellValue("B$kolom", $d->tgl)
                ->setCellValue("C$kolom", $d->no_order)
                ->setCellValue("D$kolom", $d->member_id)
                ->setCellValue("E$kolom", $d->nama_pasien)
                ->setCellValue("F$kolom", $d->nama_therapy)
                ->setCellValue("G$kolom", $d->nama_paket)
                ->setCellValue("H$kolom", $d->kredit);

            $kolom++;
        }

        $writer = new Xlsx($spreadsheet);
        $style = [
            'borders' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ],
            ],
        ];

        $batas = $kolom - 1;
        $sheet->getStyle('A1:H' . $batas)->applyFromArray($style);


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Kunjungan.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
