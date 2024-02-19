<?php

namespace App\Controllers;
use App\Models\M_level;

class Data_level extends BaseController
{
    public function index()
    {
     if(session()->get('level')== 1) {
        $model=new M_level();
        $data['jojo']=$model->tampil('level');

        $data['title']='Data Level';
        $data['desc']='Anda dapat melihat Data User di Menu ini.';

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu', $data);
        echo view('hopeui/level/view', $data);
        echo view('hopeui/partial/footer');
    }else {
        return redirect()->to('/');
    }
}

public function create()
{
    if(session()->get('level')== 1) {
        $model=new M_level();

        $data['title']='Data Level';
        $data['desc']='Anda dapat tambah Data Level di Menu ini.'; 
        $data['subtitle'] = 'Tambah Data Level';

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu');
        echo view('hopeui/level/create', $data);
        echo view('hopeui/partial/footer');
    }else {
        return redirect()->to('/');
    }
}

public function aksi_create()
{ 
    if(session()->get('level')== 1) {
        $a= $this->request->getPost('nama_level');

        //Yang ditambah ke user
        $data1=array(
            'nama_level'=>$a,
        );

        $model=new M_level();
        $model->simpan('level', $data1);

        return redirect()->to('data_level');
    }else {
        return redirect()->to('/');
    }
}
public function edit($id)
{ 
    if(session()->get('level')== 1) {
        $model=new M_level();
        $where=array('id_level'=>$id);
        $data['jojo']=$model->getWhere('level',$where);
        
        $data['title'] = 'Data Level';
        $data['desc'] = 'Anda dapat mengedit Data Level di Menu ini.';      
        $data['subtitle'] = 'Edit Data Level';  

        $data['level'] = $model->tampil('level');

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu');
        echo view('hopeui/level/edit', $data);
        echo view('hopeui/partial/footer');
    }else {
        return redirect()->to('home');
    }
}

public function aksi_edit()
{ 
    if(session()->get('level')== 1) {
       $a= $this->request->getPost('nama_level');
       $id= $this->request->getPost('id');

       //Yang ditambah ke user
       $where=array('id_level'=>$id);
       $data1=array(
        'nama_level'=>$a,
        'updated_at'=>date('Y-m-d H:i:s')
    );
       $model=new M_level();
       $model->qedit('level', $data1, $where);
       return redirect()->to('data_level');

   }else {
    return redirect()->to('/');
}
}

public function delete($id)
{ 
   if(session()->get('level')== 1) {
    $model=new M_level();
    $model->deletee($id);
    return redirect()->to('data_level');
}else {
    return redirect()->to('/');
}

}

}