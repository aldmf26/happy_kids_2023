<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExportTherapist extends Controller
{
    public function index(Request $r)
    {
        $tgl1 = $r->tgl1;
        $tgl2 = $r->tgl2;

        $terapi = DB::table('dt_therapy')->get();
        $spreadsheet = new Spreadsheet();
        foreach($terapi as $i => $r) {

            $detail = DB::select("SELECT b.tgl,a.nama_therapy,b.kredit,c.nama_paket,d.member_id,d.nama_pasien FROM dt_therapy a
            LEFT JOIN saldo_therapy b ON a.id_therapy = b.id_therapist
            LEFT JOIN dt_paket c ON b.id_paket = c.id_paket
            LEFT JOIN dt_pasien as d ON b.member_id = d.member_id
            WHERE  b.tgl BETWEEN '$tgl1' AND '$tgl2' AND a.id_therapy = '$r->id_therapy' AND b.kredit != 0
            GROUP BY b.id_saldo_therapy");

            $spreadsheet->createSheet();
            $spreadsheet->setActiveSheetIndex($i);
            $s = 'sheet'.$i;
            $s = $spreadsheet->getActiveSheet();
            $s->setTitle($r->nama_therapy);
            
            if(empty($detail)){
                $s
                ->setCellValue('A1', 'No')
                ->setCellValue('B1', 'Tanggal')
                ->setCellValue('C1', 'Member ID')
                ->setCellValue('D1', 'Nama Pasien')
                ->setCellValue('E1', 'Nama Paket')
                ->setCellValue('F1', 'Paket Terpakai');
            } else {
                $no = 1;
                $kolom = 2;

                $s
                ->setCellValue('A1', 'No')
                ->setCellValue('B1', 'Tanggal')
                ->setCellValue('C1', 'Member ID')
                ->setCellValue('D1', 'Nama Pasien')
                ->setCellValue('E1', 'Nama Paket')
                ->setCellValue('F1', 'Paket Terpakai');

                foreach($detail as $d) {
                    $s
                    ->setCellValue("A$kolom", $no++)
                    ->setCellValue("B$kolom", $d->tgl)
                    ->setCellValue("C$kolom", $d->member_id)
                    ->setCellValue("D$kolom", $d->nama_pasien)
                    ->setCellValue("E$kolom", $d->nama_paket)
                    ->setCellValue("F$kolom", $d->kredit);
                    $kolom++;
                }
                $s->getStyle("A1:F1")->getFont()->setBold( true );
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

                $bataskun = $kolom - 1;
                $s->getStyle('A1:F' . $bataskun)->applyFromArray($style);
            }

        }

        $namafile = "Data Therapist $tgl1 ~ $tgl2.xlsx";

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$namafile);
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');

    }
}
