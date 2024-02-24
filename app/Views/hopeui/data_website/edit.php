<div class="conatiner-fluid content-inner mt-n5 py-0">
	<div>
		<div class="row">
			<div class="card">
				<div class="card-header d-flex justify-content-between">
					<div class="header-title">
						<h4 class="card-title"><?=$subtitle?></h4>
						<small class="text-danger text-sm">* Biarkan Jika Tidak Diedit</small>
					</div>
				</div>

				<div class="card-body">
					<div class="new-user-info">
						<form action="<?= base_url('data_website/aksi_edit/')?>" method="post" class="row g-3" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?php echo $jojo->id_website ?>">
							<div class="row">

								<div class="col-md-12">
									<div class="mb-3">
										<label for="logo_website" class="form-label">Logo Website</label>
										<div class="mb-3">
											<div class="custom-file">
												<div class="col-12 col-md-12">
													<input type="file" class="logo-perusahaan" id="logo_website" name="logo_website" accept="image/*" onchange="previewImage()">
												</div>
											</div>
											<input type="hidden" name="old_logo_website" value="<?= $jojo->logo_website ?>">
										</div>
										<div id="preview">
											<?php if ($jojo->logo_website): ?>
												<img src="<?=base_url('logo/logo_website/'. $jojo->logo_website)?>" width="25%">
											<?php endif; ?>
										</div>
									</div>

									<div class="mb-3">
										<label for="logo_pdf" class="form-label">Logo PDF</label>
										<div class="mb-3">
											<div class="custom-file">
												<div class="col-12 col-md-12">
													<input type="file" class="logo-pdf" id="logo_pdf" name="logo_pdf" accept="image/*" onchange="previewImage()">
												</div>
											</div>
											<input type="hidden" name="old_logo_pdf" value="<?= $jojo->logo_pdf ?>">
										</div>
										<div id="preview">
											<?php if ($jojo->logo_pdf): ?>
												<img src="<?=base_url('logo/logo_pdf/'. $jojo->logo_pdf)?>" width="15%">
											<?php endif; ?>
										</div>
									</div>

									<div class="mb-3">
										<label for="favicon" class="form-label">Favicon Website</label>
										<div class="mb-3">
											<div class="custom-file">
												<div class="col-12 col-md-12">
													<input type="file" class="favicon" id="favicon" name="favicon" accept="image/*" onchange="previewImage()">
												</div>
											</div>
											<input type="hidden" name="old_favicon" value="<?= $jojo->favicon_website ?>">
										</div>
										<div id="preview">
											<?php if ($jojo->favicon_website): ?>
												<img src="<?=base_url('logo/favicon/'. $jojo->favicon_website)?>" width="10%">
											<?php endif; ?>
										</div>
									</div>

									<div class="mb-3">
										<label for="nama_website" class="form-label">Nama Website</label>
										<input type="text" class="form-control" id="nama_website" placeholder="Masukkan Nama Website" name="nama_website" value="<?php echo $jojo->nama_website ?>" required>
									</div>

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

<script>
	function previewImage() {
		var preview = document.querySelector('#preview');
		var file = document.querySelector('#foto').files[0];
		var reader = new FileReader();

		reader.addEventListener("load", function () {
			var image = new Image();
			image.src = reader.result;
			image.style.width = '25%';
			preview.innerHTML = '';
			preview.appendChild(image);
		}, false);

		if (file) {
			reader.readAsDataURL(file);
		}
	}
</script>

</body>
</html>