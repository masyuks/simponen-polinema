<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('dosen') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('dosen') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('dosen/proses_tambah') ?>" id="form-tambah" method="POST">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="kode_dosen"><strong>Nomor Induk</strong></label>
											<input type="text" name="kode_dosen" placeholder="Masukkan Nomor Induk" autocomplete="off"  class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="nama_dosen"><strong>Nama dosen</strong></label>
											<input type="text" name="nama_dosen" placeholder="Masukkan Nama dosen" autocomplete="off"  class="form-control" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="username_dosen"><strong>Jabatan</strong></label>
											<input type="text" name="jabatan" placeholder="Masukkan Jabatan" autocomplete="off"  class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="password_dosen"><strong>Mata Kuliah</strong></label>
											<select name="id_mk" id="id_mk" class="form-control">
												<option selected disabled>Pilih Mata Kuliah</option>
												<?php foreach ($all_mk as $mk): ?>
													<option value="<?= $mk->id ?>"><?= $mk->nama_mk ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<hr>
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
										<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
									</div>
								</form>
							</div>				
						</div>
					</div>
				</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script>
		
	</script>
</body>
</html>