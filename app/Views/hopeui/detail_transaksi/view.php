 <div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">

            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <a href="<?=base_url('kasir/cetak_invoice/' . $id_transaksi)?>" class="btn btn-success"><i class="faj-button fa-regular fa-receipt"></i>Cetak Invoice</a>
               </div>
            </div>

            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Nama Permainan</th>
                           <th>Durasi</th>
                           <th>Subtotal</th>
                        </tr>
                     </thead>

                     <tbody>
                        <?php
                        $no=1;
                        foreach ($jojo as $riz) {
                          ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $riz->nama_permainan ?></td>
                            <td><?= $riz->durasi ?> jam</td>
                            <td>Rp <?= number_format($riz->subtotal, 0, ',', '.') ?></td>
                         </tr>
                      <?php } ?>
                   </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
</div>
</div>