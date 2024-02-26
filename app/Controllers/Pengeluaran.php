<?php

namespace App\Controllers;
use App\Models\M_pengeluaran;

class Pengeluaran extends BaseController
{
    public function index()
    {
       if(session()->get('level')== 1) {
        $model=new M_pengeluaran();
        $data['jojo']=$model->tampil('pengeluaran');

        $data['title']='Data Pengeluaran';
        $data['desc']='Anda dapat melihat Data Pengeluaran di Menu ini.';

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu', $data);
        echo view('hopeui/pengeluaran/view', $data);
        echo view('hopeui/partial/footer');
    }else {
        return redirect()->to('/');
    }
}

public function create()
{
    if(session()->get('level')== 1) {
        $model=new M_pengeluaran();

        $data['title']='Data Pengeluaran';
        $data['desc']='Anda dapat tambah Data Pengeluaran di Menu ini.'; 
        $data['subtitle'] = 'Tambah Data Pengeluaran';

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu');
        echo view('hopeui/pengeluaran/create', $data);
        echo view('hopeui/partial/footer');
    }else {
        return redirect()->to('/');
    }
}

public function aksi_create()
{ 
    if(session()->get('level')== 1) {
        $a= $this->request->getPost('nama_pengeluaran');
        $b= $this->request->getPost('jumlah_pengeluaran');

        //Yang ditambah ke user
        $data1=array(
            'nama_pengeluaran'=>$a,
            'jumlah_pengeluaran'=>$b
        );

        $model=new M_pengeluaran();
        $model->simpan('pengeluaran', $data1);

        return redirect()->to('pengeluaran');
    }else {
        return redirect()->to('/');
    }
}
public function edit($id)
{ 
    if(session()->get('level')== 1) {
        $model=new M_pengeluaran();
        $where=array('id_pengeluaran'=>$id);
        $data['jojo']=$model->getWhere('pengeluaran',$where);
        
        $data['title'] = 'Data Pengeluaran';
        $data['desc'] = 'Anda dapat mengedit Data Pengeluaran di Menu ini.';      
        $data['subtitle'] = 'Edit Data Pengeluaran';  

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu');
        echo view('hopeui/pengeluaran/edit', $data);
        echo view('hopeui/partial/footer');
    }else {
        return redirect()->to('/');
    }
}

public function aksi_edit()
{ 
    if(session()->get('level')== 1) {
     $a= $this->request->getPost('nama_pengeluaran');
     $b= $this->request->getPost('jumlah_pengeluaran');
     $id= $this->request->getPost('id');

       //Yang ditambah ke user
     $data1=array(
        'nama_pengeluaran'=>$a,
        'jumlah_pengeluaran'=>$b,
        'updated_at'=>date('Y-m-d H:i:s')
    );

     $model=new M_pengeluaran();
     $where=array('id_pengeluaran'=>$id);
     $model->qedit('pengeluaran', $data1, $where);
     return redirect()->to('pengeluaran');

 }else {
    return redirect()->to('/');
}
}

public function delete($id)
{ 
 if(session()->get('level')== 1) {
    $model=new M_pengeluaran();
    $model->deletee($id);
    return redirect()->to('pengeluaran');
}else {
    return redirect()->to('/');
}

}

}