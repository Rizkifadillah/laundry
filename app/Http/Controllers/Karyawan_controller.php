<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class Karyawan_controller extends Controller
{
    public function index(){
        $title = 'Karyawan';
        $data = User::whereNull('role')->get();

        return view('karyawan.index',compact('title','data'));
    }

    public function add(){
        $title = 'Menu Tambah Karyawan';
        return view('karyawan.add',compact('title'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt('12345678');
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        \Session::flash('sukses','Data berhasil diitambahkan');

        User::insert($data);

        return redirect('karyawan');
    }

    public function edit($id){
        $dt = User::find($id);
        $title = 'Edit Data Karyawan';

        return view('karyawan.edit',compact('title','dt'));
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        \Session::flash('sukses','Data berhasil di Update');

        User::where('id',$id)->update($data);

        return redirect('karyawan');
    }

    public function delete($id){
        try {
            User::where('id',$id)->delete();
        
            \Session::flash('sukses','Data berhasil di hapus');
    
        } catch(\Exception $e){
            \Session::flash('gagal', $e->getMessage());
        }
        return redirect('karyawan');
    }
}
