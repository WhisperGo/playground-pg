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
        <img src="<?=base_url('logo/logo_pdf/logo_pdf_contoh.svg')?>"> 
        <h3 class="judul mt-2"><?=$title?></h3>
        <h4 class="subjudul ">GT Kasir</h4>
    </div>

    <?php foreach ($jojo as $riz) { ?>
        <p>Kasir : <?=$riz->username?></p>
        <p>Tanggal : <?=$riz->created_at?></p>


        <p>---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>

        <div class="table-responsive-lg">
            <table>
                <thead>
                    <tr>
                        <th scope="col">Barang</th>
                        <th class="text-center" scope="col">Qty</th>
                        <th class="text-center" scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jojo2 as $data) { ?>
                        <tr>
                            <td><?=$data->NamaProduk?></td>
                            <td class="text-center"><?=$data->JumlahProduk?></td>
                            <td class="text-center">Rp <?= number_format($data->Subtotal, 0, ',', '.') ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class="total-label" colspan="2">Total :</td>
                        <td class="text-center">Rp <?=number_format($riz->TotalHarga, 0, ',', '.')?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php } ?>

    <p class="mt-3">---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
    <h4 class="text-center mb-3">Terima Kasih Atas Kunjungan Anda</h4>

</div>
</body>
</html>

<script>
    window.print()
</script>
