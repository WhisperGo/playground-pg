<div id="main-content">
	<div class="page-heading">
		<div class="page-title">
			<div class="row">
				<div class="col-12 col-md-6 order-md-1 order-last">
					<h3>Input Data <?=$title?></h3>
					<p class="text-subtitle text-muted">
						Silakan Masukkan Data <?=$title?>
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
							Input Data <?=$title?>
						</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>

	<section class="section">
		<div class="card">
			<form action="<?= base_url('perusahaan/aksi_create/')?>" method="post" class="row g-3" enctype="multipart/form-data">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-6 col-md-12">
							<div class="mb-3">
								<label for="logo_perusahaan" class="form-label">Logo Perusahaan</label>
								<div class="mb-3">
									<div class="custom-file">
										<div class="col-12 col-md-12">
											<input type="file" class="logo-perusahaan" id="logo_perusahaan" name="logo_perusahaan" accept="image/*" onchange="previewImage()">
										</div>
									</div>
								</div>
								<div id="preview"></div>
							</div>

							<div class="mb-3">
								<label for="logo_pdf" class="form-label">Logo PDF Perusahaan</label>
								<div class="mb-3">
									<div class="custom-file">
										<div class="col-12 col-md-12">
											<input type="file" class="logo-pdf" id="logo_pdf" name="logo_pdf" accept="image/*" onchange="previewImage()">
										</div>
									</div>
								</div>
								<div id="preview"></div>
							</div>

							<div class="mb-3">
								<label for="favicon" class="form-label">Favicon Perusahaan</label>
								<div class="mb-3">
									<div class="custom-file">
										<div class="col-12 col-md-12">
											<input type="file" class="favicon" id="favicon" name="favicon" accept="image/*" onchange="previewImage()">
										</div>
									</div>
								</div>
								<div id="preview"></div>
							</div>

							<div class="mb-3">
								<label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
								<input type="text" class="form-control" id="nama_perusahaan" placeholder="Masukkan Perusahaan" name="nama_perusahaan" required>
							</div>

							<div class="mb-3">
								<label for="komplek_perusahaan" class="form-label">Komplek Perusahaan</label>
								<input type="text" class="form-control" id="komplek_perusahaan" placeholder="Masukkan Komplek Perusahaan" name="komplek_perusahaan" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="mb-3">
								<label for="jalan_perusahaan" class="form-label">Jalan Perusahaan</label>
								<input type="text" class="form-control" id="jalan_perusahaan" placeholder="Masukkan Jalan Perusahaan" name="jalan_perusahaan" required>
							</div>

							<div class="mb-3">
								<label for="kelurahan_perusahaan" class="form-label">Kelurahan Perusahaan</label>
								<input type="text" class="form-control" id="kelurahan_perusahaan" placeholder="Masukkan Kelurahan Perusahaan" name="kelurahan_perusahaan" required>
							</div>

							<div class="mb-3">
								<label for="kecamatan_perusahaan" class="form-label">Kecamatan Perusahaan</label>
								<input type="text" class="form-control" id="kecamatan_perusahaan" placeholder="Masukkan Kecamatan Perusahaan" name="kecamatan_perusahaan" required>
							</div>

							<div class="mb-3">
								<label for="kota_perusahaan" class="form-label">Kota Perusahaan</label>
								<input type="text" class="form-control" id="kota_perusahaan" placeholder="Masukkan Kota Perusahaan" name="kota_perusahaan" required>
							</div>

							<div class="mb-3">
								<label for="kode_pos_perusahaan" class="form-label">Kode Pos Perusahaan</label>
								<input type="text" class="form-control" id="kode_pos_perusahaan" placeholder="Masukkan Kode Pos Perusahaan" name="kode_pos_perusahaan" required>
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