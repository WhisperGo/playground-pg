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
                  <form action="<?= base_url('transaksi/aksi_edit')?>" method="post" enctype="multipart/form-data">

                     <input type="hidden" name="id" value="<?php echo $jojo->id_transaksi ?>">

                     <div class="row">
                        <div class="form-group">
                           <label class="form-label" for="fname">Jam Selesai</label>
                           <input type="text" class="form-control" placeholder="Masukkan Judul Buku" value="<?php echo $jojo->jam_selesai ?>" readonly="readonly" disabled>
                           <input type="hidden" name="jam_selesai" value="<?php echo $jojo->jam_selesai ?>">
                        </div>


                        <div class="form-group">
                          <label class="control-label">Durasi :</label>
                          <select class="form-select" id="durasi" name="durasi" required>
                            <option>- Pilih -</option>
                            <?php foreach ($paket_list as $p) { ?>
                              <option value="<?= $p->durasi_paket ?>"><?= $p->nama_paket ?></option>
                           <?php } ?>
                        </select>
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