<?php

namespace App\Controllers;
use App\Models\M_permainan;
use App\Models\M_transaksi;
use App\Models\M_detail_transaksi;
use App\Models\M_paket_permainan;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kasir extends BaseController
{

    public function index()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_permainan();
            $model2 = new M_paket_permainan();

            $data['title'] = 'Kasir Pembayaran';
            $data['desc'] = 'Pembayaran dilakukan melalui menu ini.';
            $data['permainan'] = $model->findAll(); // Mengambil semua data produk untuk autocomplete

            $data['permainan_list'] = $model->tampil('permainan');
            $data['pelanggan_list'] = $model->tampil('pelanggan');
            $data['paket_list'] = $model2->tampil('paket_permainan');
            $data['pajak_ppn'] = $this->getPajakPPN();

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
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $a = $this->request->getPost('pelanggan');
            $b = date('Y-m-d');
            $c = date('H:i:s');

            $d = $this->request->getPost('durasi');
            $paketModel = new M_paket_permainan();
            $paket = $paketModel->find($d);
            
            // Ambil nilai durasi paket
            $durasiPaket = intval($paket['durasi_paket']);
            
            // Cek jika nama_paket adalah "sepuasnya"
            if ($paket['nama_paket'] === "Sepuasnya") {
                // Jika ya, durasi tidak perlu ditambah
                $jam_selesai = ''; // Jam selesai sama dengan jam mulai
            } else {
                // Jika tidak, tambahkan durasi paket ke jam mulai
                $jam_selesai = date('H:i:s', strtotime("+$durasiPaket hour"));
            }

            $e = $this->request->getPost('pajak');
            $f = $this->request->getPost('total_harga');
            $g = $this->request->getPost('bayar');
            $h = $this->request->getPost('kembalian');

            // Periksa apakah pelanggan masih bermain pada tanggal transaksi yang sama
            $model = new M_transaksi();
            $statusPelanggan = $model->getStatusPelangganOnDate($a, $b);

            // Jika status pelanggan masih bermain, tampilkan pesan kesalahan dan redirect kembali
            if ($statusPelanggan == 1) {
                session()->setFlashdata('errorKasir', 'Pelanggan ini masih bermain. Tidak bisa menambahkan transaksi baru.');
                return redirect()->back();
            }

            // Data yang akan disimpan
            $data1 = [
                'pelanggan_id' => $a,
                'tanggal_transaksi' => $b,
                'jam_mulai' => $c,
                'jam_selesai' => $jam_selesai,
                'pajak_id' => $e,
                'total_harga' => $f,
                'bayar' => $g,
                'kembalian' => $h,
                'user' => session()->get('id'),
            ];

            // Simpan data ke dalam database
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


    // --------------------------------------- INVOICE --------------------------------------------------

     public function cetak_invoice($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_transaksi();
            $model2 = new M_detail_transaksi();

            $on='transaksi.pelanggan_id = pelanggan.PelangganID';
            $on2='transaksi.user = user.id_user';
            $on3='transaksi.pajak_id = pajak.id_pajak';
            $data['jojo'] = $model->join4id('transaksi', 'pelanggan', 'user', 'pajak', $on, $on2, $on3, $id);

            $on='detail_transaksi.transaksi_id = transaksi.id_transaksi';
            $on2='detail_transaksi.permainan_id = permainan.id_permainan';
            $data['jojo2'] = $model2->join3id('detail_transaksi', 'transaksi', 'permainan', $on, $on2, $id);

            $data['title'] = 'Nota Playground';
            echo view('hopeui/partial/header', $data);
            echo view('hopeui/kasir/invoice', $data);
            echo view('hopeui/partial/footer_print');  
        } else {
            return redirect()->to('/');
        }
    }


    // ------------------------------------------ PAJAK PPN -------------------------------------------------

    public function getPajakPPN()
    {
        $model2 = new M_paket_permainan();
        $pajak_list = $model2->tampil('pajak');
        foreach ($pajak_list as $pajak) {
            if ($pajak->nama_pajak == 'PPN') {
                return $pajak; // Mengembalikan persen pajak PPN jika ditemukan
            }
        }
        // return 0; // Mengembalikan nilai default jika tidak ditemukan
    }

}