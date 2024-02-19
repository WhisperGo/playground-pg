<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">

        <!-- Masih Bermain-->
        <div class="col-sm-12 col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title"><?= $subtitle1 ?></h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Anak</th>
                                    <th>Durasi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                        $masih_bermain = []; // Array untuk transaksi yang masih berjalan
                        foreach ($jojo as $riz) {
                            $jam_selesai = strtotime($riz->jam_selesai);
                            $sekarang = time();
                            $selisih = $jam_selesai - $sekarang;

                            if ($selisih > 0) {
                                echo '<tr>';
                                echo '<td>' . $no++ . '</td>';
                                echo '<td>' . $riz->NamaPelanggan . '</td>';
                                echo '<td><span id="countdown_' . $riz->id_transaksi . '"></span></td>';
                                echo '</tr>';
                                $masih_bermain[] = $riz; // Tambahkan transaksi yang masih berjalan ke dalam array
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Selesai Bermain -->
<div class="col-sm-12 col-lg-6">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title"><?= $subtitle2 ?></h4>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Anak</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        $selesai_bermain = []; // Array untuk transaksi yang telah selesai
                        foreach ($jojo as $riz) {
                            $jam_selesai = strtotime($riz->jam_selesai);
                            $sekarang = time();
                            $selisih = $jam_selesai - $sekarang;

                            if ($selisih <= 0) {
                                echo '<tr>';
                                echo '<td>' . $no++ . '</td>';
                                echo '<td>' . $riz->NamaPelanggan . '</td>';
                                // Tambahkan teks "Selesai" sebagai ganti kolom Durasi
                                echo '<td>Selesai</td>';
                                echo '</tr>';
                                $selesai_bermain[] = $riz; // Tambahkan transaksi yang telah selesai ke dalam array
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    function updateCountdown(id, endTime) {
        var now = new Date().getTime();
        var distance = endTime - now;

        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById('countdown_' + id).innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

        if (distance < 0) {
            clearInterval(timer);
            document.getElementById('countdown_' + id).innerHTML = 'Selesai';
        }
    }

    <?php foreach ($masih_bermain as $riz): ?>
        var endTime_<?= $riz->id_transaksi ?> = new Date("<?= date('M d, Y H:i:s', $jam_selesai) ?>").getTime();
        var timer_<?= $riz->id_transaksi ?> = setInterval(function() {
            updateCountdown(<?= $riz->id_transaksi ?>, endTime_<?= $riz->id_transaksi ?>);
        }, 1000);
    <?php endforeach; ?>
</script>


