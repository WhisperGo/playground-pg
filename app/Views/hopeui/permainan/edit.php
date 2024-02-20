<div class="conatiner-fluid content-inner mt-n5 py-0">
   <div>
      <div class="row">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title"><?=$subtitle?></h4>
                  <small class="text-danger text-sm">* Biarkan Jika Tidak Diedit</small>
               </div>
            </div>
            <div class="card-body">
               <div class="new-user-info">
                  <form action="<?= base_url('permainan/aksi_edit')?>" method="post">
                     <input type="hidden" name="id" value="<?php echo $jojo->id_permainan ?>">
                     <div class="row">

                        <div class="form-group">
                           <label class="form-label" for="fname">Nama Permainan <small class="text-danger text-sm">*</small></label>
                           <input type="text" class="form-control" id="nama_permainan" name="nama_permainan" placeholder="Masukkan Nama Permainan" value="<?php echo $jojo->nama_permainan ?>" required>
                        </div>

                        <div class="form-group">
                           <label class="form-label" for="fname">Harga Permainan <small class="text-danger text-sm">*</small></label>
                           <input type="text" class="form-control" id="harga_permainan" name="harga_permainan" placeholder="Masukkan Harga Permainan" value="<?php echo number_format($jojo->harga_permainan, 0, ',', '') ?>" required>
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