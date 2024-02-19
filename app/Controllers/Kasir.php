<?php

namespace App\Controllers;
use App\Models\M_penjualan;
use App\Models\M_detail_penjualan;
use App\Models\M_produk;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kasir extends BaseController
{

    public function index()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_produk();

            $data['title'] = 'Kasir Penjualan';
            $data['desc'] = 'Penjualan dilakukan melalui menu ini.';
            $data['produk'] = $model->findAll(); // Mengambil semua data produk untuk autocomplete

            $data['produk_list'] = $model->tampilProduk('produk');
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
        $produkId = $this->request->getPost('produk_id');
        $produkModel = new M_produk();
        $produk = $produkModel->find($produkId);

    // Jika produk ditemukan, tambahkan ke keranjang belanja
        if ($produk) {
        // Data item yang baru ditambahkan
            $newItem = [
                'id' => $produk['ProdukID'],
                'nama_produk' => $produk['NamaProduk'],
                'harga' => $produk['Harga']
            ];

        // Kirim tanggapan JSON dengan data item
            return $this->response->setJSON(['item' => $newItem]);
        } else {
        // Jika produk tidak ditemukan, kirim tanggapan JSON kosong atau beri kode status 404
            return $this->response->setStatusCode(404);
        }
    }


    public function tambah_produk()
    {
        $produkID = $this->request->getPost('produkID');
        $produk = $this->M_produk->find($produkID); // Ambil data produk dari database berdasarkan ID

        // Buat baris produk untuk ditambahkan ke dalam tabel pembayaran
        $html = '<tr>';
        $html .= '<td>' . $produk['ProdukID'] . '</td>'; // Ganti dengan kolom yang sesuai dengan data produk
        $html .= '<td>' . $produk['NamaProduk'] . '</td>';
        $html .= '<td>1</td>'; // Jumlah produk (misalnya 1)
        $html .= '<td>' . $produk['Harga'] . '</td>'; // Harga produk
        $html .= '<td><button class="btn btn-danger btn-sm">Hapus</button></td>'; // Tombol hapus untuk menghapus produk dari tabel pembayaran
        $html .= '</tr>';

        echo $html;
    }

    public function aksi_create()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $a = date('Y-m-d');
            $b = $this->request->getPost('pelanggan');
            $c = $this->request->getPost('total_harga');

        // Data yang akan disimpan
            $data1 = [
                'TanggalPenjualan' => $a,
                'PelangganID' => $b,
                'TotalHarga' => $c,
                'user' => session()->get('id'),
            ];

        // Simpan data ke dalam database
            $model = new M_penjualan();
            $model->simpan('penjualan', $data1);

        // Ambil PenjualanID dari data yang baru saja disimpan
            $penjualanid = $model->insertID();

            $dataFromTable = json_decode($this->request->getPost('data_table'), true);
            foreach ($dataFromTable as $item) {
                $data2 = [
                    'PenjualanID' => $penjualanid,
                    'ProdukID' => $item['produk_id'],
                    'JumlahProduk' => $item['jumlah'],
                    'Subtotal' => $item['subtotal'],
                ];

                $model->simpan('detailpenjualan', $data2);
            }

            return redirect()->to('detail_penjualan/' . $penjualanid);
        } else {
            return redirect()->to('/');
        }
    }

    public function cetak_invoice($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_penjualan();
            $model2 = new M_detail_penjualan();

            $on='penjualan.PelangganID = pelanggan.PelangganID';
            $on2='penjualan.user = user.id_user';
            $data['jojo'] = $model2->join3id('penjualan', 'pelanggan', 'user', $on, $on2, $id);

            $on='detailpenjualan.PenjualanID = penjualan.PenjualanID';
            $on2='detailpenjualan.ProdukID = produk.ProdukID';
            $data['jojo2'] = $model2->join3id('detailpenjualan', 'penjualan', 'produk', $on, $on2, $id);

            $data['title'] = 'Invoice Belanja';
            echo view('hopeui/partial/header', $data);
            echo view('hopeui/kasir/invoice', $data);
            echo view('hopeui/partial/footer_print');  
        } else {
            return redirect()->to('/');
        }
    }

}