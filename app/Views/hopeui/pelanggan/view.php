 <div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">

           <div class="card-header d-flex justify-content-between">
            <div class="header-title">
               <a href="<?=base_url('pelanggan/create')?>" class="btn btn-primary"><i class="faj-button fa-solid fa-plus"></i>Tambah</a>
            </div>
         </div>

         <div class="card-body">
            <div class="table-responsive">
               <table id="datatable" class="table table-striped" data-toggle="data-table">
                  <thead>
                     <tr>
                        <th>No.</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>No. Telepon</th>
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
                        <td><?php echo $riz->NamaPelanggan ?></td>
                        <td><?php echo $riz->Alamat ?></td>
                        <td><?php echo $riz->NomorTelepon ?></td>
                        <td>
                           <a href="<?php echo base_url('pelanggan/edit/'. $riz->PelangganID)?>" class="btn btn-warning my-1"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a>

                           <a href="<?php echo base_url('pelanggan/delete/'. $riz->PelangganID)?>" class="btn btn-danger my-1"><i class="fa-solid fa-trash"></i></a>
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