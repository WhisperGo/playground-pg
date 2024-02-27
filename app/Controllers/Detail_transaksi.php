<?php

namespace App\Controllers;
use App\Models\M_detail_transaksi;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Detail_transaksi extends BaseController
{

    public function view($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_detail_transaksi();

            $on='detail_transaksi.transaksi_id = transaksi.id_transaksi';
            $on2='detail_transaksi.permainan_id = permainan.id_permainan';
            $data['jojo'] = $model->join3id('detail_transaksi', 'transaksi', 'permainan', $on, $on2, $id);
            $data['id_transaksi'] = $id;

            $data['title'] = 'Detail Transaksi';
            $data['desc'] = 'Anda dapat melihat Detail Transaksi di Menu ini.';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/detail_transaksi/view', $data);
            echo view('hopeui/partial/footer');
        } else {
            return redirect()->to('/');
        }
    }
    
}