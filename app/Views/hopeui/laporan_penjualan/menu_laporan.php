<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">

        <!-- Sesuaikan tanggal awal dan akhir -->
        <div class="col-sm-12 col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title"><?=$subtitle?></h4>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" id="printFormAwalAkhir" action="<?= base_url('penjualan/export') ?>">
                        <div class="form-group">
                            <label class="form-label" for="email">Tanggal Awal:</label>
                            <input type="date" class="form-control" id="awal" name="awal" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="pwd">Tanggal Akhir:</label>
                            <input type="date" class="form-control" id="akhir" name="akhir" required>
                        </div>
                        <input type="hidden" name="aksi" id="aksiAwalAkhir" value="aksi_print">
                        <button type="submit" onclick="setAction('windows')" class="btn btn-primary mt-3"><i class="faj-button fa fa-print"></i>Windows Print</button>
                        <button type="submit" onclick="setAction('excel')" class="btn btn-success mt-3"><i class="faj-button fa fa-file-excel"></i>Excel</button>
                        <button type="submit" onclick="setAction('pdf')" class="btn btn-danger mt-3"><i class="faj-button fa-solid fa-file-pdf"></i>PDF</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sesuaikan tanggalnya -->
        <div class="col-sm-12 col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title"><?=$subtitle?></h4>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" id="printFormTanggal" action="<?= base_url('penjualan/export') ?>">
                        <div class="form-group">
                            <label class="form-label" for="email">Tanggal :</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <input type="hidden" name="aksi" id="aksiTanggal" value="aksi_print_per_hari">
                        <button type="submit" onclick="setAction('windows_per_hari')" class="btn btn-primary mt-3"><i class="faj-button fa fa-print"></i>Windows Print</button>
                        <button type="submit" onclick="setAction('excel_per_hari')" class="btn btn-success mt-3"><i class="faj-button fa fa-file-excel"></i>Excel</button>
                        <button type="submit" onclick="setAction('pdf_per_hari')" class="btn btn-danger mt-3"><i class="faj-button fa-solid fa-file-pdf"></i>PDF</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function setAction(action) {
        if (action === 'windows' || action === 'excel' || action === 'pdf') {
            document.getElementById("aksiAwalAkhir").value = "aksi_print_" + action;
            document.getElementById("printFormAwalAkhir").action = "<?= base_url('penjualan/export') ?>_" + action;
        } else if (action === 'windows_per_hari' || action === 'excel_per_hari' || action === 'pdf_per_hari'){
            document.getElementById("aksiTanggal").value = "aksi_print_per_hari";
            document.getElementById("printFormTanggal").action = "<?= base_url('penjualan/export') ?>_" + action;
        }
    }
</script>
