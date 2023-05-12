<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Str;

class ExportController extends Controller
{
    public function exportScreening(Request $r)
    {
        $tgl1 = $r->tgl1;
        $tgl2 = $r->tgl2;

        $screening = DB::select("SELECT a.rupiah,a.pembayaran,a.id_invoice,a.tgl, a.no_order, b.nama_pasien, b.member_id, a.status FROM invoice as a left join dt_pasien as b on b.id_pasien = a.member_id where a.tgl between '$tgl1' and '$tgl2' order by a.id_invoice DESC");

        $spreadsheet = new Spreadsheet();


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

        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(0);

        $sheet2 = $spreadsheet->getActiveSheet();
        $sheet2->setTitle('Invoice Periksa');

        $periksa = DB::select("SELECT a.rupiah,a.id_dokter,a.pembayaran,a.id_invoice_periksa, a.status, a.tgl, a.no_order, b.nama_pasien, b.member_id , c.nm_dokter
        FROM invoice_periksa as a 
        left join dt_pasien as b on b.id_pasien = a.member_id 
        left join dt_dokter as c on c.id_dokter = a.id_dokter
        where a.tgl BETWEEN '$tgl1' and '$tgl2' order by a.id_invoice_periksa DESC");

        $sheet2
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Tanggal')
            ->setCellValue('C1', 'Member ID')
            ->setCellValue('D1', 'No Order')
            ->setCellValue('E1', 'Dokter')
            ->setCellValue('F1', 'Nama Pasien')
            ->setCellValue('G1', 'Status')
            ->setCellValue('H1', 'Pembayaran')
            ->setCellValue('I1', 'Rupiah');
        $sheet2->getStyle("A1:I1")->getFont()->setBold(true);

        $kolper = 2;

        foreach ($periksa as $no => $d) {
            $sheet2->setCellValue("A$kolper", $no + 1)
                ->setCellValue("B$kolper", $d->tgl)
                ->setCellValue("C$kolper", $d->member_id)
                ->setCellValue("D$kolper", $d->no_order)
                ->setCellValue("E$kolper", $d->nm_dokter)
                ->setCellValue("F$kolper", $d->nama_pasien)
                ->setCellValue("G$kolper", $d->status)
                ->setCellValue("H$kolper", $d->pembayaran)
                ->setCellValue("I$kolper", $d->rupiah);

            $kolper++;
        }
        $batasper = $kolper - 1;
        $sheet2->getStyle('A1:I' . $batasper)->applyFromArray($style);

        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(1);
        $sheet3 = $spreadsheet->getActiveSheet();
        $sheet3->setTitle('Invoice Registrasi');

        $regis = DB::select("SELECT a.pembayaran,a.id_registrasi,a.tgl,a.rupiah, a.no_order, b.nama_pasien, b.member_id, a.status FROM invoice_registrasi as a left join dt_pasien as b on b.id_pasien = a.member_id where a.tgl between '$tgl1' and '$tgl2' order by a.id_registrasi DESC");

        $sheet3
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Tanggal')
            ->setCellValue('C1', 'Member ID')
            ->setCellValue('D1', 'No Order')
            ->setCellValue('E1', 'Nama Pasien')
            ->setCellValue('F1', 'Status')
            ->setCellValue('G1', 'Pembayaran')
            ->setCellValue('H1', 'Rupiah');
        $sheet3->getStyle("A1:H1")->getFont()->setBold(true);

        $kolreg = 2;
        foreach ($regis as $no => $r) {
            $sheet3
                ->setCellValue("A$kolreg", $no + 1)
                ->setCellValue("B$kolreg", $r->tgl)
                ->setCellValue("C$kolreg", $r->member_id)
                ->setCellValue("D$kolreg", $r->no_order)
                ->setCellValue("E$kolreg", $r->nama_pasien)
                ->setCellValue("F$kolreg", $r->status)
                ->setCellValue("G$kolreg", $r->pembayaran)
                ->setCellValue("H$kolreg", $r->rupiah);

            $kolreg++;
        }
        $batasreg = $kolreg - 1;
        $sheet3->getStyle('A1:H' . $batasreg)->applyFromArray($style);

        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(2);
        $sheet4 = $spreadsheet->getActiveSheet();
        $sheet4->setTitle('Invoice Therapy & Paket');

        $tp = DB::select("SELECT a.no_order,a.tgl,b.member_id,b.nama_pasien,a.pembayaran,c.rupiah FROM invoice_therapy as a 
        LEFT JOIN dt_pasien as b ON a.member_id = b.id_pasien
        LEFT JOIN(
            SELECT a.no_order,SUM(a.total_rp) as rupiah FROM saldo_therapy as a GROUP BY a.no_order
        ) as c ON a.no_order = c.no_order WHERE a.tgl BETWEEN '$tgl1' AND '$tgl2' ORDER BY a.no_order DESC");

        $sheet4
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Tanggal')
            ->setCellValue('C1', 'Member ID')
            ->setCellValue('D1', 'No Order')
            ->setCellValue('E1', 'Nama Pasien')
            ->setCellValue('F1', 'Status')
            ->setCellValue('G1', 'Pembayaran')
            ->setCellValue('H1', 'Rupiah');
        $sheet4->getStyle("A1:H1")->getFont()->setBold(true);

        $koltp = 2;
        foreach ($tp as $no => $r) {
            $sheet4
                ->setCellValue("A$koltp", $no + 1)
                ->setCellValue("B$koltp", $r->tgl)
                ->setCellValue("C$koltp", $r->member_id)
                ->setCellValue("D$koltp", $r->no_order)
                ->setCellValue("E$koltp", $r->nama_pasien)
                ->setCellValue("F$koltp", 'paid')
                ->setCellValue("G$koltp", $r->pembayaran)
                ->setCellValue("H$koltp", $r->rupiah);

            $koltp++;
        }
        $batastp = $koltp - 1;
        $sheet4->getStyle('A1:H' . $batastp)->applyFromArray($style);

        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(3);
        $sheet5 = $spreadsheet->getActiveSheet();
        $sheet5->setTitle('Invoice Kunjungan');

        $kunjungan = DB::select("SELECT a.id_invoice_kunjungan, a.tgl, a.no_order, b.nama_pasien, b.member_id
        FROM invoice_kunjungan AS a
        LEFT JOIN dt_pasien AS b ON b.id_pasien = a.member_id
        WHERE a.tgl BETWEEN '$tgl1' AND '$tgl2'
        ORDER BY a.id_invoice_kunjungan DESC");

        $sheet5
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Tanggal')
            ->setCellValue('C1', 'Member ID')
            ->setCellValue('D1', 'No Order')
            ->setCellValue('E1', 'Nama Pasien');
        $sheet5->getStyle("A1:E1")->getFont()->setBold(true);

        $kolkun = 2;
        foreach ($kunjungan as $no => $r) {
            $sheet5
                ->setCellValue("A$kolkun", $no + 1)
                ->setCellValue("B$kolkun", $r->tgl)
                ->setCellValue("C$kolkun", $r->member_id)
                ->setCellValue("D$kolkun", $r->no_order)
                ->setCellValue("E$kolkun", $r->nama_pasien);

            $kolkun++;
        }
        $bataskun = $kolkun - 1;
        $sheet5->getStyle('A1:E' . $bataskun)->applyFromArray($style);

        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(4);
        $sheet6 = $spreadsheet->getActiveSheet();
        $sheet6->setTitle('Data Paket Pasien');

        $pasien = DB::table('dt_pasien')->where('nonaktif', 'T')->orderBy('member_id', 'ASC')->get();

        $sheet6->getColumnDimension('D')->setWidth(43.18);
        $sheet6->getColumnDimension('F')->setWidth(13.73);
        $sheet6->getColumnDimension('E')->setWidth(45.73);
        $sheet6->getColumnDimension('G')->setWidth(25.00);
        $sheet6
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Id Pasien')
            ->setCellValue('C1', 'Kode')
            ->setCellValue('D1', 'Nama')
            ->setCellValue('E1', 'Alamat')
            ->setCellValue('F1', 'Tgl Lahir')
            ->setCellValue('G1', 'No HP');
        $paket = DB::table('dt_paket')->get();

        foreach ($paket as $i => $p) {
            $s = $i;
            $abjad1 = chr(96 + ($i + 7 % 26) + $i + 1);
            $abjad2 = chr(96 + ($i + 8 % 26) + $s + 1);

            $sheet6->getColumnDimension($abjad1)->setWidth(12.00);
            $sheet6->getColumnDimension($abjad2)->setWidth(15.82);

            $sheet6->setCellValue($abjad1 . '1', $p->nama_paket);
            $sheet6->setCellValue($abjad2 . '1', 'terapis');
            $i++;
        }
        $sheet6->getStyle('A1:' . $abjad2 . '1')->getFont()->setBold(true);


        $kol = 2;

        foreach ($pasien as $no => $d) {
            $sheet6->setCellValue("A$kol", $no + 1)
                ->setCellValue("B$kol", $d->id_pasien)
                ->setCellValue("C$kol", $d->member_id)
                ->setCellValue("D$kol", $d->nama_pasien)
                ->setCellValue("E$kol", $d->alamat)
                ->setCellValue("F$kol", $d->tgl_lahir)
                ->setCellValue("G$kol", $d->no_hp);

            foreach ($paket as $i => $p) {
                $s = $i;
                $abjad1 = chr(96 + ($i + 7 % 26) + $i + 1);
                $abjad2 = chr(96 + ($i + 8 % 26) + $s + 1);

                $saldo = DB::selectOne("SELECT a.member_id, a.id_paket, b.nama_therapy, SUM(a.debit) AS debit, SUM(a.kredit) AS kredit
                FROM saldo_therapy AS a
                LEFT JOIN dt_therapy AS b ON b.id_therapy = a.id_therapist
                WHERE a.member_id = '$d->member_id' AND a.id_paket ='$p->id_paket'
                GROUP BY a.member_id");
                $sisa_saldo = empty($saldo->debit) ? '' : $saldo->debit - $saldo->kredit;

                $sheet6->setCellValue($abjad1 . $kol, $sisa_saldo);
                $sheet6->setCellValue($abjad2 . $kol, empty($saldo->nama_therapy) ? '' : $saldo->nama_therapy);
                $i++;
            }
            $kol++;
        }

        $style = [
            'font' => array(
                'size' => 10,
                'name' => 'Comic Sans MS'
            ),
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ),
        ];
        $batas = count($pasien) + 1;
        $sheet6->getStyle('A1:' . $abjad2 . $batas)->applyFromArray($style);

        foreach ($paket as $i => $p) {
            $s = $i;
            $abjad1 = chr(96 + ($i + 7 % 26) + $i + 1);
            $abjad2 = chr(96 + ($i + 8 % 26) + $s + 1);
            $rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);


            //menghasilkan nilai acak untuk merah, hijau, dan biru
            $red = rand(128, 255);
            $green = rand(128, 255);
            $blue = rand(128, 255);

            //mengonversi nilai merah, hijau, dan biru ke format hexa
            $red_hex = dechex($red);
            $green_hex = dechex($green);
            $blue_hex = dechex($blue);

            //menggabungkan nilai merah, hijau, dan biru dalam format hexa untuk menciptakan warna hexa
            $color_hex = "$red_hex$green_hex$blue_hex";


            //mengatur warna latar belakang elemen HTML menggunakan warna yang dihasilkan secara acak dalam format hexa




            $sheet6->getStyle($abjad2 . '1' . ':' . $abjad2 . $batas)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB("$color_hex");
            $sheet6->getStyle($abjad1 . '1' . ':' . $abjad1 . $batas)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB("$color_hex");
            $i++;
        }



        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Invoice & Paket Pasien.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function exportPasien()
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->createSheet();

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Pasien');

        $pasien = DB::table('dt_pasien')->orderBy('member_id', 'ASC')->get();

        $sheet
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'ID Pasien')
            ->setCellValue('C1', 'Member ID')
            ->setCellValue('D1', 'Nama')
            ->setCellValue('E1', 'Alamat')
            ->setCellValue('F1', 'Tgl Lahir')
            ->setCellValue('G1', 'No HP');

        $sheet->getStyle("A1:G1")->getFont()->setBold(true);
        $sheet->getStyle("B1:C1")->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('d92121');

        $kol = 2;

        foreach ($pasien as $no => $d) {
            $sheet->setCellValue("A$kol", $no + 1)
                ->setCellValue("B$kol", $d->id_pasien)
                ->setCellValue("C$kol", $d->member_id)
                ->setCellValue("D$kol", $d->nama_pasien)
                ->setCellValue("E$kol", $d->alamat)
                ->setCellValue("F$kol", $d->tgl_lahir)
                ->setCellValue("G$kol", $d->no_hp);

            $kol++;
        }


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
        $batas = count($pasien) + 1;
        $sheet->getStyle('A1:G' . $batas)->applyFromArray($style);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Data Pasien.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function exportPaket()
    {
        $spreadsheet = new Spreadsheet();

        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(0);
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Pasien');

        $pasien = DB::table('dt_pasien')->orderBy('member_id', 'ASC')->get();

        $sheet->getColumnDimension('D')->setWidth(43.18);
        $sheet->getColumnDimension('F')->setWidth(13.73);
        $sheet->getColumnDimension('E')->setWidth(45.73);
        $sheet->getColumnDimension('G')->setWidth(25.00);
        $sheet
            ->setCellValue('A1', 'No')
            ->setCellValue('A2', '1')
            ->setCellValue('B1', 'Id Pasien')
            ->setCellValue('C1', 'Kode')
            ->setCellValue('D1', 'Nama')
            ->setCellValue('E1', 'Alamat')
            ->setCellValue('F1', 'Tgl Lahir')
            ->setCellValue('G1', 'No HP');
        $paket = DB::table('dt_paket')->get();

        foreach ($paket as $i => $p) {
            $s = $i;
            $abjad1 = chr(96 + ($i + 7 % 26) + $i + 1);
            $abjad2 = chr(96 + ($i + 8 % 26) + $s + 1);

            $sheet->getColumnDimension($abjad1)->setWidth(12.00);
            $sheet->getColumnDimension($abjad2)->setWidth(15.82);

            $sheet->setCellValue($abjad1 . '1', $p->nama_paket);
            $sheet->setCellValue($abjad2 . '1', 'Id Therapy');
            $i++;
        }

        $sheet->getStyle('A1:' . $abjad2 . '1')->getFont()->setBold(true);
        $sheet->getStyle("B1:C1")->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('d92121');



        $style = [
            'font' => array(
                'size' => 10,
                'name' => 'Comic Sans MS'
            ),
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ),
        ];
        $batas = 2;
        $sheet->getStyle('A1:' . $abjad2 . $batas)->applyFromArray($style);

        foreach ($paket as $i => $p) {
            $s = $i;
            $abjad1 = chr(96 + ($i + 7 % 26) + $i + 1);
            $abjad2 = chr(96 + ($i + 8 % 26) + $s + 1);
            $rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);


            //menghasilkan nilai acak untuk merah, hijau, dan biru
            $red = rand(0, 255);
            $green = rand(0, 255);
            $blue = rand(0, 255);

            //mengonversi nilai merah, hijau, dan biru ke format hexa
            $red_hex = dechex($red);
            $green_hex = dechex($green);
            $blue_hex = dechex($blue);

            //menggabungkan nilai merah, hijau, dan biru dalam format hexa untuk menciptakan warna hexa
            $color_hex = "$red_hex$green_hex$blue_hex";

            //mengatur warna latar belakang elemen HTML menggunakan warna yang dihasilkan secara acak dalam format hexa




            $sheet->getStyle($abjad2 . '1' . ':' . $abjad2 . $batas)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB("$color_hex");
            $sheet->getStyle($abjad1 . '1' . ':' . $abjad1 . $batas)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB("$color_hex");
            $i++;
        }

        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(1);
        $sheet1 = $spreadsheet->getActiveSheet();
        $sheet1->setTitle('Data Therapy');

        $dt_therapy = DB::table('dt_therapy as a')->join('dt_paket as b', 'a.id_paket', 'b.id_paket')->orderBy('a.id_therapy', 'ASC')->get();
        $sheet1->setCellValue('A1', 'ID Therapy')
            ->setCellValue('B1', 'Nama Therapy')
            ->setCellValue('C1', 'Nama Paket');

        $kol = 2;
        foreach ($dt_therapy as $d) {
            $sheet1->setCellValue('A' . $kol, $d->id_therapy)
                ->setCellValue('B' . $kol, $d->nama_therapy)
                ->setCellValue('C' . $kol, $d->nama_paket);
            $kol++;
        }
        $batas = count($dt_therapy) + 1;
        $sheet1->getStyle('A1:' . "C" . $batas)->applyFromArray($style);


        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Data Pasien.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function exportFormatPasien(Request $r)
    {
        $spreadsheet = new Spreadsheet();

        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(0);
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Format Data Pasien');

        $pasien = DB::table('dt_pasien')->orderBy('member_id', 'ASC')->get();

        $sheet->getColumnDimension('D')->setWidth(43.18);
        $sheet->getColumnDimension('F')->setWidth(13.73);
        $sheet->getColumnDimension('E')->setWidth(45.73);
        $sheet->getColumnDimension('G')->setWidth(25.00);
        $sheet->getStyle("B1")->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('d92121');
        $sheet->getStyle("B2")->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('d92121');
        $sheet->getStyle("B3")->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('d92121');
        $sheet
            ->setCellValue('A1', 'No')
            ->setCellValue('A2', 'Contoh')
            ->setCellValue('B1', 'Id Pasien')
            ->setCellValue('B2', 'baris ini dikosongkan')
            ->setCellValue('C1', 'Member ID')
            ->setCellValue('C2', 'Isi Member ID Tidak boleh sama')
            ->setCellValue('D1', 'Nama')
            ->setCellValue('D2', 'Baris ini diisikan nama lengkap')
            ->setCellValue('E1', 'Alamat')
            ->setCellValue('E2', 'Baris ini diisikan alaman')
            ->setCellValue('F1', 'Tgl Lahir')
            ->setCellValue('F2', 'Baris ini diisi Tgl Lahir')
            ->setCellValue('F2', 'format Y-m-d : 2023-03-03')
            ->setCellValue('G1', 'No HP')
            ->setCellValue('G2', 'Baris ini diisikan No HP');

        $style = [
            'font' => array(
                'size' => 10,
                'name' => 'Comic Sans MS'
            ),
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ),
        ];

        $sheet->getStyle('A1:' . "G3")->applyFromArray($style);


        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Format Data Pasien.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function importPaketPasien(Request $r)
    {
        $file = $r->file('file');
        $fileDiterima = ['xls', 'xlsx'];
        $cek = in_array($file->getClientOriginalExtension(), $fileDiterima);
        if ($cek) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx;
            $spreadsheet = $reader->load($file);
            $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            $numrow = 3;
            foreach ($sheet as $row) {
                if ($row['B'] == '' && $row['D'] == '') {
                    continue;
                }
                if ($numrow > 2) {
                    if ($row['B'] == '') {
                        dd($row['C']);
                        $member_id = DB::selectOne("SELECT max(member_id) as member_id FROM `dt_pasien` ORDER BY member_id ASC;");
                        $member_id = empty($member_id->member_id) ? '5001' : $member_id->member_id + 1;

                        DB::table('dt_pasien')->insert([
                            'member_id' => $row['C'] == '' ? $member_id : $row['C'],
                            'nama_pasien' => $row['D'],
                            'alamat' => $row['E'],
                            'tgl_lahir' => $row['F'],
                            'no_hp' => $row['G'],
                            'tgl' => date('Y-m-d'),
                        ]);
                        $numrow++;
                    }
                }
            }
            return redirect()->route('data_pasien')->with('sukses', 'Berhasil Import Data');
        } else {
            return redirect()->route('data_pasien')->with('error', 'File tidak didukung');
        }
    }

