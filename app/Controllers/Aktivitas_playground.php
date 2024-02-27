<?php

namespace App\Controllers;
use App\Models\M_transaksi;

class Aktivitas_playground extends BaseController
{

    public function index()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_transaksi();

            // Mendapatkan waktu terakhir
            $waktu_terakhir = $model->getWaktuTerakhir();

            // Memanggil metode untuk menentukan apakah ada data baru
            $data['ada_data_baru'] = $this->metode_pengambilan_data_baru($waktu_terakhir);

            $on = 'transaksi.pelanggan_id = pelanggan.PelangganID';
            $data['jojo'] = $model->join2aktivitas('transaksi', 'pelanggan', $on);

            $data['title'] = 'Aktivitas Playground';
            $data['desc'] = 'Anda dapat melihat Aktivitas Playground di Menu ini.';
            $data['subtitle1'] = 'Masih Bermain';
            $data['subtitle2'] = 'Selesai Bermain';

            $data['waktu_terakhir'] = $waktu_terakhir;

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/top_menu_special');
            echo view('hopeui/aktivitas/view', $data);
            echo view('hopeui/partial/footer');
        } else {
            return redirect()->to('/');
        }
    }

    public function metode_pengambilan_data_baru($waktu_terakhir)
    {
        $model = new M_transaksi();

        // Misalnya, hitung jumlah data baru yang dimasukkan sejak waktu terakhir pembaruan data
        $jumlah_data_baru = $model->hitungDataBaruSejakPermintaanSebelumnya($waktu_terakhir);

        // Jika ada data baru, kirimkan respon 'ada_data_baru' ke client
        if ($jumlah_data_baru > 0) {
            return 'ada_data_baru';
        } else {
            return 'tidak_ada_data_baru';
        }
    }

    public function create()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_transaksi();

            $data['title'] = 'Data Transaksi';
            $data['desc'] = 'Anda dapat menambah Data Transaksi di Menu ini.';  
            $data['subtitle'] = 'Tambah Transaksi';

            $data['pelanggan'] = $model->tampil('pelanggan');

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/transaksi/create', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_create()
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $a = $this->request->getPost('nama_pelanggan');
            $b = $this->request->getPost('jam_mulai');
            $c = $this->request->getPost('jam_selesai');

            // Data yang akan disimpan
            $data1 = array(
                'pelanggan_id' => $a,
                'jam_mulai' => $b,
                'jam_selesai' => $c
            );

            // Simpan data ke dalam database
            $model = new M_transaksi();
            $model->simpan('transaksi', $data1);

            return redirect()->to('transaksi');
        } else {
            return redirect()->to('/');
        }
    }

    public function aksi_edit_status($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {

            // Data yang akan disimpan
            $data1 = array(
                'status' => '2',
            );

            $where = array('id_transaksi' => $id);
            $model = new M_transaksi();

            $model->qedit('transaksi', $data1, $where);

            return redirect()->to('transaksi');
        } else {
            return redirect()->to('/');
        }
    }

    public function delete($id)
    { 
        if(session()->get('level')== 1 || session()->get('level')== 2) {
            $model=new M_transaksi();
            $model->deletee($id);
            return redirect()->to('transaksi');
        }else {
            return redirect()->to('/');
        }
    }

}