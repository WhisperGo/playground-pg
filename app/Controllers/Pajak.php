<?php

namespace App\Controllers;
use App\Models\M_pajak;

class Pajak extends BaseController
{
    public function index()
    {
     if(session()->get('level')== 1) {
        $model=new M_pajak();
        $data['jojo']=$model->tampil('pajak');

        $data['title']='Data Pajak';
        $data['desc']='Anda dapat melihat Data Pajak di Menu ini.';

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu', $data);
        echo view('hopeui/pajak/view', $data);
        echo view('hopeui/partial/footer');
    }else {
        return redirect()->to('/');
    }
}

public function create()
{
    if(session()->get('level')== 1) {
        $model=new M_pajak();

        $data['title']='Data Pajak';
        $data['desc']='Anda dapat tambah Data Pajak di Menu ini.'; 
        $data['subtitle'] = 'Tambah Data Pajak';

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu');
        echo view('hopeui/pajak/create', $data);
        echo view('hopeui/partial/footer');
    }else {
        return redirect()->to('/');
    }
}

public function aksi_create()
{ 
    if(session()->get('level')== 1) {
        $a= $this->request->getPost('nama_pajak');
        $b= $this->request->getPost('persen_pajak');

        //Yang ditambah ke user
        $data1=array(
            'nama_pajak'=>$a,
            'persen_pajak'=>$b,
        );

        $model=new M_pajak();
        $model->simpan('pajak', $data1);

        return redirect()->to('pajak');
    }else {
        return redirect()->to('/');
    }
}
public function edit($id)
{ 
    if(session()->get('level')== 1) {
        $model=new M_pajak();
        $where=array('id_pajak'=>$id);
        $data['jojo']=$model->getWhere('pajak',$where);
        
        $data['title'] = 'Data Pajak';
        $data['desc'] = 'Anda dapat mengedit Data Pajak di Menu ini.';      
        $data['subtitle'] = 'Edit Data Pajak';  

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu');
        echo view('hopeui/pajak/edit', $data);
        echo view('hopeui/partial/footer');
    }else {
        return redirect()->to('/');
    }
}

public function aksi_edit()
{ 
    if(session()->get('level')== 1) {
       $a= $this->request->getPost('nama_pajak');
       $b= $this->request->getPost('persen_pajak');
       $id= $this->request->getPost('id');

       //Yang ditambah ke user
       $data1=array(
        'nama_pajak'=>$a,
        'persen_pajak'=>$b,
        'updated_at'=>date('Y-m-d H:i:s')
    );

       $model=new M_pajak();
       $where=array('id_pajak'=>$id);
       $model->qedit('pajak', $data1, $where);
       return redirect()->to('pajak');

   }else {
    return redirect()->to('/');
}
}

public function delete($id)
{ 
   if(session()->get('level')== 1) {
    $model=new M_pajak();
    $model->deletee($id);
    return redirect()->to('pajak');
}else {
    return redirect()->to('/');
}

}

}