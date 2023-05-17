<?php

use App\Http\Controllers\AppDokterController;
use App\Http\Controllers\Data_dokter;
use App\Http\Controllers\Data_paket;
use App\Http\Controllers\Data_paket_pasien;
use App\Http\Controllers\Data_pasien;
use App\Http\Controllers\DataDokterController;
use App\Http\Controllers\DataPasienController;
use App\Http\Controllers\Dt_therapy;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ExportServerController;
use App\Http\Controllers\ExportTherapist;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\Hasil_pemeriksaan;
use App\Http\Controllers\HistoryTherapistController;
use App\Http\Controllers\ImportServerController;
use App\Http\Controllers\inv_registrasi;
use App\Http\Controllers\Invoice;
use App\Http\Controllers\Invoice_kunjungan;
use App\Http\Controllers\Invoice_periksa;
use App\Http\Controllers\Invoice_tp;
use App\Http\Controllers\JenisInvController;
use App\Http\Controllers\Komtherapist;
use App\Http\Controllers\NominalController;
use App\Http\Controllers\Pertanyaan;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoidController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->name('signin');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $data = [
            'title' => 'Dashboard'
        ];
        return view('dashboard.dashboard', $data);
    })->name('dashboard');

    // app dokter
    Route::get('app_dokter', [AppDokterController::class, 'index'])->name('app_dokter');
    Route::get('tambah_terapi', [AppDokterController::class, 'tambah_terapi'])->name('tambah_terapi');
    Route::post('save_dokter_app', [AppDokterController::class, 'save_dokter_app'])->name('save_dokter_app');
    Route::post('hapus_dokter_app', [AppDokterController::class, 'hapus_dokter_app'])->name('hapus_dokter_app');
    Route::get('kelola_appoinment', [AppDokterController::class, 'kelola_appoinment'])->name('kelola_appoinment');
    Route::post('edit_jam_appoinment', [AppDokterController::class, 'edit_jam_appoinment'])->name('edit_jam_appoinment');
    Route::get('cancel_appoinment', [AppDokterController::class, 'cancel_appoinment'])->name('cancel_appoinment');
    Route::get('selesai_appoinment', [AppDokterController::class, 'selesai_appoinment'])->name('selesai_appoinment');
    Route::get('cancel_selesai_appoinment', [AppDokterController::class, 'cancel_selesai_appoinment'])->name('cancel_selesai_appoinment');
    Route::get('print_appoinment', [AppDokterController::class, 'print_appoinment'])->name('print_appoinment');

    // user
    Route::get('tb_user', [UserController::class, 'index'])->name('tb_user');
    Route::post('save_user', [UserController::class, 'save_user'])->name('save_user');
    Route::get('permission', [UserController::class, 'permission'])->name('permission');
    Route::post('save_permission', [UserController::class, 'save_permission'])->name('save_permission');
    Route::get('delete_user/{id}', [UserController::class, 'delete_user'])->name('delete_user');
    Route::get('verifikasi/{val}/{id}', [UserController::class, 'verifikasi'])->name('verifikasi');

    Route::post('save_theme', function (Request $r) {
        DB::table('cms_content')->where('id', 1)->update(['isi' => $r->warna1]);
        DB::table('cms_content')->where('id', 2)->update(['isi' => $r->warna2]);
        DB::table('cms_content')->where('id', 3)->update(['isi' => $r->warna3]);
        DB::table('cms_content')->where('id', 4)->update(['isi' => $r->warna4]);

        return redirect()->back();
    })->name('save_theme');

    Route::get('cms', function () {
        return redirect('http://127.0.0.1:2222/dashboard');
    })->name('cms');

    Route::get('data_dokter', [DataDokterController::class, 'index'])->name('data_dokter');

    // data pasien
    Route::get('data_pasien', [DataPasienController::class, 'index'])->name('data_pasien');
    Route::get('load_view_pasien', [DataPasienController::class, 'load_view_pasien'])->name('load_view_pasien');
    Route::get('load_view_member', [DataPasienController::class, 'load_view_member'])->name('load_view_member');

    // pertanyaan
    Route::get('prtnyaan', [PertanyaanController::class, 'index'])->name('prtnyaan');
    Route::get('pertanyaan/{kelompok}', [PertanyaanController::class, 'pertanyaan'])->name('pertanyaan');
    Route::get('kspp', [PertanyaanController::class, 'kspp'])->name('kspp');
    Route::get('peds', [PertanyaanController::class, 'peds'])->name('peds');
    Route::get('mchat', [PertanyaanController::class, 'mchat'])->name('mchat');
    Route::post('add_pertanyaan', [PertanyaanController::class, 'add_pertanyaan'])->name('add_pertanyaan');
    Route::post('edit_pertanyaan', [PertanyaanController::class, 'edit_pertanyaan'])->name('edit_pertanyaan');
    Route::get('del_pertanyaan/{id}/{kelompok}', [PertanyaanController::class, 'del_pertanyaan'])->name('del_pertanyaan');
    Route::get('get_gerak', [PertanyaanController::class, 'get_gerak'])->name('get_gerak');
    Route::get('get_kpsp', [PertanyaanController::class, 'get_kpsp'])->name('get_kpsp');

    // foto
    Route::get('foto', [FotoController::class, 'index'])->name('foto');
    Route::post('add_foto', [FotoController::class, 'add_foto'])->name('add_foto');

    // Hasil Pemeriksaan
    Route::get('h_pemeriksaaan', [Hasil_pemeriksaan::class, 'index'])->name('h_pemeriksaaan');
    Route::get('cetak', [Hasil_pemeriksaan::class, 'cetak'])->name('cetak');

    // Pertanyaan 
    Route::get('kpertanyaan', [Pertanyaan::class, 'index'])->name('kpertanyaan');

    Route::get('form1', [Pertanyaan::class, 'form1'])->name('form1');
    Route::get('form2', [Pertanyaan::class, 'form2'])->name('form2');
    Route::get('form3', [Pertanyaan::class, 'form3'])->name('form3');
    Route::get('form4', [Pertanyaan::class, 'form4'])->name('form4');

    Route::get('/tbh_pertanyaan1', [Pertanyaan::class, 'tbh_pertanyaan1'])->name('tbh_pertanyaan1');
    Route::get('/tbh_pertanyaan2', [Pertanyaan::class, 'tbh_pertanyaan2'])->name('tbh_pertanyaan2');
    Route::get('/tbh_pertanyaan3', [Pertanyaan::class, 'tbh_pertanyaan3'])->name('tbh_pertanyaan3');
    Route::get('/tbh_pertanyaan4', [Pertanyaan::class, 'tbh_pertanyaan4'])->name('tbh_pertanyaan4');

    // dokter
    Route::get('tb_dokter', [Data_dokter::class, 'index'])->name('tb_dokter');
    Route::post('tbh_dokter', [Data_dokter::class, 'tbh_dokter'])->name('tbh_dokter');
    Route::post('edit_dokter', [Data_dokter::class, 'edit_dokter'])->name('edit_dokter');
    Route::get('hps_dokter', [Data_dokter::class, 'hps_dokter'])->name('hps_dokter');

    // Invoice
    Route::get('invoice', [Invoice::class, 'index'])->name('invoice');
    Route::post('edit_invoice', [Invoice::class, 'edit_invoice'])->name('edit_invoice');
    Route::get('cetak_invoice', [Invoice::class, 'cetak_invoice'])->name('cetak_invoice');
    Route::post('save_invoice', [Invoice::class, 'save_invoice'])->name('save_invoice');
    Route::post('save_status', [Invoice::class, 'save_status'])->name('save_status');
    Route::get('hapus_invoice', [Invoice::class, 'hapus_invoice'])->name('hapus_invoice');
    Route::get('noMedis', [Invoice::class, 'noMedis'])->name('noMedis');
    Route::get('loadTambahPasien', [Invoice::class, 'loadTambahPasien'])->name('loadTambahPasien');

    // data pasien
    Route::get('data_pasien', [Data_pasien::class, 'index'])->name('data_pasien');
    Route::get('get_pasien', [Data_pasien::class, 'get_pasien'])->name('get_pasien');
    Route::post('save_pasien', [Data_pasien::class, 'save_pasien'])->name('save_pasien');
    Route::get('delete_pasien', [Data_pasien::class, 'delete_pasien'])->name('delete_pasien');
    Route::get('get_edit_pasien', [Data_pasien::class, 'get_edit_pasien'])->name('get_edit_pasien');
    Route::get('detail_pasien', [Data_pasien::class, 'detail_pasien'])->name('detail_pasien');
    Route::post('edit_pasien', [Data_pasien::class, 'edit_pasien'])->name('edit_pasien');

    Route::get('inv_periksa', [Invoice_periksa::class, 'index'])->name('inv_periksa');
    Route::get('editInput', [Invoice_periksa::class, 'editInput'])->name('editInput');
    Route::post('save_invoice_periksa', [Invoice_periksa::class, 'save_invoice_periksa'])->name('save_invoice_periksa');
    Route::post('edit_invoice_periksa', [Invoice_periksa::class, 'edit_invoice_periksa'])->name('edit_invoice_periksa');
    Route::get('hapus_invoice_periksa', [Invoice_periksa::class, 'hapus_invoice_periksa'])->name('hapus_invoice_periksa');
    Route::get('cetak_inv_periksa', [Invoice_periksa::class, 'cetak_inv_periksa'])->name('cetak_inv_periksa');

    Route::get('dt_paket', [Data_paket::class, 'index'])->name('dt_paket');
    Route::post('save_paket', [Data_paket::class, 'save_paket'])->name('save_paket');
    Route::get('get_edit_paket', [Data_paket::class, 'get_edit_paket'])->name('get_edit_paket');
    Route::post('edit_paket', [Data_paket::class, 'edit_paket'])->name('edit_paket');
    Route::get('delete_paket', [Data_paket::class, 'delete_paket'])->name('delete_paket');

    Route::get('jenis_inv', [JenisInvController::class, 'index'])->name('jenis_inv');
    Route::post('tbh_jenis_inv', [JenisInvController::class, 'tbh_jenis_inv'])->name('tbh_jenis_inv');
    Route::get('hps_jenis_inv', [JenisInvController::class, 'hps_jenis_inv'])->name('hps_jenis_inv');
    Route::post('edit_jenis_inv', [JenisInvController::class, 'edit_jenis_inv'])->name('edit_jenis_inv');

    Route::get('invoice_tp', [Invoice_tp::class, 'index'])->name('invoice_tp');
    Route::get('tambah_paket', [Invoice_tp::class, 'tambah_paket'])->name('tambah_paket');
    Route::get('get_paket', [Invoice_tp::class, 'get_paket'])->name('get_paket');
    Route::get('loadTerapis', [Invoice_tp::class, 'loadTerapis'])->name('loadTerapis');
    Route::post('save_tp', [Invoice_tp::class, 'save_tp'])->name('save_tp');
    Route::get('view_paket', [Invoice_tp::class, 'view_paket'])->name('view_paket');
    Route::get('view_paket2', [Invoice_tp::class, 'view_paket2'])->name('view_paket2');
    Route::get('cetak_invoice_tp', [Invoice_tp::class, 'cetak_invoice_tp'])->name('cetak_invoice_tp');
    Route::get('hapus_invoice_tp', [Invoice_tp::class, 'hapus_invoice_tp'])->name('hapus_invoice_tp');
    Route::get('nominal_invoice_registrasi', [Invoice_tp::class, 'nominal_invoice_registrasi'])->name('nominal_invoice_registrasi');

    Route::get('invoice_kunjungan', [Invoice_kunjungan::class, 'index'])->name('invoice_kunjungan');
    Route::get('get_paket_kunjungan', [Invoice_kunjungan::class, 'get_paket'])->name('get_paket_kunjungan');
    Route::get('data_paket_kunjungan', [Invoice_kunjungan::class, 'data_paket_kunjungan'])->name('data_paket_kunjungan');
    Route::post('save_invoice_kunjungan', [Invoice_kunjungan::class, 'save_invoice_kunjungan'])->name('save_invoice_kunjungan');
    Route::get('hapus_invoice_kunjungan', [Invoice_kunjungan::class, 'hapus_invoice_kunjungan'])->name('hapus_invoice_kunjungan');
    Route::get('detailSaldo', [Invoice_kunjungan::class, 'detailSaldo'])->name('detailSaldo');
    Route::get('export_cronjob', [Invoice_kunjungan::class, 'export_cronjob'])->name('export_cronjob');
    

    Route::get('tb_therapy', [Dt_therapy::class, 'index'])->name('tb_therapy');
    Route::post('tbh_therapy', [Dt_therapy::class, 'tbh_therapy'])->name('tbh_therapy');
    Route::post('edit_terapi', [Dt_therapy::class, 'edit_terapi'])->name('edit_terapi');
    Route::get('hps_terapi', [Dt_therapy::class, 'hps_terapi'])->name('hps_terapi');

    Route::get('dt_paket_pasien', [Data_paket_pasien::class, 'index'])->name('dt_paket_pasien');
    Route::get('view_paket_pasien', [Data_paket_pasien::class, 'view_paket_pasien'])->name('view_paket_pasien');
    Route::get('view_paket_pasien2', [Data_paket_pasien::class, 'view_paket_pasien2'])->name('view_paket_pasien2');
    Route::get('viewEditTerapi', [Data_paket_pasien::class, 'viewEditTerapi'])->name('viewEditTerapi');
    Route::get('editPaketTerapi', [Data_paket_pasien::class, 'editPaketTerapi'])->name('editPaketTerapi');
    Route::post('save_saldo_pasien', [Data_paket_pasien::class, 'save_saldo_pasien'])->name('save_saldo_pasien');
    Route::get('tambah_paket_saldo', [Data_paket_pasien::class, 'tambah_paket_saldo'])->name('tambah_paket_saldo');
    Route::post('penutup', [Data_paket_pasien::class, 'penutup'])->name('penutup');

    Route::get('void', [VoidController::class, 'index'])->name('void');
    Route::get('loadScreening', [VoidController::class, 'loadScreening'])->name('loadScreening');
    Route::get('loadPeriksa', [VoidController::class, 'loadPeriksa'])->name('loadPeriksa');
    Route::get('loadTerapi', [VoidController::class, 'loadTerapi'])->name('loadTerapi');
    Route::get('loadKunjungan', [VoidController::class, 'loadKunjungan'])->name('loadKunjungan');

    // export dan import data
    Route::post('exportScreening', [ExportController::class, 'exportScreening'])->name('exportScreening');
    Route::get('exportTherapist/{tgl1}/{tgl2}', [ExportTherapist::class, 'index'])->name('exportTherapist');
    Route::get('exportDataPasien', [ExportController::class, 'exportPasien'])->name('exportDataPasien');
    Route::get('exportPaket', [ExportController::class, 'exportPaket'])->name('exportPaket');
    Route::post('importDataPasien', [ExportController::class, 'importDataPasien'])->name('importDataPasien');
    Route::post('importPaketPasien', [ExportController::class, 'importPaketPasien'])->name('importPaketPasien');
    Route::post('importSaldoPaket', [ExportController::class, 'importSaldoPaket'])->name('importSaldoPaket');
    Route::get('exportFormatPasien', [ExportController::class, 'exportFormatPasien'])->name('exportFormatPasien');
    Route::get('exportFormatPaket', [ExportController::class, 'exportFormatPaket'])->name('exportFormatPaket');

    Route::get('inv_registrasi', [inv_registrasi::class, 'index'])->name('inv_registrasi');
    Route::post('save_registrasi', [inv_registrasi::class, 'save_registrasi'])->name('save_registrasi');
    Route::get('cetak_registrasi', [inv_registrasi::class, 'cetak_registrasi'])->name('cetak_registrasi');

    // nominal
    Route::get('nominal', [NominalController::class, 'index'])->name('nominal');
    Route::get('data_nominal/{tipe}', [NominalController::class, 'data_nominal'])->name('data_nominal');
    Route::post('tambah_nominal/{tipe}', [NominalController::class, 'tambah_nominal'])->name('tambah_nominal');
    Route::post('edit_nominal', [NominalController::class, 'edit_nominal'])->name('edit_nominal');
    Route::get('hapus_nominal/{id}/{tipe}', [NominalController::class, 'hapus_nominal'])->name('hapus_nominal');

    // export data
    Route::post('exportScreening', [ExportController::class, 'exportScreening'])->name('exportScreening');
    Route::post('exportTherapist', [ExportTherapist::class, 'index'])->name('exportTherapist');

    // export server
    Route::get('exportServer', [ExportServerController::class, 'index'])->name('exportServer');
    Route::get('exportPasien', [ExportServerController::class, 'exportPasien'])->name('exportPasien');
    Route::get('exportInv', [ExportServerController::class, 'exportInv'])->name('exportInv');

    // import server
    Route::get('importServer', [ImportServerController::class, 'index'])->name('importServer');
    Route::get('importUser', [ImportServerController::class, 'importUser'])->name('importUser');
    Route::get('importDokter', [ImportServerController::class, 'importDokter'])->name('importDokter');
    Route::get('importPasien', [ImportServerController::class, 'importPasien'])->name('importPasien');
    Route::get('importPaket', [ImportServerController::class, 'importPaket'])->name('importPaket');
    Route::get('importNominal', [ImportServerController::class, 'importNominal'])->name('importNominal');

    // history therapist
    Route::get('historyTherapist', [HistoryTherapistController::class, 'index'])->name('historyTherapist');
    Route::get('komTherapist', [Komtherapist::class, 'index'])->name('komTherapist');
    Route::get('historyDetail', [HistoryTherapistController::class, 'historyDetail'])->name('historyDetail');
    
    Route::get('/+menu', [UserController::class, 'tambahMenu'])->name('plusMenu');
    Route::get('/delMenu', [UserController::class, 'delMenu'])->name('delMenu');

});
Route::get('download_cronjob', [Invoice_kunjungan::class, 'download_cronjob'])->name('download_cronjob');
Route::get('export_cronjob', [Invoice_kunjungan::class, 'export_cronjob'])->name('export_cronjob');

require __DIR__ . '/auth.php';
