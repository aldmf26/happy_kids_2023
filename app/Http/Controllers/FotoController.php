<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FotoController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Foto',
            'foto' => DB::table('tb_foto')->get()
        ];

        return view('foto.foto', $data);
    }

    public function add_foto(Request $r)
    {
        $r->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$r->image->extension();
        DB::table('tb_foto')->insert(['nm_foto' => $imageName]);
     
        $r->image->move(public_path('images-upload'), $imageName);
        return redirect()->route('foto')->with('sukses', 'Berhasil upload');
    }
}
