<div id="main-content">
	<div class="page-heading">
		<div class="page-title">
			<div class="row">
				<div class="col-12 col-md-6 order-md-1 order-last">
					<h3>Edit Data <?=$title?></h3>
					<p class="text-subtitle text-muted">
						Silakan Edit Data <?=$title?>
					</p>
				</div>
				<div class="col-12 col-md-6 order-md-2 order-first">
					<nav
					aria-label="breadcrumb"
					class="breadcrumb-header float-start float-lg-end"
					>
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="<?=base_url('login/dashboard')?>">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							Edit Data <?=$title?>
						</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>

	<section class="section">
		<div class="card">
			<form action="<?= base_url('data_website/aksi_edit/')?>" method="post" class="row g-3" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $jojo->id_website ?>">
				<div class="card-body">
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

					<!-- bagian tombol submit -->
					<div class="col-12">
						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-0 col-md-offset-0">
								<a href="javascript:history.back()" class="btn btn-danger">Cancel</a>
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</div>
					<!-- bagian tombol submit -->
				</form>
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