 <div class="conatiner-fluid content-inner mt-n5 py-0">
 	<div class="row">
 		<div class="col-sm-12">
 			<div class="card">

 				<?php if ($jumlah_data == 0) { ?>
 					<div class="card-header d-flex justify-content-between">
 						<div class="header-title">
 							<a href="<?php echo base_url('data_website/create/') ?>"><button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah</button></a>
 						</div>
 					</div>
 				<?php } ?>

 				<div class="card-body">
 					<div class="table-responsive">
 						<table id="datatable" class="table table-striped" data-toggle="data-table">
 							<thead>
 								<tr>
 									<th>No</th>
 									<th>Nama Website</th>
 									<th>Logo Website</th>
 									<th>Logo PDF</th>
 									<th>Logo Favicon</th>
 									<th>Action</th>
 								</tr>
 							</thead>
 							<?php
 							$no=1;
 							foreach ($jojo as $riz) {
 								?>
 								<tr>
 									<td><?= $no++ ?></td>
 									<td><?php echo $riz->nama_website ?></td>
 									<td style="width: 100px; height: 100px; overflow: hidden; border-radius: 5px;">
 										<img src="<?php echo base_url('logo/logo_website/' . $riz->logo_website) ?>" style="width: 100%; height: 100%; object-fit: contain;">
 									</td>
 									<td style="width: 75px; height: 75px; overflow: hidden; border-radius: 5px;">
 										<img src="<?php echo base_url('logo/logo_pdf/' . $riz->logo_pdf) ?>" style="width: 100%; height: 100%; object-fit: contain;">
 									</td>
 									<td style="width: 50px; height: 50px; overflow: hidden; border-radius: 5px;">
 										<img src="<?php echo base_url('logo/favicon/' . $riz->favicon_website) ?>" style="width: 100%; height: 100%; object-fit: contain;">
 									</td>
 									<td>
 										<a href="<?php echo base_url('data_website/edit/'. $riz->id_website)?>" class="btn btn-warning my-1"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a>
 										<a href="<?php echo base_url('data_website/delete/'. $riz->id_website)?>" class="btn btn-danger my-1"><i class="fa-solid fa-trash"></i></a>
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