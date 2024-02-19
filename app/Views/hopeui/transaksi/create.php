<div class="conatiner-fluid content-inner mt-n5 py-0">
   <div>
      <div class="row">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title"><?=$subtitle?></h4>
                  <small class="text-danger text-sm">* Data yang Wajib Diisi</small>
               </div>
            </div>
            <div class="card-body">
               <div class="new-user-info">
                  <form action="<?= base_url('transaksi/aksi_create')?>" method="post" enctype="multipart/form-data">

                     <div class="row">
                        <div class="form-group">
                           <label class="form-label" for="fname">Nama Pelanggan <small class="text-danger text-sm">*</small></label>
                           <select class="choices form-select" id="nama_pelanggan" name="nama_pelanggan">
                            <option disabled selected>- Pilih -</option>
                            <?php 
                            foreach ($pelanggan as $p) {
                              ?>
                              <option value="<?=$p->PelangganID?>"><?= $p->NamaPelanggan?></option>
                           <?php } ?>
                        </select>
                     </div>

                     <div class="form-group">
                       <label class="form-label" for="fname">Tanggal Transaksi</label>
                       <input type="date" class="form-control" value="<?=date('Y-m-d')?>" disabled>
                    </div>

                    <div class="form-group">
                     <label class="form-label" for="fname">Jam Mulai <small class="text-danger text-sm">*</small></label>
                     <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" placeholder="Masukkan Tanggal Pengembalian" required>
                  </div>

                  <div class="form-group">
                     <label class="form-label" for="fname">Jam Selesai <small class="text-danger text-sm">*</small></label>
                     <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" placeholder="Masukkan Tanggal Pengembalian" required>
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