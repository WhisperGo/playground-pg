<?php

namespace App\Controllers;
use App\Models\M_permainan;

class Permainan extends BaseController
{
    public function index()
    {
     if(session()->get('level')== 1) {
        $model=new M_permainan();
        $data['jojo']=$model->tampil('permainan');

        $data['title']='Data Permainan';
        $data['desc']='Anda dapat melihat Data Permainan di Menu ini.';

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu', $data);
        echo view('hopeui/permainan/view', $data);  
        echo view('hopeui/partial/footer');
    }else {
        return redirect()->to('/');
    }
}

public function create()
{
    if(session()->get('level')== 1) {
        $model=new M_permainan();

        $data['title']='Data Permainan';
        $data['desc']='Anda dapat tambah Data Permainan di Menu ini.'; 
        $data['subtitle'] = 'Tambah Data Permainan';

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu');
        echo view('hopeui/permainan/create', $data);
        echo view('hopeui/partial/footer');
    }else {
        return redirect()->to('/');
    }
}

public function aksi_create()
{ 
    if(session()->get('level')== 1) {
        $a= $this->request->getPost('nama_permainan');
        $b= $this->request->getPost('harga_permainan');

        //Yang ditambah ke user
        $data1=array(
            'nama_permainan'=>$a,
            'harga_permainan'=>$b
        );

        $model=new M_permainan();
        $model->simpan('permainan', $data1);

        return redirect()->to('permainan');
    }else {
        return redirect()->to('/');
    }
}
public function edit($id)
{ 
    if(session()->get('level')== 1) {
        $model=new M_permainan();
        $where=array('id_permainan'=>$id);
        $data['jojo']=$model->getWhere('permainan',$where);
        
        $data['title'] = 'Data Permainan';
        $data['desc'] = 'Anda dapat mengedit Data Permainan di Menu ini.';      
        $data['subtitle'] = 'Edit Data Permainan';  

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu');
        echo view('hopeui/permainan/edit', $data);
        echo view('hopeui/partial/footer');
    }else {
        return redirect()->to('/');
    }
}

public function aksi_edit()
{ 
    if(session()->get('level')== 1) {
       $a= $this->request->getPost('nama_permainan');
       $b= $this->request->getPost('harga_permainan');
       $id= $this->request->getPost('id');

       //Yang ditambah ke user
       $where=array('id_permainan'=>$id);
       $data1=array(
        'nama_permainan'=>$a,
        'harga_permainan'=>$b,
        'updated_at'=>date('Y-m-d H:i:s')
    );
       $model=new M_permainan();
       $model->qedit('permainan', $data1, $where);
       return redirect()->to('permainan');

   }else {
    return redirect()->to('/');
}
}

public function delete($id)
{ 
   if(session()->get('level')== 1) {
    $model=new M_permainan();
    $model->deletee($id);
    return redirect()->to('permainan');
}else {
    return redirect()->to('/');
}

}

}