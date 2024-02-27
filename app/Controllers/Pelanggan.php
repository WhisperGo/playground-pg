<?php

namespace App\Controllers;
use App\Models\M_pelanggan;
use App\Models\M_transaksi;

class Pelanggan extends BaseController
{
    public function index()
    {
        if(session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_pelanggan();
            $data['jojo']=$model->tampil('pelanggan');

            $data['title']='Data Pelanggan';
            $data['desc']='Anda dapat melihat Data Pelanggan di Menu ini.';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu', $data);
            echo view('hopeui/pelanggan/view', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');

        }
    }

    public function create()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_pelanggan();

            $data['title']='Data Pelanggan';
            $data['desc']='Anda dapat tambah Data Pelanggan di Menu ini.'; 
            $data['subtitle'] = 'Tambah Data Pelanggan';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/pelanggan/create', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_create()
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $a = $this->request->getPost('nama_pelanggan');
            $b = $this->request->getPost('alamat');
            $c = $this->request->getPost('nama_orangtua');
            $d = $this->request->getPost('no_telepon');

            // Generate Kode Pelanggan sesuai format yang diminta: PLG+2 digit huruf acak + 2 digit angka acak
            $kode_pelanggan = $this->generateUniqueKodePelanggan();


            // Data yang akan disimpan
            $data1 = array(
                'NamaPelanggan' => $a,
                'Alamat' => $b,
                'NamaOrangtua' => $c,
                'NomorTelepon' => $d,
                'KodePelanggan' => $kode_pelanggan
            );

            // Simpan data ke dalam database
            $model = new M_pelanggan();
            $model->simpan('pelanggan', $data1);

            return redirect()->to('pelanggan');
        } else {
            return redirect()->to('/');
        }
    }

    public function edit($id)
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_pelanggan();
            $where=array('PelangganID'=>$id);
            $data['jojo']=$model->getWhere('pelanggan',$where);

            $data['title'] = 'Data Pelanggan';
            $data['desc'] = 'Anda dapat mengedit Data Pelanggan di Menu ini.';      
            $data['subtitle'] = 'Edit Data Pelanggan';  

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/pelanggan/edit', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_edit()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $a = $this->request->getPost('nama_pelanggan');
            $b = $this->request->getPost('alamat');
            $c = $this->request->getPost('nama_orangtua');
            $d = $this->request->getPost('no_telepon');
            $id = $this->request->getPost('id');

            // Data yang akan disimpan
            $data1 = array(
                'NamaPelanggan' => $a,
                'Alamat' => $b,
                'NamaOrangtua' => $c,
                'NomorTelepon' => $d,
                'updated_at'=>date('Y-m-d H:i:s')
            );

            // Simpan data ke dalam database
            $model = new M_pelanggan();
            $where=array('PelangganID'=>$id);
            $model->qedit('pelanggan', $data1, $where);

            return redirect()->to('pelanggan');
        } else {
            return redirect()->to('/');
        }
    }

    public function delete($id)
    { 
        if(session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_pelanggan();
            $model->deletee($id);
            return redirect()->to('pelanggan');
        }else {
            return redirect()->to('/');
        }
    }

    // ---------------------------------------- HISTORI PELANGGAN -----------------------------------------

    public function histori($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_transaksi();

            $on='transaksi.pelanggan_id = pelanggan.PelangganID';
            $data['jojo'] = $model->join2idpelanggan('transaksi', 'pelanggan', $on, $id);

            $data['title'] = 'Histori Pelanggan';
            $data['desc'] = 'Anda dapat melihat Histori Pelanggan di Menu ini.';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/pelanggan/view_histori', $data);
            echo view('hopeui/partial/footer');
        } else {
            return redirect()->to('/');
        }
    }

    // ------------------------------------------ KODE PELANGGAN ----------------------------------------------

    // Fungsi untuk menghasilkan KodePelanggan yang unik
    public function generateUniqueKodePelanggan()
    {
        $model = new M_pelanggan();

        do {
            // Generate Kode Pelanggan sesuai format yang diminta: PLG+2 digit huruf acak + 2 digit angka acak
            $kode_pelanggan = 'PLG' . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2) . substr(str_shuffle('0123456789'), 0, 2);

            // Periksa apakah KodePelanggan sudah ada dalam tabel pelanggan
            $existing_pelanggan = $model->getWhere('pelanggan', ['KodePelanggan' => $kode_pelanggan]);

            // Pastikan $existing_pelanggan bukan null sebelum memanggil getNumRows()
        } while ($existing_pelanggan !== null && $existing_pelanggan->getNumRows() > 0); // Ulangi pembuatan KodePelanggan jika sudah ada yang sama

        return $kode_pelanggan;
    }


}