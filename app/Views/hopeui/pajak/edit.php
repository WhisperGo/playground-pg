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
                  <form action="<?= base_url('pajak/aksi_edit')?>" method="post">
                     <input type="hidden" name="id" value="<?php echo $jojo->id_pajak ?>">
                     <div class="row">

                        <div class="form-group">
                           <label class="form-label" for="fname">Nama Pajak <small class="text-danger text-sm">*</small></label>
                           <input type="text" class="form-control" id="nama_pajak" name="nama_pajak" placeholder="Masukkan Nama Pajak" value="<?php echo $jojo->nama_pajak ?>" required>
                        </div>

                        <div class="form-group">
                           <label class="form-label" for="fname">Persen Pajak <small class="text-danger text-sm">*</small></label>
                           <input type="text" class="form-control" id="persen_pajak" name="persen_pajak" placeholder="Masukkan Persen Pajak" value="<?php echo $jojo->persen_pajak ?>" required>
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