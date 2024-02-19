<?php

namespace App\Controllers;
use App\Models\M_produk;
use App\Models\M_pelanggan;
use App\Models\M_detail_penjualan;

class Dashboard extends BaseController
{
    public function index()
    {
        if(session()->get('id') > 0) {
            $model = new M_produk();
            $jumlah_produk = $model->hitungsemua();

            $model2 = new M_pelanggan();
            $jumlah_pelanggan = $model2->hitungsemua();

            $model3 = new M_detail_penjualan();
            $jumlah_penjualan = $model3->hitungSemuaBulanIni();

            $data['title'] = 'Dashboard';
            $data['desc'] = 'Selamat datang di Website GT Kasir. Selamat Bekerja!';
            $data['jumlah_produk'] = $jumlah_produk;
            $data['jumlah_pelanggan'] = $jumlah_pelanggan;
            $data['jumlah_penjualan'] = $jumlah_penjualan;

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
