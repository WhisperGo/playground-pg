<?php

namespace App\Controllers;
use App\Models\M_permainan;
use App\Models\M_pelanggan;
use App\Models\M_transaksi;

class Dashboard extends BaseController
{
    public function index()
    {
        if(session()->get('id') > 0) {
            $model = new M_permainan();
            $jumlah_permainan = $model->hitungsemua();

            $model2 = new M_pelanggan();
            $jumlah_pelanggan = $model2->hitungsemua();

            $model3 = new M_transaksi();
            $jumlah_transaksi = $model3->hitungSemuaHariIni();

            $data['title'] = 'Dashboard';
            $data['desc'] = 'Selamat Datang di website kami!';
            $data['jumlah_permainan'] = $jumlah_permainan;
            $data['jumlah_pelanggan'] = $jumlah_pelanggan;
            $data['jumlah_transaksi'] = $jumlah_transaksi;

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu', $data); 
            echo view('hopeui/dashboard/view', $data);
            echo view('hopeui/partial/footer');
        } else {
            return redirect()->to('/');
        }
    }
}
