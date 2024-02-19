 <div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">

            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Nama Pelanggan</th>
                           <th>Total Harga</th>
                           <th>Tanggal Penjualan</th>
                           <th>Kasir</th>
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
                          <td><?= $riz->NamaPelanggan ?></td>
                          <td>Rp <?= number_format($riz->TotalHarga, 2, ',', '.') ?></td>
                          <td><?= date('d M Y', strtotime($riz->TanggalPenjualan)) ?></td>
                          <td><?= $riz->username ?></td>
                          <td>
                           <a href="<?php echo base_url('detail_penjualan/'. $riz->PenjualanID)?>" class="btn btn-success my-1"><i class="fa-regular fa-circle-info"></i></a>
                           <a href="<?php echo base_url('penjualan/delete/'. $riz->PenjualanID)?>" class="btn btn-danger my-1"><i class="fa-solid fa-trash"></i></a>
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