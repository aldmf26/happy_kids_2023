<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class ImportServerController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Import',
            'menu' => DB::table('tb_menu_dashboard')->whereNotIn('id', [8,9,10])->get()
        ];
        return view('import.import',$data);
    }

    public function importUser(Request $r)
    {
        // get api dari server
        $client = new Client();

        $response = $client->request('GET', 'https://adm.klinikhappykids.com/api/users', [
            'headers' => [
                'X-API-KEY' => '@Takemor.'
            ]
        ]);
        $data = json_decode($response->getBody(), true);
        
        $dt_user = $data['users'];
        $tb_menu_dashboard = $data['tb_menu_dashboard'];
        $tb_menu_void = $data['tb_menu_void'];
        $tb_sub_menu = $data['tb_sub_menu'];
        $tb_permission = $data['tb_permission'];
        $dashboard_permission = $data['dashboard_permission'];
        $void_permission = $data['void_permission'];

        // -----------------------
        $pesan = 'error';
        if(!empty($dt_user)) {
            DB::table('users')->truncate();
            foreach ($dt_user as $v) {
                $data = [
                    'id' => $v['id'],
                    'name' => $v['name'],
                    'email' => $v['email'],
                    'password' => $v['password'],
                    'created_at' => $v['created_at'],
                    'updated_at' => $v['updated_at'],
                    'role' => $v['role'],
                    'verifikasi' => $v['verifikasi'],
                    'nonaktif' => $v['nonaktif'],
                ];
                DB::table('users')->insert($data);
            }
            $pesan = 'sukses';
        }
        
        if(!empty($tb_menu_dashboard)) {
            DB::table('tb_menu_dashboard')->truncate();
            foreach ($tb_menu_dashboard as $v) {
                $data = [
                    'id' => $v['id'],
                    'icon' => $v['icon'],
                    'teks' => $v['teks'],
                    'link' => $v['link'],
                    'urutan' => $v['urutan'],
                ];
                DB::table('tb_menu_dashboard')->insert($data);
            }
            $pesan = 'sukses';
        }

        if(!empty($tb_menu_void)) {
            DB::table('tb_menu_void')->truncate();
            foreach ($tb_menu_void as $v) {
                $data = [
                    'id' => $v['id'],
                    'icon' => $v['icon'],
                    'teks' => $v['teks'],
                    'target_id' => $v['target_id'],
                ];
                DB::table('tb_menu_void')->insert($data);
            }
            $pesan = 'sukses';
        }

        if(!empty($tb_sub_menu)) {
            DB::table('tb_sub_menu')->truncate();
            foreach ($tb_sub_menu as $v) {
                $data = [
                    'id_sub_menu' => $v['id_sub_menu'],
                    'id_menu' => $v['id_menu'],
                    'sub_menu' => $v['sub_menu'],
                    'url' => $v['url'],
                    'created_at' => $v['created_at'],
                    'updated_at' => $v['updated_at'],
                    'urutan' => $v['urutan'],
                ];
                DB::table('tb_sub_menu')->insert($data);
            }
            $pesan = 'sukses';
        }

        if(!empty($tb_permission)) {
            DB::table('tb_permission')->truncate();
            foreach ($tb_permission as $v) {
                $data = [
                    'id_user' => $v['id_user'],
                    'permission' => $v['permission'],
                    'created_at' => $v['created_at'],
                    'updated_at' => $v['updated_at'],
                ];
                DB::table('tb_permission')->insert($data);
            }
            $pesan = 'sukses';
        }

        if(!empty($dashboard_permission)) {
            DB::table('dashboard_permission')->truncate();
            foreach ($dashboard_permission as $v) {
                $data = [
                    'id_user' => $v['id_user'],
                    'id_menu_dashboard' => $v['id_menu_dashboard'],
                ];
                DB::table('dashboard_permission')->insert($data);
            }
            $pesan = 'sukses';
        }
        
        if(!empty($void_permission)) {
            DB::table('void_permission')->truncate();
            foreach ($void_permission as $v) {
                $data = [
                    'id_user' => $v['id_user'],
                    'id_menu_void' => $v['id_menu_void'],
                ];
                DB::table('void_permission')->insert($data);
            }
            $pesan = 'sukses';
        }
        return redirect()->route('importServer')->with($pesan, 'Import dari server');
    }

    public function importDokter()
    {
        // get api dari server
        $client = new Client();

        $response = $client->request('GET', 'https://adm.klinikhappykids.com/api/dokter', [
            'headers' => [
                'X-API-KEY' => '@Takemor.'
            ]
        ]);
        
        $data = json_decode($response->getBody(), true);
        $dt_user = $data['dokter'];
        $therapist = $data['therapist'];
        // -----------------------  

        $pesan = 'error';
        if(!empty($dt_user)){
            DB::table('dt_dokter')->truncate();
            DB::table('dt_therapy')->truncate();
            
            foreach ($dt_user as $v) {
                $data = [
                    'id_dokter' => $v['id_dokter'],
                    'nm_dokter' => $v['nm_dokter'],
                    'nonaktif' => $v['nonaktif'],
                ];
                DB::table('dt_dokter')->insert($data);
            }
            foreach ($therapist as $v) {
                $data = [
                    'id_therapy' => $v['id_therapy'],
                    'nama_therapy' => $v['nama_therapy'],
                    'id_paket' => $v['id_paket'],
                    'nonaktif' => $v['nonaktif'],
                ];
                DB::table('dt_therapy')->insert($data);
            }
            $pesan = 'sukses';
        }
        return redirect()->route('importServer')->with($pesan, "Import dari server");
    }

    public function importPaket()
    {
        // get api dari server
        $client = new Client();

        $response = $client->request('GET', 'https://adm.klinikhappykids.com/api/paket', [
            'headers' => [
                'X-API-KEY' => '@Takemor.'
            ]
        ]);
        
        $data = json_decode($response->getBody(), true);
        $dt_user = $data['paket'];
        // -----------------------  

        $pesan = 'error';
        if(!empty($dt_user)){
            DB::table('dt_paket')->truncate();
            
            foreach ($dt_user as $v) {
                $data = [
                    'id_paket' => $v['id_paket'],
                    'nama_paket' => $v['nama_paket'],
                    'harga' => $v['harga'],
                    'nonaktif' => $v['nonaktif'],
                ];
                DB::table('dt_paket')->insert($data);
            }

            $pesan = 'sukses';
        }
        return redirect()->route('importServer')->with($pesan, "Import dari server");
    }

    public function importNominal()
    {
        // get api dari server
        $client = new Client();

        $response = $client->request('GET', 'https://adm.klinikhappykids.com/api/nominal', [
            'headers' => [
                'X-API-KEY' => '@Takemor.'
            ]
        ]);
        $data = json_decode($response->getBody(), true);
        $dt_user = $data['nominal'];
        // -----------------------  

        $pesan = 'error';
        if(!empty($dt_user)){
            DB::table('tb_nominal')->truncate();
            
            foreach ($dt_user as $v) {
                $data = [
                    'id_nominal' => $v['id_nominal'],
                    'nominal' => $v['nominal'],
                    'jenis' => $v['jenis'],
                    'nm_jenis' => $v['nm_jenis'],
                    'nonaktif' => $v['nonaktif'],
                ];
                DB::table('tb_nominal')->insert($data);
            }

            $pesan = 'sukses';
        }
        return redirect()->route('importServer')->with($pesan, "Import dari server");
    }
}
