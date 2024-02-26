 <div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">

          <div class="card-header d-flex justify-content-between">
            <div class="header-title">
               <a href="<?=base_url('pajak/create')?>" class="btn btn-primary"><i class="faj-button fa-solid fa-plus"></i>Tambah</a>
            </div>
         </div>

         <div class="card-body">
            <div class="table-responsive">
               <table id="datatable" class="table table-striped" data-toggle="data-table">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Nama Pajak</th>
                        <th>Persen Pajak</th>
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
                        <td><?php echo $riz->nama_pajak ?></td> 
                        <td><?php echo $riz->persen_pajak ?>%</td> 
                        <td>
                           <a href="<?php echo base_url('pajak/edit/'. $riz->id_pajak)?>" class="btn btn-warning my-1"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a>
                           <a href="<?php echo base_url('pajak/delete/'. $riz->id_pajak)?>" class="btn btn-danger my-1"><i class="fa-solid fa-trash"></i></a>
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