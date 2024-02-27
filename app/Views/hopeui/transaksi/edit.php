<div class="conatiner-fluid content-inner mt-n5 py-0">
   <div>
      <div class="row">
         <div class="card">
          <div class="card-header">
            <h4 class="card-title"><i class="faj-button fa-regular fa-cart-shopping"></i><?= $subtitle ?></h4>
            <p><small class="text-danger text-sm">*</small> Catatan : Pajak PPN sebesar <?= $pajak_ppn->persen_pajak ?>%</p>

         </div>

         <div class="card-body">
            <form id="form-pembayaran" action="<?= base_url('transaksi/aksi_edit') ?>" method="post">
               <input type="hidden" name="id" value="<?php echo $jojo->id_transaksi ?>">
               <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label">Tanggal :</label>
                    <input type="text" class="form-control" readonly="readonly" value="<?= date('d M Y') ?>" disabled>
                 </div>

                 <div class="form-group">
                  <label class="form-label" for="fname">Jam Selesai</label>
                  <input type="text" class="form-control" name="jam_selesai" value="<?php echo $jojo->jam_selesai ?>" readonly="readonly">
               </div>

               <div class="form-group">
                 <label class="control-label">Pelanggan :</label>
                 <input type="text" class="form-control" readonly="readonly" value="<?= $jojo->NamaPelanggan ?>" disabled>
              </div>

              <div class="form-group">
                 <label class="control-label">Durasi :</label>
                 <select class="form-select" id="durasi" name="durasi" required>
                   <option>- Pilih -</option>
                   <?php foreach ($paket_list as $p) { ?>
                     <option value="<?= $p->id_paket ?>" data-durasi="<?= $p->durasi_paket ?>"><?= $p->nama_paket ?></option>
                  <?php } ?>
               </select>
            </div>
         </div>

         <div class="col-sm-6">
            <div class="form-group">
               <label class="control-label">Total Lama :</label>
               <input type="text" class="form-control" id="total_harga_lama" name="total_harga_lama" readonly="readonly" value="Rp <?= number_format($jojo->total_harga, 0, ',', '.') ?>" disabled>
            </div>

            <div class="form-group">
               <label class="control-label">Total Baru :</label>
               <input type="text" class="form-control" id="total_harga_baru" name="total_harga_baru" readonly="readonly" disabled>
            </div>

            <div class="form-group">
              <label class="control-label">Bayar :</label>
              <input type="text" class="form-control" id="bayar_input" name="bayar_baru" required>
           </div>

           <div class="form-group">
              <label class="control-label">Kembalian :</label>
              <input type="text" class="form-control" id="kembalian_input" name="kembalian_baru" readonly="readonly" disabled>
           </div>

           <!-- Input hidden untuk menyimpan pajak -->
           <input type="hidden" name="pajak" value="<?= $pajak_ppn->id_pajak ?>">

           <input type="hidden" name="total_harga" value="<?php echo $jojo->total_harga ?>">
           <input type="hidden" name="bayar_lama" value="<?php echo $jojo->bayar ?>">
           <input type="hidden" name="kembalian_lama" value="<?php echo $jojo->kembalian ?>">

        </div>
     </div>

     <!-- Tombol submit -->
     <a href="javascript:history.back()" class="btn btn-danger mt-4">Cancel</a>
     <button type="submit" class="btn btn-primary mt-4">Submit</button>
  </form>
</div>
</div>
</div>
</div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
        // Ambil elemen-elemen yang diperlukan
    var durasiSelect = document.getElementById('durasi');
    var totalHargaLamaInput = document.getElementById('total_harga_lama');
    var totalHargaBaruInput = document.getElementById('total_harga_baru');
    var bayarInput = document.getElementById('bayar_input');
    var kembalianInput = document.getElementById('kembalian_input');

        // Set nilai default untuk Total Baru dan Kembalian
    totalHargaBaruInput.value = 'Rp 0';
    kembalianInput.value = 'Rp 0';

        // Ketika pilihan durasi berubah
    durasiSelect.addEventListener('change', function() {
            // Ambil durasi paket yang dipilih
      var durasi = parseInt(this.options[this.selectedIndex].getAttribute('data-durasi'));
            // Ambil total harga lama dari input
      var totalHargaLama = parseInt(totalHargaLamaInput.value.replace(/\D/g, ''));
            // Hitung total harga baru berdasarkan durasi paket
      var totalHargaBaru = durasi * totalHargaLama;
            // Tampilkan total harga baru
      totalHargaBaruInput.value = 'Rp ' + totalHargaBaru.toLocaleString();
   });

        // Ketika input pembayaran berubah
    bayarInput.addEventListener('input', function() {
            // Ambil jumlah pembayaran
      var bayar = parseFloat($('#bayar_input').val());
      var kembalian;
            // Ambil total harga baru
      var totalHargaBaru = parseInt(totalHargaBaruInput.value.replace(/\D/g, ''));

            // Periksa apakah pembayaran adalah angka yang valid
      if (!isNaN(bayar)) {
        kembalian = bayar - totalHargaBaru;
     } else {
                // Set default kembalian menjadi Rp 0 jika pembayaran tidak valid atau tidak diisi
        kembalian = 0;
     }

            // Tampilkan kembalian
     kembalianInput.value = 'Rp ' + kembalian.toLocaleString();
  });

        // Tangani klik tombol submit
    document.getElementById('form-pembayaran').addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah perilaku default formulir

            // Hitung total harga baru
            var totalHargaBaru = parseInt(totalHargaBaruInput.value.replace(/\D/g, ''));
            // Hitung kembalian
            var kembalian = parseFloat(kembalianInput.value.replace(/[^\d]/g, ''));
            var bayar = parseFloat($('#bayar_input').val());

            // Tambahkan data ke input tersembunyi sebelum mengirimkan formulir
            this.insertAdjacentHTML('beforeend', '<input type="hidden" name="total_harga_baru" value="' + totalHargaBaru + '" />');
            this.insertAdjacentHTML('beforeend', '<input type="hidden" name="kembalian_baru" value="' + kembalian + '" />');
            this.insertAdjacentHTML('beforeend', '<input type="hidden" name="bayar_baru" value="' + bayar + '" />');

            // Lanjutkan dengan pengiriman formulir
            this.submit();
         });
 });
</script>