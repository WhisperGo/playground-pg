<?php

namespace App\Controllers;
use App\Models\M_paket_permainan;

class Paket_permainan extends BaseController
{
    public function index()
    {
       if(session()->get('level')== 1) {
        $model=new M_paket_permainan();
        $data['jojo']=$model->tampil('paket_permainan');

        $data['title']='Paket Permainan';
        $data['desc']='Anda dapat melihat Paket Permainan di Menu ini.';

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu', $data);
        echo view('hopeui/paket_permainan/view', $data);
        echo view('hopeui/partial/footer');
    }else {
        return redirect()->to('/');
    }
}

public function create()
{
    if(session()->get('level')== 1) {
        $model=new M_paket_permainan();

        $data['title']='Paket Permainan';
        $data['desc']='Anda dapat tambah Paket Permainan di Menu ini.'; 
        $data['subtitle'] = 'Tambah Paket Permainan';

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu');
        echo view('hopeui/paket_permainan/create', $data);
        echo view('hopeui/partial/footer');
    }else {
        return redirect()->to('/');
    }
}

public function aksi_create()
{ 
    if(session()->get('level')== 1) {
        $a= $this->request->getPost('nama_paket');
        $b= $this->request->getPost('durasi_paket');

        //Yang ditambah ke user
        $data1=array(
            'nama_paket'=>$a,
            'durasi_paket'=>$b,
        );

        $model=new M_paket_permainan();
        $model->simpan('paket_permainan', $data1);

        return redirect()->to('paket_permainan');
    }else {
        return redirect()->to('/');
    }
}
public function edit($id)
{ 
    if(session()->get('level')== 1) {
        $model=new M_paket_permainan();
        $where=array('id_paket'=>$id);
        $data['jojo']=$model->getWhere('paket_permainan',$where);
        
        $data['title'] = 'Paket Permainan';
        $data['desc'] = 'Anda dapat mengedit Paket Permainan di Menu ini.';      
        $data['subtitle'] = 'Edit Paket Permainan';  

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu');
        echo view('hopeui/paket_permainan/edit', $data);
        echo view('hopeui/partial/footer');
    }else {
        return redirect()->to('/');
    }
}

public function aksi_edit()
{ 
    if(session()->get('level')== 1) {
     $a= $this->request->getPost('nama_paket');
     $b= $this->request->getPost('durasi_paket');
     $id= $this->request->getPost('id');

       //Yang ditambah ke user
     $data1=array(
        'nama_paket'=>$a,
        'durasi_paket'=>$b,
        'updated_at'=>date('Y-m-d H:i:s')
    );

     $model=new M_paket_permainan();
     $where=array('id_paket'=>$id);
     $model->qedit('paket_permainan', $data1, $where);
     return redirect()->to('paket_permainan');

 }else {
    return redirect()->to('/');
}
}

public function delete($id)
{ 
 if(session()->get('level')== 1) {
    $model=new M_paket_permainan();
    $model->deletee($id);
    return redirect()->to('paket_permainan');
}else {
    return redirect()->to('/');
}

}

}