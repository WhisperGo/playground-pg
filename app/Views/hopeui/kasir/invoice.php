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
        body {
            padding: 20px; /* Tambahkan padding di seluruh area kiri, kanan, atas, dan bawah */
        }
        .header {
            text-align: center;
            margin-bottom: -60px;
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
        .subjudul {
            font-size: 20px;
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
        }
        h3 {
            margin-top: 10px; /* Mengurangi margin-top h3 */
        }
        p {
           color: !important;
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
        <h3 class="judul mt-2"><?=$title?></h3>
        <h4 class="subjudul "><?=$namaweb->nama_website?></h4>
    </div>

    <?php foreach ($jojo as $riz) { ?>
        <p class="text-center">Kasir : <?=$riz->username?></p>
        <p class="text-center">Tanggal : <?=$riz->created_at?></p>


        <p class="text-center">---------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>

        <div class="table-responsive-lg">
            <table>
                <thead>
                    <tr>
                        <th scope="col">Permainan</th>
                        <th class="text-center" scope="col">Durasi</th>
                        <th class="text-center" scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jojo2 as $data) { ?>
                        <tr>
                            <td><?=$data->nama_permainan?></td>
                            <td class="text-center"><?=$data->durasi?> jam</td>
                            <td class="text-center">Rp <?= number_format($data->subtotal, 0, ',', '.') ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class="total-label" colspan="2">Total :</td>
                        <td class="text-center">Rp <?=number_format($riz->total_harga, 0, ',', '.')?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php } ?>

    <p class="text-center mt-3">---------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
    <h4 class="text-center mb-3">Terima Kasih Atas Kunjungan Anda</h4>

</div>
</body>
</html>

<script>
    window.print()
</script>

