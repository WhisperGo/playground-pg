<div class="conatiner-fluid content-inner mt-n5 py-0">
   <div>
      <div class="row">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title"><?=$subtitle?></h4>
               </div>
            </div>
            <div class="card-body">
               <div class="new-user-info">
                  <form action="<?= base_url('durasi_bermain/aksi_edit')?>" method="post" enctype="multipart/form-data">

                     <input type="hidden" name="id" value="<?php echo $jojo->id_transaksi ?>">

                     <div class="row">

                     <div class="form-group">
                        <label class="form-label" for="fname">Jam Selesai</label>
                        <input type="text" class="form-control" id="jam_selesai" name="jam_selesai" placeholder="Masukkan Jam Selesai" value="<?php echo $jojo->jam_selesai ?>" disabled>
                     </div>

                     <div class="form-group">
                        <label class="form-label" for="fname">Stok Buku</label>
                        <input type="text" class="form-control" id="stok_buku" name="stok_buku" placeholder="Masukkan Stok Buku" value="<?php echo $jojo->stok_buku ?>" required>
                     </div>

                  </div>
                  <a href="javascript:history.back()" class="btn btn-danger mt-4">Cancel</a>
                  <button type="submit" class="btn btn-primary mt-4">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
</div>