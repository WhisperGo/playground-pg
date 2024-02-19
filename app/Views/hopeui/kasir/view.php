<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">
        <!-- Cari Barang -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title"><i class="faj-button fa-solid fa-magnifying-glass"></i>Cari Produk</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <select class="choices form-select" id="produk" name="produk">
                                <option disabled selected>- Pilih -</option>
                                <?php foreach ($produk_list as $p) { ?>
                                    <option value="<?=$p->ProdukID?>"><?= $p->NamaProduk?></option>
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
                                <label class="control-label col-sm-3 align-self-center mb-0" style="padding-right: 0px;">Customer :</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="pelanggan" name="pelanggan" required style="margin-left: 20px;" required>
                                        <option>- Pilih -</option>
                                        <?php foreach ($pelanggan_list as $p) { ?>
                                            <option value="<?= $p->PelangganID ?>"><?= $p->NamaPelanggan ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Input hidden untuk menyimpan ProdukID -->
                            <input type="hidden" name="produk_id[]" id="produk_id_hidden">

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
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data produk akan ditambahkan di sini -->
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
        // Inisialisasi DataTables di luar AJAX
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
            var currency = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(amount);
            // Menghapus .00 di belakangnya
            return currency.replace(/\,00$/, '');
        }

        // Hitung total harga
        function hitungTotalHarga() {
            var total = 0;
            $('#datatable tbody tr').each(function() {
                var subtotalText = $(this).find('.subtotal').text();
                var subtotal = parseFloat(subtotalText.replace(/[^\d]/g, ''));
                total += subtotal;
            });
            return total;
        }

        // Tampilkan total harga
        function tampilkanTotalHarga(total) {
            $('#total_harga_hidden').val(total);
        }

        // Tangani perubahan pada pilihan produk
        $('#produk').on('change', function() {
            var produkId = $(this).val();

            // Kirim permintaan AJAX
            $.ajax({
                type: 'POST',
                url: 'kasir/tambah_ke_keranjang', // Ganti dengan URL yang sesuai
                data: { produk_id: produkId },
                success: function(response) {
                    // Tambahkan item ke tabel pembayaran
                    var item = response.item;
                    var formattedHarga = formatCurrency(item.harga); // Format harga dengan tanda pemisah ribuan dan menghapus .00 di belakangnya
                    var newRow = [
                        nomorUrut++, // Nomor urut
                        item.nama_produk,
                        formattedHarga, // Harga yang diperoleh dari respons AJAX
                        '<input type="number" class="form-control jumlah" value="1" min="1" name="jumlah" id="jumlah">', // Tambahkan input jumlah
                        '<span class="subtotal"></span>', // Tambahkan tempat untuk subtotal
                        '<input type="hidden" name="produk_id[]" value="' + produkId + '">' + // Tambahkan input hidden untuk ProdukID
                        '<button class="btn btn-danger hapus-item"><i class="fa-solid fa-trash"></i></button>'
                        ];
                    table.row.add(newRow).draw(); // Tambahkan baris ke DataTables dan draw ulang tabel

                    // Hitung subtotal untuk baris yang baru ditambahkan
                    var row = table.row($(table.rows().nodes()).last()).node();
                    var hargaText = $(row).find('td:eq(2)').text(); // Ambil harga dari kolom ke-3 (indeks dimulai dari 0)
                    var jumlah = $(row).find('.jumlah').val();
                    var harga = parseFloat(hargaText.replace(/[^\d]/g, '')); // Hapus karakter non-angka dari harga dan konversi ke angka
                    var subtotal = jumlah * harga;
                    var formattedSubtotal = 'Rp ' + subtotal.toLocaleString('id-ID');
                    $(row).find('.subtotal').text(formattedSubtotal); // Update kolom subtotal dengan subtotal yang baru

                    // Hitung dan tampilkan total harga setelah menambahkan produk baru
                    var totalHarga = hitungTotalHarga();
                    tampilkanTotalHarga(totalHarga);
                }
            });
        });

        // Tangani perubahan jumlah produk
        $('#datatable').on('change', '.jumlah', function() {
            var row = $(this).closest('tr');
            var jumlah = $(this).val();
            var hargaText = row.find('td:eq(2)').text(); // Ambil harga dari kolom ke-3 (indeks dimulai dari 0)

            // Hapus karakter non-angka dari harga dan konversi ke angka
            var harga = parseFloat(hargaText.replace(/[^\d]/g, ''));

            // Hitung subtotal
            var subtotal = jumlah * harga;

            // Format subtotal menjadi mata uang rupiah
            var formattedSubtotal = 'Rp ' + subtotal.toLocaleString('id-ID');

            // Update kolom subtotal dengan subtotal yang baru
            row.find('.subtotal').text(formattedSubtotal);

            // Hitung dan tampilkan total harga setelah perubahan jumlah produk
            var totalHarga = hitungTotalHarga();
            tampilkanTotalHarga(totalHarga);
        });

        // Tangani klik pada tombol hapus item
        $('#datatable').on('click', '.hapus-item', function() {
            var row = $(this).closest('tr');
            table.row(row).remove().draw(); // Hapus baris dari DataTables
            updateNomorUrut(); // Perbarui nomor urut setelah penghapusan

            // Hitung dan tampilkan total harga setelah menghapus item
            var totalHarga = hitungTotalHarga();
            tampilkanTotalHarga(totalHarga);
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

                // Ambil ProdukID dari input hidden
                var produkId = $(this).find('input[name="produk_id[]"]').val();

                // Tambahkan ProdukID ke dalam rowData
                rowData['produk_id'] = produkId;

                // Ambil nama produk dari kolom kedua dan harga dari kolom ketiga
                var namaProduk = $(this).find('td:eq(1)').text();
                var harga = $(this).find('td:eq(2)').text();

                // Tambahkan nilai item.nama_produk dan formattedHarga ke dalam rowData
                rowData['nama_produk'] = namaProduk;
                rowData['formattedHarga'] = harga;

                // Ambil nilai subtotal dari kolom keempat dan hapus simbol "Rp" serta tanda pemisah ribuan
                var subtotal = $(this).find('td:eq(4)').text().replace('Rp ', '').replace(/\./g, '');
                rowData['subtotal'] = subtotal;

                // Tambahkan data baris ke array
                dataToSend.push(rowData);
            });

            // Tambahkan data ke input tersembunyi sebelum mengirimkan formulir
            $('#form-pembayaran').append('<input type="hidden" name="data_table" value=\'' + JSON.stringify(dataToSend) + '\' />');

            // Hitung total harga dan tambahkan ke dalam data1 sebelum mengirimkan formulir
            var totalHarga = hitungTotalHarga();
            $('#form-pembayaran').append('<input type="hidden" name="total_harga" value="' + totalHarga + '" />');

            // Lanjutkan dengan pengiriman formulir
            this.submit();
        });
    });
</script>
