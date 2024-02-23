<?php

namespace App\Controllers;
use App\Models\M_permainan;
use App\Models\M_transaksi;
use App\Models\M_detail_transaksi;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kasir extends BaseController
{

    public function index()
    {
        if (session()->get('level') == 1) {
            $model = new M_permainan();

            $data['title'] = 'Kasir Pembayaran';
            $data['desc'] = 'Pembayaran dilakukan melalui menu ini.';
            $data['permainan'] = $model->findAll(); // Mengambil semua data produk untuk autocomplete

            $data['permainan_list'] = $model->tampil('permainan');
            $data['pelanggan_list'] = $model->tampil('pelanggan');

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/kasir/view', $data);
            echo view('hopeui/partial/footer');
        } else {
            return redirect()->to('/');
        }
    }

    public function tambah_ke_keranjang()
    {
    // Ambil data produk berdasarkan ID yang dikirimkan melalui AJAX
        $permainanId = $this->request->getPost('permainan_id');
        $permainanModel = new M_permainan();
        $permainan = $permainanModel->find($permainanId);

    // Jika produk ditemukan, tambahkan ke keranjang belanja
        if ($permainan) {
        // Data item yang baru ditambahkan
            $newItem = [
                'id' => $permainan['id_permainan'],
                'nama_permainan' => $permainan['nama_permainan'],
                'harga' => $permainan['harga_permainan']
            ];

        // Kirim tanggapan JSON dengan data item
            return $this->response->setJSON(['item' => $newItem]);
        } else {
        // Jika produk tidak ditemukan, kirim tanggapan JSON kosong atau beri kode status 404
            return $this->response->setStatusCode(404);
        }
    }

    public function aksi_create()
    {
        if (session()->get('level') == 1) {
            $a = $this->request->getPost('pelanggan');
            $b = date('Y-m-d');
            $c = date('H:i:s');

            $d = $this->request->getPost('durasi');
            $jam_selesai = date('H:i:s', strtotime("+$d hour"));

            $e = $this->request->getPost('total_harga');

        // Data yang akan disimpan
            $data1 = [
                'pelanggan_id' => $a,
                'tanggal_transaksi' => $b,
                'jam_mulai' => $c,
                'jam_selesai' => $jam_selesai,
                'total_harga' => $e,
                'user' => session()->get('id'),
            ];

        // Simpan data ke dalam database
            $model = new M_transaksi();
            $model->simpan('transaksi', $data1);

        // Ambil PenjualanID dari data yang baru saja disimpan
            $transaksiid = $model->insertID();

            $dataFromTable = json_decode($this->request->getPost('data_table'), true);
            foreach ($dataFromTable as $item) {
                $data2 = [
                    'transaksi_id' => $transaksiid,
                    'permainan_id' => $item['permainan_id'],
                    'durasi' => $d,
                    'subtotal' => $item['subtotal'],
                ];

                $model->simpan('detail_transaksi', $data2);
            }

            return redirect()->to('transaksi');
        } else {
            return redirect()->to('/');
        }
    }

    public function cetak_invoice($id)
    {
        if (session()->get('level') == 1) {
            $model = new M_transaksi();
            $model2 = new M_detail_transaksi();

            $on='transaksi.pelanggan_id = pelanggan.PelangganID';
            $on2='transaksi.user = user.id_user';
            $data['jojo'] = $model->join3id('transaksi', 'pelanggan', 'user', $on, $on2, $id);

            $on='detail_transaksi.transaksi_id = transaksi.id_transaksi';
            $on2='detail_transaksi.permainan_id = permainan.id_permainan';
            $data['jojo2'] = $model2->join3id('detail_transaksi', 'transaksi', 'permainan', $on, $on2, $id);

            $data['title'] = 'Invoice Playground';
            echo view('hopeui/partial/header', $data);
            echo view('hopeui/kasir/invoice', $data);
            echo view('hopeui/partial/footer_print');  
        } else {
            return redirect()->to('/');
        }
    }

}