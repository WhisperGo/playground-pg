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
                  <form action="<?= base_url('buku/aksi_edit')?>" method="post" enctype="multipart/form-data">

                     <input type="hidden" name="id" value="<?php echo $jojo->id_buku ?>">

                     <div class="row">
                        <div class="form-group">
                           <label class="form-label" for="fname">Judul Buku</label>
                           <input type="text" class="form-control" id="judul_buku" name="judul_buku" placeholder="Masukkan Judul Buku" value="<?php echo $jojo->judul_buku ?>" required>
                        </div>

                        <div class="form-group" style="margin-bottom: 6px; margin-top: 6px;">
                           <label for="Foto" class="form-label">Cover Buku (Opsional)</label>
                           <input type="file" class="logo-perusahaan" id="cover_buku" name="cover_buku" accept="image/*">
                        </div>
                        <div id="preview">
                           <label for="Foto" class="form-label">Cover Buku Lama</label><br>
                           <?php if ($jojo->cover_buku): ?>
                              <img src="<?=base_url('cover/'. $jojo->cover_buku)?>" width="10%" class="mb-3">
                           <?php endif; ?>
                        </div>

                        <div class="form-group">
                           <label class="form-label" for="fname">Kategori Buku</label>
                           <select class="form-select" id="kategori_buku" name="kategori_buku" required>
                              <option>- Pilih -</option>
                              <?php 
                              foreach ($kategori as $k) {
                                 $selected = ($jojo->kategori_buku == $k->id_kategori) ? 'selected' : '';
                                 ?>
                                 <option value="<?=$k->id_kategori?>" <?=$selected?>><?= $k->nama_kategori?></option>
                              <?php } ?>
                           </select>
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