    // data paket
    public function exportFormatPaket(Request $r)
    {
        $spreadsheet = new Spreadsheet();

        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(0);
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Format Saldo Paket');

        $sheet->getStyle("A2:C2")->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('f2d06b');


        $sheet
            ->setCellValue('A1', 'Member ID')
            ->setCellValue('A2', 'isikan member id anak')
            ->setCellValue('A3', 'isikan data di baris ini ...')

            ->setCellValue('B1', 'Nama Therapist')
            ->setCellValue('B2', 'Kolom ini diisi dengan nama therapist yang sesuai dengan data')

            ->setCellValue('C1', 'Saldo Akhir')
            ->setCellValue('C2', 'Kolom ini diisi dengan angka bulat contoh: 10');


        $style = [
            'font' => array(
                'size' => 10,
                'name' => 'Comic Sans MS'
            ),
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ),
        ];

        $anak = DB::table('dt_pasien')->where('nonaktif', 'T')->get();
        $therapy = DB::select("SELECT a.nama_therapy, b.nama_paket FROM `dt_therapy` as a
        LEFT JOIN dt_paket as b ON a.id_paket = b.id_paket;");

        $sheet
            ->setCellValue('F1', 'Member ID')
            ->setCellValue('G1', 'Nama Anak');
        $sheet
            ->setCellValue('I1', 'No')
            ->setCellValue('J1', 'Nama Therapist')
            ->setCellValue('K1', 'Nama Therapist');

        $kolnak = 2;
        foreach ($anak as $d) {
            $sheet->setCellValue("F$kolnak", $d->member_id);
            $sheet->setCellValue("G$kolnak", $d->nama_pasien);

            $kolnak++;
        }

        $kolnak = 2;
        foreach ($therapy as $no => $d) {
            $sheet->setCellValue("I$kolnak", $no + 1);
            $sheet->setCellValue("J$kolnak", $d->nama_therapy);
            $sheet->setCellValue("K$kolnak", $d->nama_paket);

            $kolnak++;
        }
        $batas = count($anak) + 1;
        $batas2 = count($therapy) + 1;

        $sheet->getStyle("F1:G" . $batas)->applyFromArray($style);
        $sheet->getStyle("I1:K" . $batas2)->applyFromArray($style);
        $sheet->getStyle("A1:C3")->applyFromArray($style);


        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Format Saldo Paket.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function importSaldoPaket(Request $r)
    {
        $file = $r->file('file');
        $fileDiterima = ['xls', 'xlsx'];
        $cek = in_array($file->getClientOriginalExtension(), $fileDiterima);
        if ($cek) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx;
            $spreadsheet = $reader->load($file);
            $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            $id = [];
            for ($i = 3; $i < count($sheet); $i++) {
                $A = $sheet[$i]['A'];
                $B = $sheet[$i]['B'];
                $C = $sheet[$i]['C'];
                if (!empty($A) && !empty($B) && !empty($C)) {

                    $invoice = DB::selectOne("SELECT max(a.urutan) as urutan FROM invoice_therapy as a");
                    $no_order = empty($invoice->urutan) ? 1001 : $invoice->urutan + 1;

                    $getPasien = DB::table('dt_pasien')->where('member_id', $A)->first();
                    $getTerapi = DB::table('dt_therapy as a')
                        ->join('dt_paket as b', 'a.id_paket', 'b.id_paket')
                        ->where('a.nama_therapy', $B)
                        ->first();
                    DB::table('saldo_therapy')->insert([
                        'no_order' => 'HK-' . $no_order,
                        'id_paket' => $getTerapi->id_paket,
                        'debit' => $C,
                        'id_therapist' => $getTerapi->id_therapy,
                        'kredit' => 0,
                        'total_rp' => $getTerapi->harga * $C,
                        'member_id' => $getPasien->id_pasien,
                        'tgl' => date('Y-m-d'),
                        'admin' => 'import',
                    ]);

                    DB::table('invoice_therapy')->insert([
                        'no_order' => 'HK-' . $no_order,
                        'urutan' => $no_order,
                        'pembayaran' => 'CASH',
                        'rupiah' => 0,
                        'member_id' => $getPasien->id_pasien,
                        'tgl' => date('Y-m-d'),
                        'admin' => 'import',
                    ]);
                }
                break;
            }

            return redirect()->route('dt_paket_pasien')->with('sukses', 'Berhasil Import Data');
        } else {
            return redirect()->route('dt_paket_pasien')->with('error', 'File tidak didukung');
        }
    }

