<?php

namespace App\Controllers;
use App\Models\M_transaksi;

class Durasi_bermain extends BaseController
{

    public function index()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_transaksi();

            $on='transaksi.pelanggan_id = pelanggan.PelangganID';
            $data['jojo'] = $model->join2('transaksi', 'pelanggan', $on);

            $data['title'] = 'Durasi Bermain';
            $data['desc'] = 'Anda dapat melihat Durasi Bermain di Menu ini.';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/durasi_bermain/view', $data);
            echo view('hopeui/partial/footer');
        } else {
            return redirect()->to('/');
        }
    }

    public function edit($id)
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_transaksi();
            $where=array('id_transaksi'=>$id);
            $data['jojo']=$model->getWhere('transaksi',$where);

            $data['title'] = 'Durasi Bermain';
            $data['desc'] = 'Anda dapat mengedit Durasi Bermain di Menu ini.';      
            $data['subtitle'] = 'Edit Durasi Bermain';  

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/durasi_bermain/edit', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_edit($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $d = $this->request->getPost('durasi');
            $jam_selesai = date('H:i:s', strtotime("+$d hour"));

            // Data yang akan disimpan
            $data1 = array(
                'jam_selesai' => $jam_selesai,
            );

            $where = array('id_transaksi' => $id);
            $model = new M_transaksi();

            $model->qedit('transaksi', $data1, $where);

            return redirect()->to('transaksi');
        } else {
            return redirect()->to('/');
        }
    }

}