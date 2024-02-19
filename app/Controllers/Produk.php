<?php

namespace App\Controllers;
use App\Models\M_produk;

class Produk extends BaseController
{

    public function index()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_produk();

            $data['jojo'] = $model->tampil('produk');

            $data['title'] = 'Data Produk';
            $data['desc'] = 'Anda dapat melihat Data Produk di Menu ini.';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/produk/view', $data);
            echo view('hopeui/partial/footer');
        } else {
            return redirect()->to('/');
        }
    }

    public function create()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_produk();

            $data['title'] = 'Data Produk';
            $data['desc'] = 'Anda dapat menambah Data Produk di Menu ini.';      
            $data['subtitle'] = 'Tambah Produk';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/produk/create', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_create()
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $a = $this->request->getPost('nama_produk');
            $b = $this->request->getPost('harga_produk');
            $c = $this->request->getPost('stok_produk');

            // Data yang akan disimpan
            $data1 = array(
                'NamaProduk' => $a,
                'Harga' => $b,
                'Stok' => $c
            );

            // Simpan data ke dalam database
            $model = new M_produk();
            $model->simpan('produk', $data1);

            return redirect()->to('produk');
        } else {
            return redirect()->to('/');
        }
    }

    public function edit($id)
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_produk();
            $where=array('ProdukID'=>$id);
            $data['jojo']=$model->getWhere('produk',$where);

            $data['title'] = 'Data Produk';
            $data['desc'] = 'Anda dapat mengedit Data Produk di Menu ini.';      
            $data['subtitle'] = 'Edit Data Produk';  

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/produk/edit', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_edit()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
           $a = $this->request->getPost('nama_produk');
            $b = $this->request->getPost('harga_produk');
            $c = $this->request->getPost('stok_produk');

            $id = $this->request->getPost('id');

            // Data yang akan disimpan
            $data1 = array(
                'NamaProduk' => $a,
                'Harga' => $b,
                'Stok' => $c,
                'updated_at'=>date('Y-m-d H:i:s')
            );

            $where = array('ProdukID' => $id);
            $model = new M_produk();
            $model->qedit('produk', $data1, $where);

            return redirect()->to('produk');
        } else {
            return redirect()->to('/');
        }
    }

    public function delete($id)
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_produk();
            $model->deletee($id);
            return redirect()->to('produk');
        }else {
            return redirect()->to('/');
        }
    }


    // --------------------------------- STOK PRODUK MASUK -----------------------------------------

    public function info_stok_masuk($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_produk();

            // Mengambil Data Produk masuk berdasarkan id produk
            $data['jojo'] = $model->getProdukMasukById($id);
            $data['jojo2'] = $id;

            $data['title'] = 'Data Stok Produk Masuk';
            $data['desc'] = 'Anda dapat melihat Stok Produk Masuk di Menu ini.';      

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/produk/view_stok_masuk', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function add_stok_masuk($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_produk();

            $where=array('ProdukID'=>$id);
            $data['jojo']=$model->getWhere('produk',$where);

            $data['title'] = 'Data Stok Produk Masuk';
            $data['desc'] = 'Anda dapat menambah Stok Produk Masuk di Menu ini.';      
            $data['subtitle'] = 'Tambah Stok Produk Masuk';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/produk/add_stok_masuk', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_add_stok_masuk()
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $a = $this->request->getPost('id');
            $b = $this->request->getPost('stok_produk');
            $c = session()->get('id');

            // Data yang akan disimpan
            $data1 = array(
                'ProdukID' => $a,
                'Stok_masuk' => $b,
                'user' => $c,
            );

            // Simpan data ke dalam database
            $model = new M_produk();
            $model->simpan('produk_masuk', $data1);

            return redirect()->to('produk/info_stok_masuk/' . $a);
        } else {
            return redirect()->to('/');
        }
    }

    public function delete_stok_masuk($id)
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_produk();

        // Mengambil ID produk terkait dari stok produk masuk yang akan dihapus
            $stok_masuk = $model->getProdukMasukByIdProdukMasuk($id);
            $id_produk = $stok_masuk->ProdukID;

        // Membuat kondisi untuk menghapus stok produk masuk
            $where = array('ProdukMasukID' => $id);
            $model->hapus('produk_masuk', $where);

        // Mengarahkan kembali ke halaman info_stok dengan ID produk yang diperoleh sebelumnya
            // return redirect()->to('produk');
            return redirect()->to('produk/info_stok_masuk/' . $id_produk);
        } else {
            return redirect()->to('/');
        }
    }
}