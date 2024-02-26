<?php

namespace App\Controllers;
use App\Models\M_transaksi;
use App\Models\M_detail_transaksi;
use App\Models\M_pengeluaran;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Laporan_keuangan extends BaseController
{

    // --------------------------------------- PRINT LAPORAN --------------------------------------

    public function menu_laporan()
    {
        if (session()->get('level') == 1) {
            $model=new M_transaksi();

            $data['title'] = 'Laporan Keuangan';
            $data['desc'] = 'Anda dapat mengprint Laporan Keuangan di Menu ini.';      
            $data['subtitle'] = 'Print Laporan Keuangan';             
            $data['subtitle2'] = 'Print Laporan Keuangan Per Hari';             

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/laporan_keuangan/menu_laporan', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function export_windows()
    {
        if (session()->get('level') == 1) {
            $model = new M_transaksi();

            $awal = $this->request->getPost('awal');
            $akhir = $this->request->getPost('akhir');

        // Get total harga transaksi dalam rentang tanggal tertentu
            $data['transaksi'] = $model->getTotalHargaTransaksiPeriode($awal, $akhir);

        // Panggil model untuk mendapatkan total pengeluaran dalam rentang tanggal tertentu
            $data['pengeluaran'] = $model->getTotalPengeluaranPeriode($awal, $akhir);

            $data['awal'] = $awal;
            $data['akhir'] = $akhir;

            $data['title'] = 'Laporan Keuangan';
            echo view('hopeui/partial/header', $data);
            echo view('hopeui/laporan_keuangan/print_windows_view', $data);
            echo view('hopeui/partial/footer_print');  
        } else {
            return redirect()->to('/');
        }
    }

    public function export_pdf()
    {
        if (session()->get('level') == 1) {
            $model = new M_transaksi();

            $awal = $this->request->getPost('awal');
            $akhir = $this->request->getPost('akhir');

            // Get data absensi kantor berdasarkan filter
            $data['transaksi'] = $model->getAllTransaksiPeriode($awal, $akhir);
            $data['awal'] = $awal;
            $data['akhir'] = $akhir;
            
            // Load the dompdf library
            $dompdf = new Dompdf();

            // Set the HTML content for the PDF
            $data['title'] = 'Laporan Keuangan';
            $dompdf->loadHtml(view('hopeui/laporan_transaksi/print_pdf_view',$data));
            $dompdf->setPaper('A4','landscape');
            $dompdf->render();
            
            // Generate file name with start and end date
            $file_name = 'laporan_transaksi_' . str_replace('-', '', $awal) . '_' . str_replace('-', '', $akhir) . '.pdf';

            // Output the generated PDF (inline or attachment)
            $dompdf->stream($file_name, ['Attachment' => 0]);

        } else {
            return redirect()->to('/');
        }
    }

    public function export_excel()
    {
        if (session()->get('level') == 1) {
            $model = new M_transaksi();

            $awal = $this->request->getPost('awal');
            $akhir = $this->request->getPost('akhir');

            $transaksi = $model->getAllTransaksiPeriode($awal, $akhir);

            $spreadsheet = new Spreadsheet();

            // Get the active worksheet and set the default row height for header row
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->getDefaultRowDimension()->setRowHeight(20);

            $sheet->mergeCells('A1:F1');
            $sheet->setCellValue('A1', 'Data Laporan Transaksi');

            $periode = date('d F Y', strtotime($awal)) . ' - ' . date('d F Y', strtotime($akhir));
            $sheet->mergeCells('A2:F2');
            $sheet->setCellValue('A2', 'Periode: ' . $periode);

            // $sheet->setCellValue('G3', 'Jumlah Penjualan : ' . count($penjualan));

            // Set the header row values
            $sheet->setCellValueByColumnAndRow(1, 4, 'No.');
            $sheet->setCellValueByColumnAndRow(2, 4, 'Nama Permainan');
            $sheet->setCellValueByColumnAndRow(3, 4, 'Durasi');
            $sheet->setCellValueByColumnAndRow(4, 4, 'Tanggal Transaksi');
            $sheet->setCellValueByColumnAndRow(5, 4, 'Kasir');
            $sheet->setCellValueByColumnAndRow(6, 4, 'Subtotal');

            // Fill the data into the worksheet
            $row = 5;
            $no = 1;
            foreach ($transaksi as $riz) {
                $sheet->setCellValueByColumnAndRow(1, $row, $no++);
                $sheet->setCellValueByColumnAndRow(2, $row, $riz->nama_permainan);
                $sheet->setCellValueByColumnAndRow(3, $row, $riz->durasi . ' jam');

                // Mengganti koma dengan titik dan mengonversi ke float
                $subtotal = str_replace(',', '', $riz->subtotal);
                $subtotal = floatval($subtotal);

                // Mengisi sel dengan nilai yang diformat sebagai accounting
                $sheet->setCellValueByColumnAndRow(4, $row, date('d F Y, H:i', strtotime($riz->created_at_detail_transaksi)));
                $sheet->setCellValueByColumnAndRow(5, $row, $riz->username);
                $sheet->setCellValueByColumnAndRow(6, $row, $subtotal);

                $row++;
            }

        // Apply the Excel styling
            $sheet->getStyle('A1')->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);

            $sheet->getStyle('A2')->getFont()->setBold(true);
            $sheet->getStyle('A2')->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            $sheet->getStyle('A4:F4')->getFont()->setBold(true);
            $sheet->getStyle('A4:F4')->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('A4:F4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');

            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ];

            $alignmentArray = [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];


        $lastRow = count($transaksi) + 4; // Add 4 for the header rows
        $sheet->getStyle('A4:F' . $lastRow)->applyFromArray($styleArray);
        $sheet->getStyle('A5:A' . $lastRow)->applyFromArray($alignmentArray);
        $sheet->getStyle('F5:F' . $lastRow)->getNumberFormat()->setFormatCode('_("$"* #,##0.00_);_("$"* \(#,##0.00\);_("$"* "-"??_);_(@_)');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);

        $spreadsheet->getActiveSheet()->setShowGridlines(false);

        // Generate file name with start and end date
        $file_name = 'laporan_transaksi_' . str_replace('-', '', $awal) . '-' . str_replace('-', '', $akhir) . '.xlsx';

        // Create the Excel writer and save the file
        $writer = new Xlsx($spreadsheet);
        $filename = $file_name;
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    } else {
        return redirect()->to('/');
    }
}


