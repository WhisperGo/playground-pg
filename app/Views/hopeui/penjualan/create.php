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
                  <form action="<?= base_url('peminjaman/aksi_create')?>" method="post" enctype="multipart/form-data">

                     <input type="hidden" name="id" value="<?php echo $jojo2 ?>">

                     <div class="row">
                        <div class="form-group">
                           <label class="form-label" for="fname">Jumlah Peminjaman</label>
                           <input type="text" class="form-control" id="jumlah_peminjaman" name="jumlah_peminjaman" placeholder="Masukkan Jumlah Peminjaman" required>
                        </div>

                        <div class="form-group">
                           <label class="form-label" for="fname">User Peminjam</label>
                           <select class="form-select" id="user_peminjam" name="user_peminjam" required>
                              <option>- Pilih -</option>
                              <?php 
                              foreach ($user as $u) {
                                 ?>
                                 <option value="<?=$u->id_user?>"><?= $u->username?></option>
                              <?php } ?>
                           </select>
                        </div>

                        <div class="form-group">
                           <label class="form-label" for="fname">Tanggal Pengembalian</label>
                           <input type="date" class="form-control" id="tgl_pengembalian" name="tgl_pengembalian" placeholder="Masukkan Tanggal Pengembalian" required>
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