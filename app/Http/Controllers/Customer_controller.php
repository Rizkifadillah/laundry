<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Model\Customer;

class Customer_controller extends Controller
{
    public function index(){
        $title = 'Menu Customer';

        //mengurutkan berdasarkan huruf
        $data = Customer::orderBy('nama','asc')->get();
        return view('customer.index',compact('title','data'));
    }

    public function add(){
        $title = 'Menu Tambah Customer';
        return view('customer.add',compact('title'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'nama'=>'required',
            'email'=>'required',
            'no_hp'=>'required',
            'alamat'=>'required'
        ]);

        $data['id'] = \Uuid::generate(4);
        $data['nama'] = $request->nama;
        $data['email'] = $request->email;
        $data['no_hp'] = $request->no_hp;
        $data['alamat'] = $request->alamat;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        \Session::flash('sukses','Data berhasil diitambahkan');

        Customer::insert($data);

        return redirect('customer');
    }

    public function edit($id){
        $dt = Customer::find($id);
        $title = 'Edit Data Customer';

        return view('customer.edit',compact('title','dt'));
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'nama'=>'required',
            'email'=>'required',
            'no_hp'=>'required',
            'alamat'=>'required'
        ]);

        $data['nama'] = $request->nama;
        $data['email'] = $request->email;
        $data['no_hp'] = $request->no_hp;
        $data['alamat'] = $request->alamat;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        \Session::flash('sukses','Data berhasil di Update');

        Customer::where('id',$id)->update($data);

        return redirect('customer');
    }

       

    public function delete($id){
        try {
            Customer::where('id',$id)->delete();
        
            \Session::flash('sukses','Data berhasil di hapus');
    
        } catch(\Exception $e){
            \Session::flash('gagal', $e->getMessage());
        }
        return redirect('customer');
    }
}