// --------------------------------- PRINT LAPORAN PER HARI -----------------------------------


public function export_windows_per_hari()
{
    if (session()->get('level') == 1) {
        $model = new M_transaksi();

        $tanggal = $this->request->getPost('tanggal');

        // Get total harga transaksi dalam rentang tanggal tertentu
        $data['transaksi'] = $model->getTotalHargaTransaksiPerHari($tanggal);

        // Panggil model untuk mendapatkan total pengeluaran dalam rentang tanggal tertentu
        $data['pengeluaran'] = $model->getTotalPengeluaranPerHari($tanggal);

        $data['awal'] = $awal;
        $data['akhir'] = $akhir;

        $data['title'] = 'Laporan Keuangan';
        echo view('hopeui/partial/header', $data);
        echo view('hopeui/laporan_keuangan/print_windows_view', $data);
        echo view('hopeui/partial/footer_print');  
    } else {
        return redirect()->to('/');
    }
}

public function export_pdf_per_hari()
{
    if (session()->get('level') == 1) {
        $model = new M_transaksi();

        $tanggal = $this->request->getPost('tanggal');

            // Get data penjualan berdasarkan tanggal
        $data['transaksi'] = $model->getAllTransaksiPerHari($tanggal);
        $data['tanggal'] = $tanggal;

            // Load the dompdf library
        $dompdf = new Dompdf();

            // Set the HTML content for the PDF
        $data['title'] = 'Laporan Keuangan';
        $dompdf->loadHtml(view('hopeui/laporan_transaksi/print_pdf_view',$data));
        $dompdf->setPaper('A4','landscape');
        $dompdf->render();

            // Generate file name with start and end date
        $file_name = 'laporan_transaksi_' . str_replace('-', '', $awal) . '_' . str_replace('-', '', $akhir) . '.pdf';

            // Output the generated PDF (inline or attachment)
        $dompdf->stream($file_name, ['Attachment' => 0]);
    } else {
        return redirect()->to('/');
    }
}

