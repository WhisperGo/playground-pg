 <div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">

            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <a href="<?=base_url('produk/create')?>" class="btn btn-primary"><i class="faj-button fa-solid fa-plus"></i>Tambah</a>
               </div>
            </div>

            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Nama Produk</th>
                           <th>Harga</th>
                           <th>Stok</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>

                     <tbody>
                        <?php
                        $no=1;
                        foreach ($jojo as $riz) {
                          ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $riz->NamaProduk ?></td>
                            <td>Rp <?= number_format($riz->Harga, 2, ',', '.') ?></td>
                            <td><?= $riz->Stok ?> buah</td>
                            <td>
                              <a href="<?php echo base_url('produk/info_stok_masuk/'. $riz->ProdukID)?>" class="btn btn-success my-1"><i class="fa-regular fa-box-archive" style="color: #ffffff;"></i></a>

                              <a href="<?php echo base_url('produk/edit/'. $riz->ProdukID)?>" class="btn btn-warning my-1"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a>

                              <a href="<?php echo base_url('produk/delete/'. $riz->ProdukID)?>" class="btn btn-danger my-1"><i class="fa-solid fa-trash"></i></a>
                           </td>
                        </tr>
                     <?php } ?>
                  </tbody>
              <!--  <tfoot>
                  <tr>
                     <th>No.</th>
                     <th>Foto</th>
                     <th>Username</th>
                     <th>Level</th>
                     <th style="min-width: 100px">Action</th>
                  </tr>
               </tfoot> -->

            </table>
         </div>
      </div>
   </div>
</div>
</div>
</div>

<!-- <script>
   $(document).ready(function() {
      $('#table2').DataTable({
      });
   });
</script> -->