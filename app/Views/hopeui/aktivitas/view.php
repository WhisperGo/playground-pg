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
                                
                                // Tampilkan countdown jika durasi belum habis
                                echo '<td>';
                                if ($selisih == 0) {
                                    // Jika durasi sudah habis, tampilkan tombol untuk aksi_edit
                                    echo '<a href="' . base_url('transaksi/aksi_edit/' . $riz->id_transaksi) . '" class="btn btn-success my-1"><i class="fa-regular fa-arrows-rotate" style="color: #ffffff;"></i></a>';
                                } else {
                                    // Jika durasi belum habis, tampilkan countdown
                                    echo '<span id="countdown_' . $riz->id_transaksi . '"></span>';
                                }
                                echo '</td>';
                                
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
                        foreach ($jojo as $riz) {
                            // Tampilkan transaksi dengan status = 2 dan durasi sudah habis
                            if ($riz->status == 2) {
                                echo '<tr>';
                                echo '<td>' . $no++ . '</td>';
                                echo '<td>' . $riz->NamaPelanggan . '</td>';
                                echo '<td>Selesai</td>';
                                echo '</tr>';
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
    // Fungsi untuk memulai timer countdown
    function startCountdownTimer(id, endTime) {
        var timerId;

        function updateCountdown() {
            var now = new Date().getTime();
            var distance = endTime - now;

            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('countdown_' + id).innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

            if (distance <= 0) {
                clearInterval(timerId);
                document.getElementById('countdown_' + id).innerHTML = 'Selesai';

                // Kirim permintaan ke fungsi transaksi/aksi_edit
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "<?= base_url('transaksi/aksi_edit/') ?>" + id, true);
                xhr.onload = function() {
                    if (xhr.status == 200) {
                        // Refresh halaman untuk memperbarui tampilan
                        location.reload();
                    }
                };
                xhr.send();
            }
        }

        // Panggil fungsi updateCountdown setiap detik
        timerId = setInterval(updateCountdown, 1000);

        // Mulai countdown saat halaman dimuat
        updateCountdown();
    }

    <?php foreach ($masih_bermain as $riz): ?>
        var endTime_<?= $riz->id_transaksi ?> = new Date("<?= date('M d, Y H:i:s', $jam_selesai) ?>").getTime();
        startCountdownTimer(<?= $riz->id_transaksi ?>, endTime_<?= $riz->id_transaksi ?>);
    <?php endforeach; ?>
</script>