public function export_excel_per_hari()
{
    if (session()->get('level') == 1) {
        $model = new M_transaksi();

        $tanggal = $this->request->getPost('tanggal');

        $transaksi = $model->getAllTransaksiPerHari($tanggal);

        $spreadsheet = new Spreadsheet();

            // Get the active worksheet and set the default row height for header row
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getDefaultRowDimension()->setRowHeight(20);

        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', 'Data Laporan Transaksi');

        $periode = date('d F Y', strtotime($tanggal));
        $sheet->mergeCells('A2:F2');
        $sheet->setCellValue('A2', 'Periode: ' . $periode);

            // $sheet->setCellValue('G3', 'Jumlah Penjualan : ' . count($penjualan));

            // Set the header row values
        $sheet->setCellValueByColumnAndRow(1, 4, 'No.');
        $sheet->setCellValueByColumnAndRow(2, 4, 'Nama Permainan');
        $sheet->setCellValueByColumnAndRow(3, 4, 'Durasi');
        $sheet->setCellValueByColumnAndRow(4, 4, 'Tanggal Transaksi');
        $sheet->setCellValueByColumnAndRow(5, 4, 'Kasir');
        $sheet->setCellValueByColumnAndRow(6, 4, 'Subtotal');

            // Fill the data into the worksheet
        $row = 5;
        $no = 1;
        foreach ($transaksi as $riz) {
            $sheet->setCellValueByColumnAndRow(1, $row, $no++);
            $sheet->setCellValueByColumnAndRow(2, $row, $riz->nama_permainan);
            $sheet->setCellValueByColumnAndRow(3, $row, $riz->durasi . ' jam');

                // Mengganti koma dengan titik dan mengonversi ke float
            $subtotal = str_replace(',', '', $riz->subtotal);
            $subtotal = floatval($subtotal);

                // Mengisi sel dengan nilai yang diformat sebagai accounting
            $sheet->setCellValueByColumnAndRow(4, $row, date('d F Y, H:i', strtotime($riz->created_at_detail_transaksi)));
            $sheet->setCellValueByColumnAndRow(5, $row, $riz->username);
            $sheet->setCellValueByColumnAndRow(6, $row, $subtotal);

            $row++;
        }

        // Apply the Excel styling
        $sheet->getStyle('A1')->getAlignment()
        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
        ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);

        $sheet->getStyle('A2')->getFont()->setBold(true);
        $sheet->getStyle('A2')->getAlignment()
        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
        ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $sheet->getStyle('A4:F4')->getFont()->setBold(true);
        $sheet->getStyle('A4:F4')->getAlignment()
        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
        ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A4:F4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        $alignmentArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];


        $lastRow = count($transaksi) + 4; // Add 4 for the header rows
        $sheet->getStyle('A4:F' . $lastRow)->applyFromArray($styleArray);
        $sheet->getStyle('A5:A' . $lastRow)->applyFromArray($alignmentArray);
        $sheet->getStyle('F5:F' . $lastRow)->getNumberFormat()->setFormatCode('_("$"* #,##0.00_);_("$"* \(#,##0.00\);_("$"* "-"??_);_(@_)');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);

        $spreadsheet->getActiveSheet()->setShowGridlines(false);

        // Generate file name with start and end date
        $file_name = 'laporan_transaksi_' . str_replace('-', '', $tanggal) . '.xlsx';

        // Create the Excel writer and save the file
        $writer = new Xlsx($spreadsheet);
        $filename = $file_name;
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    } else {
        return redirect()->to('/');
    }
}



}