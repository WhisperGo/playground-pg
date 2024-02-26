 <div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">

          <div class="card-header d-flex justify-content-between">
            <div class="header-title">
               <a href="<?=base_url('pengeluaran/create')?>" class="btn btn-primary"><i class="faj-button fa-solid fa-plus"></i>Tambah</a>
            </div>
         </div>

         <div class="card-body">
            <div class="table-responsive">
               <table id="datatable" class="table table-striped" data-toggle="data-table">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Nama Pengeluaran</th>
                        <th>Jumlah Pengeluaran</th>
                        <th>Tanggal Pengeluaran</th>
                        <th>Action</th>
                     </tr>
                  </thead>

                  <tbody>
                     <?php
                     $no=1;
                     foreach ($jojo as $riz) {
                       ?>
                       <tr>
                        <td><?= $no++ ?></td>
                        <td><?php echo $riz->nama_pengeluaran ?></td> 
                        <td>Rp <?= number_format($riz->jumlah_pengeluaran, 0, ',', '.') ?></td>
                        <td><?= date('d M Y', strtotime($riz->tanggal_pengeluaran)) ?></td>
                        <td>
                           <a href="<?php echo base_url('pengeluaran/edit/'. $riz->id_pengeluaran)?>" class="btn btn-warning my-1"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a>

                           <a href="<?php echo base_url('pengeluaran/delete/'. $riz->id_pengeluaran)?>" class="btn btn-danger my-1"><i class="fa-solid fa-trash"></i></a>

                        </td>
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

<!-- <script>
   $(document).ready(function() {
      $('#table2').DataTable({
      });
   });
</script> -->