    // yang asli
    // public function importDataPasien(Request $r)
    // {
    //     $file = $r->file('file');
    //     $fileDiterima = ['xls', 'xlsx'];
    //     $cek = in_array($file->getClientOriginalExtension(), $fileDiterima);
    //     if ($cek) {
    //         $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx;
    //         $spreadsheet = $reader->load($file);
    //         $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    //         $data = [];

    //         $numrow = 1;

    //         foreach ($sheet as $row) {
    //             if ($row['B'] == '' && $row['C'] == '') {
    //                 continue;
    //             }
    //             if ($numrow > 1) {
    //                 if ($row['B'] == '') {
    //                     DB::table('dt_pasien')->insert([
    //                         'member_id' => $row['C'],
    //                         'nama_pasien' => $row['D'],
    //                         'alamat' => $row['E'],
    //                         'tgl_lahir' => $row['F'],
    //                         'no_hp' => $row['G'],
    //                         'tgl' => date('Y-m-d'),
    //                     ]);
    //                 } else {
    //                     DB::table('dt_pasien')->where('id_pasien', $row['B'])->update([
    //                         'member_id' => $row['C'],
    //                         'nama_pasien' => $row['D'],
    //                         'alamat' => $row['E'],
    //                         'tgl_lahir' => $row['F'],
    //                         'no_hp' => $row['G'],
    //                         'tgl' => date('Y-m-d'),
    //                     ]);
    //                 }
    //             }
    //             $numrow++;
    //         }
    //         return redirect()->route('data_pasien')->with('sukses', 'Berhasil Import Data');
    //     } else {
    //         return redirect()->route('data_pasien')->with('error', 'File tidak didukung');
    //     }
    // }




}
