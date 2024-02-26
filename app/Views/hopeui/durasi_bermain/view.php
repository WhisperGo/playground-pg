 <div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">

            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <a href="<?=base_url('kasir')?>" class="btn btn-primary"><i class="faj-button fa-solid fa-plus"></i>Tambah</a>
               </div>
            </div>

            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Nama Pelanggan</th>
                           <th>Tanggal Transaksi</th>
                           <th>Jam Mulai</th>
                           <th>Jam Selesai</th>
                           <th>Status</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>

                     <tbody>
                        <?php
                        $no=1;
                        foreach ($jojo as $riz) {
                         if ($riz->status == 1) { ?>
                         <tr>
                          <td><?= $no++ ?></td>
                          <td><?= $riz->NamaPelanggan ?></td>
                          <td><?= date('d M Y', strtotime($riz->tanggal_transaksi)) ?></td>
                          <td><?= date('H:i', strtotime($riz->jam_mulai)) ?></td>
                          <td><?= date('H:i', strtotime($riz->jam_selesai)) ?></td>
                          <td>
                             <?php
                             if ($riz->status == 1) {
                               echo '<span class="badge rounded-pill bg-primary">Masih Bermain</span>';
                            } elseif ($riz->status == 2) {
                               echo '<span class="badge rounded-pill bg-success">Selesai Bermain</span>';
                            }
                            ?>
                         </td>
                         <td>

                           <?php
                           if ($riz->status == 1) {
                              ?>
                              <a href="<?php echo base_url('transaksi/aksi_edit/' . $riz->id_transaksi) ?>" class="btn btn-success my-1"><i class="fa-regular fa-arrows-rotate" style="color: #ffffff;"></i></a>
                              <a href="<?php echo base_url('durasi_bermain/edit/' . $riz->id_transaksi) ?>" class="btn btn-success my-1"><i class="fa-regular fa-plus" style="color: #ffffff;"></i></a>
                           <?php } ?>
                           <a href="<?php echo base_url('detail_transaksi/'. $riz->id_transaksi)?>" class="btn btn-warning my-1"><i class="fa-regular fa-circle-info"></i></a>
                           <a href="<?php echo base_url('transaksi/delete/'. $riz->id_transaksi)?>" class="btn btn-danger my-1"><i class="fa-solid fa-trash"></i></a>
                        </td>
                     </tr>
                  <?php } }  ?>
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