<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <style>
        .header {
            text-align: center;
            margin-bottom: 20px;
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
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        h3 {
            margin-top: 10px;
            text-align: center;
        }
        .custom-paragraph {
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyNS40LjEsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9IjAgMCAxMTUuNCAxMjAuNSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMTE1LjQgMTIwLjU7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+DQoJLnN0MHtmaWxsLXJ1bGU6ZXZlbm9kZDtjbGlwLXJ1bGU6ZXZlbm9kZDtmaWxsOiNGNEExMEM7fQ0KCS5zdDF7ZmlsbC1ydWxlOmV2ZW5vZGQ7Y2xpcC1ydWxlOmV2ZW5vZGQ7ZmlsbDojNDM1RUJFO30NCgkuc3Qye2ZpbGw6I0Y0QTEwQzt9DQoJLnN0M3tmaWxsOiM0MzVFQkU7fQ0KPC9zdHlsZT4NCjxnPg0KCTxnPg0KCQk8cGF0aCBjbGFzcz0ic3QwIiBkPSJNNjEuMiw4Ni41SDkzdjEwLjJIODIuMnYyMy44SDcxLjlWOTYuN0g2MS4yVjg2LjV6Ii8+DQoJPC9nPg0KCTxnPg0KCQk8cGF0aCBjbGFzcz0ic3QxIiBkPSJNNTQuMiw4Ni42djEwLjJIMzguOGMwLDAtNS41LDAuNy01LjUsNi43YzAsNiw1LjMsNi45LDUuMyw2LjloNi41di02LjZoOC45YzAsNS42LDAsMTEuMiwwLDE2LjhIMzcuOA0KCQkJYzAsMC03LjQtMC43LTExLjQtNS44cy00LTEwLjktNC0xMC45cy0wLjUtNy43LDUuMi0xM2MzLjItMyw2LjktNCw5LjYtNC4yaDMuNUw1NC4yLDg2LjZMNTQuMiw4Ni42eiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KCTxwb2x5Z29uIGNsYXNzPSJzdDIiIHBvaW50cz0iMzAuNCwzNS4yIDM4LjYsMzUuMiAzOC42LDY1LjUgNDkuNiw1NC40IDQ5LjYsMjQuMiAxOS40LDI0LjIgMTkuNCw4NC42IDMwLjQsNzMuNiAJIi8+DQoJPHBvbHlnb24gY2xhc3M9InN0MyIgcG9pbnRzPSI3OS45LDU0LjQgNDkuNiw1NC40IDQ5LjYsNTQuNCAzOC42LDY1LjUgMzguNiw2NS41IDY4LjgsNjUuNSA2OC44LDczLjYgMzAuNCw3My42IDMwLjQsNzMuNiANCgkJMTkuNCw4NC42IDE5LjQsODQuNyA3OS45LDg0LjcgCSIvPg0KCTxwb2x5Z29uIGNsYXNzPSJzdDMiIHBvaW50cz0iODQuOSwxMS4xIDg0LjksMTEuMSA4NC45LDMyLjMgNjMuNywzMi4zIDYzLjcsMzIuMiA1Mi43LDQzLjMgNTIuNyw0My4zIDk2LDQzLjMgOTYsMCA5NiwwIAkiLz4NCgk8cG9seWdvbiBjbGFzcz0ic3QyIiBwb2ludHM9IjYzLjcsMTEuMSA4NC45LDExLjEgOTYsMCA1Mi43LDAgNTIuNyw0My4zIDYzLjcsMzIuMiAJIi8+DQo8L2c+DQo8L3N2Zz4NCg==">
        <h3 class="judul mt-2">GT Kasir</h3>
    </div>

    <h3 class="text-center mb-4"><?= $title ?></h3>

    <div class="custom-paragraph">
    <?php if ($awal && $akhir) : ?>
        <p class="text-center">Laporan detail penjualan dalam rentang tanggal berikut:</p>
        <p class="text-center">Periode : <?= date('d M Y', strtotime($awal)) . ' - ' . date('d M Y', strtotime($akhir))?></p>
    <?php elseif ($tanggal) : ?>
       <p class="text-center">Laporan detail penjualan pada tanggal berikut:</p>
       <p class="text-center">Periode : <?= date('d M Y', strtotime($tanggal))?></p>
   <?php endif; ?>
   </div>

   <div class="table-responsive">
    <table border="1">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Produk</th>
                <th>Jumlah Produk</th>
                <th>Subtotal</th>
                <th>Kasir</th>
                <th>Tanggal Penjualan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($penjualan as $riz) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $riz->NamaProduk ?></td>
                    <td><?= $riz->JumlahProduk ?> buah</td>
                    <td>Rp <?= number_format($riz->Subtotal, 2, ',', '.') ?></td>
                    <td><?= $riz->username ?></td>
                    <td><?= date('d F Y, H:i', strtotime($riz->created_at_detailpenjualan)) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="jumlah-container mt-5">
    <div class="jumlah-item">
        <p>Jumlah penjualan: <?= count($penjualan) ?></p>
    </div>
</div>

</div>
</body>
</html>
