<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Tb User',
            'users' => User::where('nonaktif', '!=', 'Y')->get(),
            
        ];

        return view('user.user',$data);
    }

    public function save_user(Request $r)
    {

        $user = User::create([
            'name' => $r->name,
            'email' => $r->email,
            'role' => $r->role,
            'password' => Hash::make($r->password),
        ]);


        return redirect()->route('tb_user')->with('sukses', 'Berhasil tambah user');
    }

    public function delete_user($id)
    {
        User::find($id)->update(['nonaktif' => 'Y']);
        return redirect()->route('tb_user')->with('sukses', 'Berhasil hapus user');
    }

    public function logout(Request $r)
    {
        Auth::guard('web')->logout();

        $r->session()->invalidate();

        $r->session()->regenerateToken();

        return redirect('http://127.0.0.1:8000/');
    }

    public function verifikasi($val, $id)
    {

        User::find($id)->update(['verifikasi' => $val]);
        return redirect()->route('tb_user')->with('sukses', 'Berhasil verifikasi user');
    }

    public function permission(Request $r)
    {
        $id_user = $r->id;
        $data = [
            'title' => 'Data User',
            'menu' => DB::table('tb_menu')->get(),
            'id_user' => $id_user,
            'logout' => $r->session()->get('logout'),
            'void' => DB::table('tb_menu_void')->get(),
            'dashboard' => DB::table('tb_menu_dashboard')->get(),
        ];

        return view('user.permission', $data);
    }

    public function save_permission(Request $r)
    {
        $id_user = $r->kd_user;
        $permission =  $r->permission;
        $id_menu_void =  $r->id_menu_void;
        $id_menu_dashboard =  $r->id_menu_dashboard;

        DB::table('tb_permission')->where('id_user', $id_user)->delete();
        DB::table('void_permission')->where('id_user', $id_user)->delete();
        DB::table('dashboard_permission')->where('id_user', $id_user)->delete();

        if(!empty($permission)) {
            for ($i = 0; $i < count($r->permission); $i++) {
                $data_permission = [
                    'id_user' => $id_user,
                    'permission' => $permission[$i]
                ];
    
                DB::table('tb_permission')->insert($data_permission);
            }
        }
        
        if(!empty($id_menu_dashboard)) {
            for ($i = 0; $i < count($r->id_menu_dashboard); $i++) {
                $data_dashboard = [
                    'id_user' => $id_user,
                    'id_menu_dashboard' => $id_menu_dashboard[$i]
                ];
    
                DB::table('dashboard_permission')->insert($data_dashboard);
            }
        }

        if(!empty($id_menu_void)) {
            for ($i = 0; $i < count($r->id_menu_void); $i++) {
                $data_void = [
                    'id_user' => $id_user,
                    'id_menu_void' => $id_menu_void[$i]
                ];
    
                DB::table('void_permission')->insert($data_void);
            }
        }

        return redirect()->route('tb_user')->with('sukses', 'Sukses atur permssion');
    }

    public function tambahMenu()
    {
        $data = [
            
            'dashboard' => DB::table('tb_menu_dashboard')->orderBy('urutan', 'ASC')->get(),
            'void' => DB::table('tb_menu_void')->get(),
            'menu' => DB::table('tb_sub_menu')->orderBy('urutan', 'ASC')->get(),
        ];
        return view('user.menu',$data);
    }

    public function delMenu(Request $r)
    {
        if($r->jenis == 1) {
            $table = 'tb_sub_menu';
            $id = 'id_sub_menu';
        } elseif($r->jenis == 2) {
            $table = 'tb_menu_dashboard';
            $id = 'id';
        } else {
            $table = 'tb_menu_void';
            $id = 'id';
        }

        DB::table($table)->where($id, $r->id)->delete();
        // DB::table($table)->where($id, $r->id)->delete();
        return redirect()->route('plusMenu')->with('sukses', 'Sukses tambah menu');
    }
}
