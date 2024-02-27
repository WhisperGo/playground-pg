<?php

$db = \Config\Database::connect();
$builder = $db->table('website');
$namaweb = $builder->select('*')
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
        body {
            padding: 20px; /* Tambahkan padding di seluruh area kiri, kanan, atas, dan bawah */
        }
        .header {
            text-align: center;
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
        .title {
            font-weight: bold;
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
        p {
         color: #000000;
     }
     /* Tambahkan padding-right pada elemen td yang berisi TotalHarga */
     td.total-label {
        padding-right: 20px; /* Sesuaikan jarak horizontal dengan kebutuhan Anda */
    }
</style>
</head>

<body>
    <div class="header">
        <img src="<?=base_url('logo/logo_pdf/'.$logo->logo_pdf)?>">
        <h3 class="judul mb-3"><?=$namaweb->nama_website?></h3>
        <h3 class="title my-3"><?=$title?></h3>
        <p class="text-center">Alamat Kami : <?=$namaweb->komplek?>, <?=$namaweb->jalan?>, <?=$namaweb->kelurahan?>, <?=$namaweb->kecamatan?>, <?=$namaweb->kota?>, <?=$namaweb->kode_pos?>.</p>
        <p class="text-center">Hubungi Kami : <?=$namaweb->email_website?>, <?=$namaweb->no_telepon_website?>.</p>
    </div>

    <p class="text-center">---------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>

    <?php foreach ($jojo as $riz) { ?>
        <p class="text-center">Kasir : <?=$riz->username?></p>
        <p class="text-center">Tanggal Transaksi : <?=$riz->created_at?></p>

        <div class="table-responsive-lg">
            <table>
                <thead>
                    <tr>
                        <th scope="col">Permainan</th>
                        <th class="text-center" scope="col">Durasi</th>
                        <th class="text-center" scope="col">PPN</th>
                        <th class="text-center" scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jojo2 as $data) { ?>
                        <tr>
                            <td><?=$data->nama_permainan?></td>
                            <td class="text-center"><?=$data->durasi?> jam</td>
                            <td class="text-center"><?=$riz->persen_pajak?>%</td>
                            <td class="text-center">Rp <?= number_format($data->subtotal, 0, ',', '.') ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class="total-label" colspan="3">Total :</td>
                        <td class="text-center">Rp <?=number_format($riz->total_harga, 0, ',', '.')?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php } ?>

    <h3 class="judul text-center my-3">Terima Kasih Atas Kunjungan Anda</h3>
</div>
</body>
</html>

<script>
    window.print()
</script>