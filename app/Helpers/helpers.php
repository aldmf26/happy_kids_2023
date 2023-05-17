<?php

use Illuminate\Support\Facades\DB;
if (!function_exists('tanggal')) {
    function tanggal($tgl)
    {
        $date = explode("-", $tgl);

        $bln  = $date[1];

        switch ($bln) {
            case '01':
                $bulan = "Januari";
                break;
            case '02':
                $bulan = "Februari";
                break;
            case '03':
                $bulan = "Maret";
                break;
            case '04':
                $bulan = "April";
                break;
            case '05':
                $bulan = "Mei";
                break;
            case '06':
                $bulan = "Juni";
                break;
            case '07':
                $bulan = "Juli";
                break;
            case '08':
                $bulan = "Agustus";
                break;
            case '09':
                $bulan = "September";
                break;
            case '10':
                $bulan = "Oktober";
                break;
            case '11':
                $bulan = "November";
                break;
            case '12':
                $bulan = "Desember";
                break;
        }
        $tanggal = $date[2];
        $tahun   = $date[0];

        $strTanggal = "$tanggal $bulan $tahun";
        return $strTanggal;
    }
}

if (! function_exists('greet')) {
    function getColumnName($columnIndex) {
        $columnName = '';
    
        while ($columnIndex > 0) {
            $modulo = ($columnIndex - 1) % 26;
            $columnName = chr(65 + $modulo) . $columnName;
            $columnIndex = (int)(($columnIndex - $modulo) / 26);
        }
    
        return $columnName;
    }
}

if (!function_exists('kode')) {
    function kode($kode)
    {
        return str_pad($kode, 5, '0', STR_PAD_LEFT);
    }
}

class Nonaktif {
    public static function edit($tbl, $kolom, $kolomValue, $data)
    {
        DB::table($tbl)->where($kolom, $kolomValue)->update([
            'nonaktif' => 'Y'
        ]);

        DB::table($tbl)->insert($data);
    }

}
