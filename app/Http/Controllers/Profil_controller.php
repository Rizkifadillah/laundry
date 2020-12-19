<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Profil;

class Profil_controller extends Controller
{
    public function index(){
        $title = 'Manage Nama Usaha';
        $dt = Profil::first();

        return view('profil.index',compact('title','dt'));
    }

    public function add(){
        $title = 'Manage Nama Usaha';

        return view('profil.add',compact('title'));
    }

    public function update(Request $request,$id){
        try {
            //code...
            $this->validate($request,[
                'nama'=>'required',
    
            ]);
            
                // Profil::update($data);
                $dt = Profil::first();
                $dt = \Uuid::generate(4);
                $dt->nama = $request->nama;
                $dt->created_at = date('Y-m-d H:i:s');
                $dt->updated_at = date('Y-m-d H:i:s');
                $dt->save();  
    
            \Session::flash('sukses','Data berhasil diitambahkan');
            return redirect('status-pembayaran');
        } catch (\Throwable $th) {
            //throw $th;
            \Session::flash('gagal','Data gagal diupdate');
        }
        return redirect()->back();
    }
}
