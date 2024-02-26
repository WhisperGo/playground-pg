<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">
        <!-- Cari Barang -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title"><i class="faj-button fa-solid fa-magnifying-glass"></i>Cari Permainan</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <select class="choices form-select" id="permainan" name="permainan">
                                <option disabled selected>- Pilih -</option>
                                <?php foreach ($permainan_list as $p) { ?>
                                    <option value="<?=$p->id_permainan?>"><?= $p->nama_permainan?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bagian Pembayaran -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title"><i class="faj-button fa-regular fa-cart-shopping"></i>Pembayaran</h4>

                        <!-- Form pembayaran -->
                        <form id="form-pembayaran" action="<?= base_url('kasir/aksi_create') ?>" method="post">
                            <div class="form-group row mt-3">
                                <label class="control-label col-sm-3 align-self-center mb-0">Tanggal :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly="readonly" name="tanggal" value="<?= date('d M Y') ?>" disabled style="margin-left: 20px;">
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label class="control-label col-sm-3 align-self-center mb-0" style="padding-right: 0px;">Pelanggan :</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="pelanggan" name="pelanggan" style="margin-left: 20px;" required>
                                        <option>- Pilih -</option>
                                        <?php foreach ($pelanggan_list as $p) { ?>
                                            <option value="<?= $p->PelangganID ?>"><?= $p->NamaPelanggan ?>, <?= $p->Email ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label class="control-label col-sm-3 align-self-center mb-0">Durasi :</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="durasi" style="margin-left: 20px;" min="1" max="9" required>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label class="control-label col-sm-3 align-self-center mb-0">Total :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="total_harga_input" readonly="readonly" disabled style="margin-left: 20px;">
                                </div>
                            </div>

                            <!-- Input hidden untuk menyimpan PermainanID -->
                            <input type="hidden" name="permainan_id[]" id="permainan_id_hidden">

                            <!-- Input hidden untuk menyimpan total harga -->
                            <input type="hidden" name="total_harga" id="total_harga_hidden">

                            <!-- Tombol submit -->
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Permainan</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data permainan akan ditambahkan di sini -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
    // Set nilai default untuk field durasi menjadi 1
    $('[name="durasi"]').val(1);

    // Panggil fungsi hitungSubtotal saat halaman dimuat dan saat nilai durasi berubah
    hitungSubtotal();
    hitungTotalHarga(); // Panggil fungsi hitungTotalHarga saat halaman dimuat

    // Fungsi untuk menghitung subtotal berdasarkan durasi yang dipilih
    function hitungSubtotal() {
        var durasi = parseInt($('[name="durasi"]').val());
        if (!isNaN(durasi)) { // Periksa apakah durasi adalah angka yang valid
            $('#datatable tbody tr').each(function() {
                var hargaText = $(this).find('td:eq(2)').text();
                var harga = parseFloat(hargaText.replace(/[^\d]/g, '')); // Ambil harga permainan dari kolom ke-3 dan ubah menjadi angka
                // Periksa apakah harga adalah angka yang valid
                if (!isNaN(harga)) {
                    var subtotal = durasi * harga; // Hitung subtotal berdasarkan durasi dan harga permainan
                    $(this).find('.subtotal').text('Rp ' + subtotal.toLocaleString('id-ID')); // Tampilkan subtotal dalam format mata uang
                } else {
                    $(this).find('.subtotal').text('Rp 0'); // Tampilkan subtotal sebagai 0 jika harga tidak valid
                }
            });
        } else {
            $('#datatable tbody tr .subtotal').text('Rp 0'); // Jika durasi tidak valid, set semua subtotal menjadi 0
        }
    }

    // Fungsi untuk menampilkan dan mengupdate total harga
    function hitungTotalHarga() {
        var total = 0;
        $('#datatable tbody tr').each(function() {
            var subtotalText = $(this).find('td:eq(3)').text(); // Ubah ke kolom keempat
            var subtotal = parseFloat(subtotalText.replace(/[^\d]/g, '')); // Ubah ke tipe data float
            // Periksa apakah subtotal adalah angka yang valid
            if (!isNaN(subtotal)) {
                total += subtotal;
            }
        });
        $('#total_harga_input').val('Rp ' + total.toLocaleString('id-ID')); // Tampilkan total harga dalam input readonly
    }

    // Hitung total harga
    function hitungTotalHargaSubmit() {
        var total = 0;
        $('#datatable tbody tr').each(function() {
            var subtotalText = $(this).find('td:eq(3)').text(); // Ubah ke kolom keempat
            var subtotal = parseFloat(subtotalText.replace(/[^\d]/g, '')); // Ubah ke tipe data float
            total += subtotal;
        });
        return total;
    }


    // Tangani perubahan pada input durasi
    $('[name="durasi"]').on('input', function() {
        hitungSubtotal(); // Panggil fungsi untuk menghitung subtotal
        hitungTotalHarga(); // Panggil fungsi untuk menghitung total harga
    });

    var table = $('#datatable').DataTable();

    // Fungsi untuk mengupdate nomor urut setelah penghapusan
    function updateNomorUrut() {
        $('#datatable tbody tr').each(function(index) {
            $(this).find('td:eq(0)').text(index + 1);
        });

        // Jika tabel kosong, hapus tulisan "1" yang muncul
        if (table.rows().count() == 0) {
            $('#datatable tbody').html('<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">No data available in table</td></tr>');
        }
    }

    // Variabel untuk nomor urut
    var nomorUrut = 1;

    // Fungsi untuk memformat harga sebagai mata uang dan menghapus .00 di belakangnya
    function formatCurrency(amount) {
        // Mengubah tipe data harga menjadi mata uang
        var currency = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(amount);
        // Menghapus .00 di belakangnya
        return currency.replace(/\,00$/, '');
    }

    // Tangani perubahan pada pilihan permainan
    $('#permainan').on('change', function() {
        var permainanId = $(this).val();

        // Periksa apakah data sudah ada dalam tabel
        var existingData = false;
        $('#datatable tbody tr').each(function() {
            var existingId = $(this).find('input[name="permainan_id[]"]').val();
            if (existingId === permainanId) {
                existingData = true;
                return false; // Keluar dari loop jika data sudah ditemukan
            }
        });

        if (!existingData) {
            // Kirim permintaan AJAX hanya jika data belum ada dalam tabel
            $.ajax({
                type: 'POST',
                url: 'kasir/tambah_ke_keranjang', // Ganti dengan URL yang sesuai
                data: {
                    permainan_id: permainanId
                },
                success: function(response) {
                    // Tambahkan item ke tabel pembayaran
                    var item = response.item;
                    var formattedHarga = formatCurrency(item.harga); // Format harga dengan tanda pemisah ribuan dan menghapus .00 di belakangnya
                    var newRow = [
                        nomorUrut++, // Nomor urut
                        item.nama_permainan,
                        formattedHarga, // Harga yang diperoleh dari respons AJAX
                        '<span class="subtotal"></span>', // Tambahkan tempat untuk subtotal
                        '<input type="hidden" name="permainan_id[]" value="' + permainanId + '">' + // Tambahkan input hidden untuk PermainanID
                        '<button class="btn btn-danger hapus-item"><i class="fa-solid fa-trash"></i></button>'
                    ];
                    table.row.add(newRow).draw(); // Tambahkan baris ke DataTables dan draw ulang tabel

                    // Hitung subtotal dan total harga setelah menambahkan baris baru
                    hitungSubtotal();
                    hitungTotalHarga();
                }
            });
        }
    });

    // Tangani klik pada tombol hapus item
    $('#datatable').on('click', '.hapus-item', function() {
        var row = $(this).closest('tr');
        table.row(row).remove().draw(); // Hapus baris dari DataTables
        updateNomorUrut(); // Perbarui nomor urut setelah penghapusan

        // Hitung dan tampilkan total harga setelah menghapus item
        hitungTotalHarga();
    });

    // Tangani klik tombol submit
    $('#form-pembayaran').on('submit', function(e) {
        e.preventDefault(); // Mencegah perilaku default formulir

        // Persiapkan array untuk menyimpan data
        var dataToSend = [];

        // Iterasi melalui setiap baris tabel
        $('#datatable tbody tr').each(function() {
            var rowData = {};
            // Ambil data dari setiap input dan select dalam baris, kecuali input dengan type submit
            $(this).find('input, select').each(function() {
                var columnName = $(this).attr('name');
                var columnValue = $(this).val();
                rowData[columnName] = columnValue;
            });

            // Ambil PermainanID dari input hidden
            var permainanId = $(this).find('input[name="permainan_id[]"]').val();

            // Tambahkan PermainanID ke dalam rowData
            rowData['permainan_id'] = permainanId;

            // Ambil nilai subtotal dari kolom keempat dan hapus simbol "Rp" serta tanda pemisah ribuan
            var subtotal = $(this).find('td:eq(3)').text().replace('Rp ', '').replace(/\./g, '');
            rowData['subtotal'] = subtotal;

            // Tambahkan data baris ke array
            dataToSend.push(rowData);
        });

        // Tambahkan data ke input tersembunyi sebelum mengirimkan formulir
        $('#form-pembayaran').append('<input type="hidden" name="data_table" value=\'' + JSON.stringify(dataToSend) + '\' />');

        // Hitung total harga dan tambahkan ke dalam data1 sebelum mengirimkan formulir
        var totalHarga = hitungTotalHargaSubmit();
        $('#form-pembayaran').append('<input type="hidden" name="total_harga" value="' + totalHarga + '" />');

        // Lanjutkan dengan pengiriman formulir
        this.submit();
    });
});


</script>