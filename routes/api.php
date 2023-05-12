<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;


Route::middleware(['api_key'])->group(function () {
    // GET DATA EXPORT
    
    Route::post('pasPasien', function (Request $r) {

        foreach ($r->all() as $d) {
            $data = [
                'id_pasien' => $d['id_pasien'],
                'member_id' => $d['member_id'],
                'nama_pasien' => $d['nama_pasien'],
                'alamat' => $d['alamat'],
                'tgl_lahir' => $d['tgl_lahir'],
                'no_hp' => $d['no_hp'],
                'tgl' => $d['tgl'],
                'kartu' => $d['kartu'],
                'administrasi' => $d['administrasi'],
                'no_order' => $d['no_order'],
            ];
    
            $cek = DB::table('dt_pasien')->where('id_pasien', $d['id_pasien'])->first();
            if ($cek) {
                $update = DB::table('dt_pasien')->where('id_pasien', $d['id_pasien'])->update($data);
            } else {
                $insert = DB::table('dt_pasien')->insert($data);
            }
    
            if (isset($insert) || isset($update)) {
                $message = 'Sukses';
                $status = 201;
            } else {
                $message = 'Error';
                $status = 202;
            }
        }
        return response()->json([
            'message' => $message,
            'data' => $r->all()
        ], $status ?? 201);
    });
    
    
    Route::post('invoice', function (Request $r) {
        if(
            empty($r->periksa) &&
            empty($r->registrasi) &&
            empty($r->saldo) &&
            empty($r->terapi)
        ) {
            return response()->json([
                'message' => 'DATA KOSONG',
                'data' => ''
            ], 202);
        } else {
            // periksa
            foreach ($r->periksa as $d) {
                $data = [
                    'id_invoice_periksa' => $d['id_invoice_periksa'],
                    'member_id' => $d['member_id'],
                    'tgl' => $d['tgl'],
                    'no_order' => $d['no_order'],
                    'urutan' => $d['urutan'],
                    'id_dokter' => $d['id_dokter'],
                    'pembayaran' => $d['pembayaran'],
                    'status' => $d['status'],
                    'rupiah' => $d['rupiah'],
                    'admin' => $d['admin'],
                    'jenis' => $d['jenis'],
                    'ket' => $d['ket'],
                ];
                
                $cek = DB::table('invoice_periksa')->where('id_invoice_periksa', $d['id_invoice_periksa'])->first();
                if ($cek) {
                    $update = DB::table('invoice_periksa')->where('id_invoice_periksa', $d['id_invoice_periksa'])->update($data);
                } else {
                    $insert = DB::table('invoice_periksa')->insert($data);
                }
        
                if (isset($insert) || isset($update)) {
                    $message = 'Sukses';
                    $status = 201;
                } else {
                    $message = 'Error';
                    $status = 202;
                }
            }
            
            // registrasi
            foreach ($r->registrasi as $d) {
                $data = [
                    'id_registrasi' => $d['id_registrasi'],
                    'tgl' => $d['tgl'],
                    'no_order' => $d['no_order'],
                    'urutan' => $d['urutan'],
                    'member_id' => $d['member_id'],
                    'rupiah' => $d['rupiah'],
                    'status' => $d['status'],
                    'pembayaran' => $d['pembayaran'],
                    'admin' => $d['admin'],
                    'id_paket' => $d['id_paket'],
                ];
                
                $cek = DB::table('invoice_registrasi')->where('id_registrasi', $d['id_registrasi'])->first();
                if ($cek) {
                    $update = DB::table('invoice_registrasi')->where('id_registrasi', $d['id_registrasi'])->update($data);
                } else {
                    $insert = DB::table('invoice_registrasi')->insert($data);
                }
        
                if (isset($insert) || isset($update)) {
                    $message = 'Sukses';
                    $status = 201;
                } else {
                    $message = 'Error';
                    $status = 202;
                }
            }
            
            // saldo terapi
            foreach ($r->saldo as $d) {
                $data = [
                    'id_saldo_therapy' => $d['id_saldo_therapy'],
                    'no_order' => $d['no_order'],
                    'debit' => $d['debit'],
                    'kredit' => $d['kredit'],
                    'tgl' => $d['tgl'],
                    'admin' => $d['admin'],
                    'id_paket' => $d['id_paket'],
                    'id_therapist' => $d['id_therapist'],
                    'total_rp' => $d['total_rp'],
                    'member_id' => $d['member_id'],
                ];
                
                $cek = DB::table('saldo_therapy')->where('id_saldo_therapy', $d['id_saldo_therapy'])->first();
                if ($cek) {
                    $update = DB::table('saldo_therapy')->where('id_saldo_therapy', $d['id_saldo_therapy'])->update($data);
                } else {
                    $insert = DB::table('saldo_therapy')->insert($data);
                }
        
                if (isset($insert) || isset($update)) {
                    $message = 'Sukses';
                    $status = 201;
                } else {
                    $message = 'Error';
                    $status = 202;
                }
            }
            
            // kunjungan
            foreach ($r->kunjungan as $d) {
                $data = [
                    'id_invoice_kunjungan' => $d['id_invoice_kunjungan'],
                    'tgl' => $d['tgl'],
                    'no_order' => $d['no_order'],
                    'urutan' => $d['urutan'],
                    'member_id' => $d['member_id'],
                    'admin' => $d['admin'],
                ];
                
                $cek = DB::table('invoice_kunjungan')->where('id_invoice_kunjungan', $d['id_invoice_kunjungan'])->first();
                if ($cek) {
                    $update = DB::table('invoice_kunjungan')->where('id_invoice_kunjungan', $d['id_invoice_kunjungan'])->update($data);
                } else {
                    $insert = DB::table('invoice_kunjungan')->insert($data);
                }
        
                if (isset($insert) || isset($update)) {
                    $message = 'Sukses';
                    $status = 201;
                } else {
                    $message = 'Error';
                    $status = 202;
                }
            }
            
            // terapi
            foreach ($r->terapi as $d) {
                $data = [
                    'id_invoice_therapy' => $d['id_invoice_therapy'],
                    'tgl' => $d['tgl'],
                    'no_order' => $d['no_order'],
                    'urutan' => $d['urutan'],
                    'member_id' => $d['member_id'],
                    'pembayaran' => $d['pembayaran'],
                    'rupiah' => $d['rupiah'],
                    'admin' => $d['admin'],
                ];
                
                $cek = DB::table('invoice_therapy')->where('id_invoice_therapy', $d['id_invoice_therapy'])->first();
                if ($cek) {
                    $update = DB::table('invoice_therapy')->where('id_invoice_therapy', $d['id_invoice_therapy'])->update($data);
                } else {
                    $insert = DB::table('invoice_therapy')->insert($data);
                }
        
                if (isset($insert) || isset($update)) {
                    $message = 'Sukses';
                    $status = 201;
                } else {
                    $message = 'Error';
                    $status = 202;
                }
            }
            
            return response()->json([
                'message' => $message,
                'data' => $r->all()
            ], $status);
        }
        
    });
    // ---------------------------------------------
    
    // GET DATA IMPORT
    Route::get('users', function () {
        return response()->json([
                'status' => 'success',
                'users' => DB::table('users')->get(),
                'tb_menu_dashboard' => DB::table('tb_menu_dashboard')->get(),
                'tb_menu_void' => DB::table('tb_menu_void')->get(),
                'tb_sub_menu' => DB::table('tb_sub_menu')->get(),
                'tb_permission' => DB::table('tb_permission')->get(),
                'dashboard_permission' => DB::table('dashboard_permission')->get(),
                'void_permission' => DB::table('void_permission')->get(),
            ], 200);
            
    });
    
    Route::get('pasien', function () {
        $data = [
            'pasien' => DB::table('dt_pasien')->get(),
        ];
       
        return response()->json($data, HttpFoundationResponse::HTTP_OK);
    });
    
    Route::get('dokter', function () {
        $data = [
            'dokter' => DB::table('dt_dokter')->get(),
            'therapist' => DB::table('dt_therapy')->get(),
        ];
       
        return response()->json($data, HttpFoundationResponse::HTTP_OK);
    });
    
    Route::get('paket', function () {
        $data = [
            'paket' => DB::table('dt_paket')->get(),
        ];
       
        return response()->json($data, HttpFoundationResponse::HTTP_OK);
    });
    
    Route::get('nominal', function () {
        $data = [
            'nominal' => DB::table('tb_nominal')->get(),
        ];
       
        return response()->json($data, HttpFoundationResponse::HTTP_OK);
    });
    // --------------------------------------
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json(['data' => DB::table('users')->get()]);
});
