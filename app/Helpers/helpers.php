<?php

use Illuminate\Support\Facades\DB;

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
