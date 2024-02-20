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
                                <th>Permainan</th>
                                <th>Durasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $masih_bermain = []; // Array untuk transaksi yang masih berjalan
                            foreach ($jojo as $riz) {
                                // Periksa apakah status transaksi adalah 1 (Masih Bermain)
                                if ($riz->status == 1) {
                                    $tanggal_transaksi = strtotime($riz->tanggal_transaksi);
                                    $jam_mulai = strtotime($riz->jam_mulai);
                                    $jam_selesai = strtotime($riz->jam_selesai);

                                    // Menggabungkan tanggal dan waktu mulai transaksi
                                    $waktu_mulai = strtotime(date("Y-m-d", $tanggal_transaksi) . " " . date("H:i:s", $jam_mulai));
                                    // Menggabungkan tanggal dan waktu selesai transaksi
                                    $waktu_selesai = strtotime(date("Y-m-d", $tanggal_transaksi) . " " . date("H:i:s", $jam_selesai));

                                    // Periksa apakah transaksi masih berjalan berdasarkan waktu sekarang
                                    if ($waktu_mulai <= time() && time() <= $waktu_selesai) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $riz->NamaPelanggan; ?></td>
                                            <td><?php echo $riz->nama_permainan; ?></td>

                                            <?php
                                            // Hitung durasi transaksi yang masih berjalan
                                            $durasi = $waktu_selesai - time();
                                            $hours = floor($durasi / 3600);
                                            $minutes = floor(($durasi % 3600) / 60);
                                            $seconds = $durasi % 60;

                                            // Format angka jam, menit, dan detik agar menampilkan dua digit
                                            $hoursFormatted = str_pad($hours, 2, '0', STR_PAD_LEFT);
                                            $minutesFormatted = str_pad($minutes, 2, '0', STR_PAD_LEFT);
                                            $secondsFormatted = str_pad($seconds, 2, '0', STR_PAD_LEFT);
                                            ?>

                                            <td><span id="countdown_<?php echo $riz->id_transaksi; ?>"><?php echo $hoursFormatted . ":" . $minutesFormatted . ":" . $secondsFormatted; ?></span></td>

                                            <td><a href="<?php echo base_url('transaksi/aksi_edit/' . $riz->id_transaksi) ?>" class="btn btn-success my-1"><i class="fa-regular fa-arrows-rotate" style="color: #ffffff;"></i></a></td>
                                            
                                        </tr>
                                        <?php
                                        $masih_bermain[] = $riz;
                                    }
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
                                <th>Permainan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($jojo as $riz) {
                            // Konversi tanggal transaksi ke format timestamp
                                $tanggal_transaksi = strtotime($riz->tanggal_transaksi);
                            // Konversi tanggal hari ini ke format timestamp
                                $today = strtotime(date("Y-m-d"));

                            // Periksa apakah tanggal transaksi sama dengan tanggal hari ini
                                if ($riz->status == 2 && $tanggal_transaksi == $today) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $riz->NamaPelanggan; ?></td>
                                        <td><?php echo $riz->nama_permainan; ?></td>
                                        <td>Selesai</td>
                                    </tr>
                                    <?php
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
        <?php foreach ($masih_bermain as $riz): ?>
            var endTime_<?= $riz->id_transaksi ?> = <?= $waktu_selesai ?> * 1000; // Convert to milliseconds
            startCountdownTimer(<?= $riz->id_transaksi ?>, endTime_<?= $riz->id_transaksi ?>);
        <?php endforeach; ?>

            // Fungsi untuk memulai timer countdown
        function startCountdownTimer(id, endTime) {
            var timerId;

            function updateCountdown() {
                var now = new Date().getTime();
                var distance = endTime - now;

                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Format angka jam, menit, dan detik agar menampilkan dua digit
                var hoursFormatted = hours.toString().padStart(2, '0');
                var minutesFormatted = minutes.toString().padStart(2, '0');
                var secondsFormatted = seconds.toString().padStart(2, '0');

                document.getElementById('countdown_' + id).innerHTML = hoursFormatted + ":" + minutesFormatted + ":" + secondsFormatted;
            }

        // Panggil fungsi updateCountdown setiap detik
            timerId = setInterval(updateCountdown, 1000);

        // Mulai countdown saat halaman dimuat
            updateCountdown();
        }
    </script>
