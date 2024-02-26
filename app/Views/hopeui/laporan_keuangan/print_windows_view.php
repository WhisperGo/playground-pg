<?php

$db = \Config\Database::connect();
$builder = $db->table('website');
$namaweb = $builder->select('nama_website')
->where('deleted_at', null)
->get()
->getRow();

$builder = $db->table('website');
$logo = $builder->select('*')
->where('deleted_at', null)
->get()
->getRow();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <style>
        /* CSS untuk cetak */
        @media print {
            /* Sembunyikan tombol cetak */
            .no-print {
                display: none !important;
            }
        }
        .header {
            text-align: center;
            margin-bottom: -140px;
            margin-top: 20px;
        }
        .header img {
            width: 100px; /* Atur ukuran logo sesuai kebutuhan */
            height: auto;
        }
        .judul {
            font-size: 24px;
            font-weight: bold;
        }
        .alamat {
            font-size: 14px;
        }
        table {
            width: 90%;
            border-collapse: collapse;
            margin: 0 auto; /* Membuat tabel berada di tengah */
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            color: #000000;
        }
        h3 {
            margin-top: 10px; /* Mengurangi margin-top h3 */
        }
        .jumlah-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .jumlah-item {
            flex: 1;
            text-align: center;
        }
        p {
            color: #000000;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="<?=base_url('logo/logo_pdf/'.$logo->logo_pdf)?>">
        <h3 class="judul mt-2"><?=$namaweb->nama_website?></h3>
    </div>

    <h3 class="text-center mb-4"><?= $title ?></h3>
    
    <?php if ($awal && $akhir) : ?>
        <p class="text-center">Laporan detail transaksi dalam rentang tanggal berikut:</p>
        <p class="text-center">Periode : <?= date('d M Y', strtotime($awal)) . ' - ' . date('d M Y', strtotime($akhir))?></p>
    <?php elseif ($tanggal) : ?>
       <p class="text-center">Laporan detail transaksi pada tanggal berikut:</p>
       <p class="text-center">Periode : <?= date('d M Y', strtotime($tanggal))?></p>
   <?php endif; ?>


   <!-- Table Section -->
   <div class="table-responsive">
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Uang Masuk</th>
                <th>Uang Keluar</th>
                <th>Selisih</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;?>
            <?php $total_uang_masuk = 0; ?>
            <?php foreach ($transaksi as $trx) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= date('d M Y H:i:s', strtotime($trx->created_at)) ?></td>
                    <td>Rp <?= number_format($trx->total_harga, 2, ',', '.') ?></td>
                    <td>0</td>
                    <td>Rp <?= number_format($trx->total_harga, 2, ',', '.') ?></td>
                </tr>
                <?php $total_uang_masuk += $trx->total_harga; ?>
            <?php endforeach; ?>

            <?php foreach ($pengeluaran as $peng) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= date('d M Y H:i:s', strtotime($peng->created_at)) ?></td>
                    <td>0</td>
                    <td>Rp <?= number_format($peng->jumlah_pengeluaran, 2, ',', '.') ?></td>
                    <td>Rp <?= number_format($peng->jumlah_pengeluaran, 2, ',', '.') ?></td>
                </tr>
                <?php $total_uang_keluar += $peng->jumlah_pengeluaran; ?>
            <?php endforeach; ?>
        </tbody>

        <tfoot> 
            <tr>
                <td colspan="2"><strong>Total :</strong></td>
                <td>Rp <?= number_format($total_uang_masuk, 2, ',', '.') ?></td>
                <td>Rp <?= number_format($total_uang_keluar, 2, ',', '.') ?></td>
                <td>Rp <?= number_format($total_uang_masuk - $total_uang_keluar, 2, ',', '.') ?></td>
            </tr>
        </tfoot>

    </table>
</div>

<br>
<br>


</body>
</html>

<script>
  window.print();
</script>

