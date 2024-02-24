<?php

namespace App\Controllers;
use App\Models\M_website;

class Data_website extends BaseController
{

    public function index()
{
    if (session()->get('level') == 1) {
        $model = new M_website();
        $data['jojo'] = $model->tampil('website');

        $data['title'] = 'Data Website';
        $data['desc']='Anda dapat melihat Data Level di Menu ini.';

        // Menghitung jumlah data website
        $data['jumlah_data'] = count($data['jojo']);

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu');
        echo view('hopeui/data_website/view', $data);
        echo view('hopeui/partial/footer');
    } else {
        return redirect()->to('login');
    }
}


public function create()
{
    if(session()->get('level')== 1) {
        $model=new M_website();
        $data['darel']=$model->tampil('website');

        $data['title']='Data Website';        
        $data['desc']='Anda dapat tambah Data Website di Menu ini.'; 
        $data['subtitle'] = 'Tambah Data Website';

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu');
        echo view('hopeui/data_website/create', $data); 
        echo view('hopeui/partial/footer');
    }else {
        return redirect()->to('login');
    }
}

public function aksi_create()
{ 
    if(session()->get('level')== 1) {
        $a= $this->request->getPost('nama_perusahaan');
        date_default_timezone_set('Asia/Jakarta');

        $logo_perusahaan= $this->request->getFile('logo_perusahaan');
        if($logo_perusahaan && $logo_perusahaan->isValid() && ! $logo_perusahaan->hasMoved())
        {
            $imageName1 = $logo_perusahaan->getName();
            $logo_perusahaan->move('logo/logo_perusahaan',$imageName1);
        }else{
            $imageName1='logo_contoh.svg';
        }

        $logo_pdf= $this->request->getFile('logo_pdf');
        if($logo_pdf && $logo_pdf->isValid() && ! $logo_pdf->hasMoved())
        {
            $imageName2 = $logo_pdf->getName();
            $logo_pdf->move('logo/logo_pdf',$imageName2);
        }else{
            $imageName2='logo_pdf_contoh.svg';
        }

        $favicon= $this->request->getFile('favicon');
        if($favicon && $favicon->isValid() && ! $favicon->hasMoved())
        {
            $imageName3 = $favicon->getName();
            $favicon->move('logo/favicon',$imageName3);
        }else{
            $imageName3='favicon_contoh.svg';
        }

        //Yang ditambah ke user
        $data1=array(
            'nama_perusahaan'=>$a,
            'logo_perusahaan'=>$imageName1,
            'logo_pdf_perusahaan'=>$imageName2,
            'favicon_perusahaan'=>$imageName3,
        );
        $model=new M_website();
        $model->simpan('perusahaan', $data1);

        echo view('hopeui/partial/header');
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu');
        echo view('hopeui/partial/footer');
        return redirect()->to('data_website');
    }else {
        return redirect()->to('login');
    }
}
public function edit($id)
{ 
    if(session()->get('level')== 1) {
        $model=new M_website();
        $where=array('id_website'=>$id);
        $data['jojo']=$model->getWhere('website',$where);

        $data['title']='Data Website';        
        $data['desc'] = 'Anda dapat mengedit Data Website di Menu ini.';      
        $data['subtitle'] = 'Edit Data Website';  

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu');
        echo view('hopeui/data_website/edit',$data);
        echo view('hopeui/partial/footer');    
    }else {
        return redirect()->to('login');
    }
}

public function aksi_edit()
{ 
    if(session()->get('level')== 1) {
        $a= $this->request->getPost('nama_website');
        $id= $this->request->getPost('id');
        date_default_timezone_set('Asia/Jakarta');

        $logo_website= $this->request->getFile('logo_website');
        if (!empty($logo_website->getName())) {
            if ($logo_website->isValid() && !$logo_website->hasMoved()) {
                if (file_exists("logo/logo_website/" . $id)) {
                    unlink("logo/logo_website/" . $id);
                }
                $imageName1 = $logo_website->getName();
                $logo_website->move('logo/logo_website', $imageName1);
            }
        } else {
            $imageName1 = $this->request->getPost('old_logo_website');
        }

        $logo_pdf= $this->request->getFile('logo_pdf');
        if (!empty($logo_pdf->getName())) {
            if ($logo_pdf->isValid() && !$logo_pdf->hasMoved()) {
                if (file_exists("logo/logo_pdf/" . $id)) {
                    unlink("logo/logo_pdf/" . $id);
                }
                $imageName2 = $logo_pdf->getName();
                $logo_pdf->move('logo/logo_pdf', $imageName2);
            }
        } else {
            $imageName2 = $this->request->getPost('old_logo_pdf');
        }

        $favicon= $this->request->getFile('favicon');
        if (!empty($favicon->getName())) {
            if ($favicon->isValid() && !$favicon->hasMoved()) {
                if (file_exists("logo/favicon/" . $id)) {
                    unlink("logo/favicon/" . $id);
                }
                $imageName3 = $favicon->getName();
                $favicon->move('logo/favicon', $imageName3);
            }
        } else {
            $imageName3 = $this->request->getPost('old_favicon');
        }

        //Yang ditambah ke user
        $data1=array(
            'nama_website'=>$a,
            'logo_website'=>$imageName1,
            'logo_pdf'=>$imageName2,
            'favicon_website'=>$imageName3,
        );
        $where=array('id_website'=>$id);
        $model=new M_website();
        $model->qedit('website', $data1, $where);

        return redirect()->to('data_website');
    }else {
        return redirect()->to('login');
    }
}
public function delete($id)
{ 
    if(session()->get('level')== 1) {
        $model=new M_website();
        $model->deletee($id);
        return redirect()->to('data_website');
    }else {
        return redirect()->to('login');
    }
}
}