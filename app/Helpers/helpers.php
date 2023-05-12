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

class Nonaktif {
    public static function edit($tbl, $kolom, $kolomValue, $data)
    {
        DB::table($tbl)->where($kolom, $kolomValue)->update([
            'nonaktif' => 'Y'
        ]);

        DB::table($tbl)->insert($data);
    }

}
