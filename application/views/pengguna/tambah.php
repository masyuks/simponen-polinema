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
			<div id="content" data-url="<?= base_url('pengguna') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('pengguna') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('pengguna/proses_tambah') ?>" id="form-tambah" method="POST">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="kode_pengguna"><strong>Nomor Induk Mahasiswa</strong></label>
											<input type="text" name="kode_pengguna" placeholder="Masukkan NIM" autocomplete="off"  class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <=57" required>
										</div>
										<div class="form-group col-md-6">
											<label for="nama_pengguna"><strong>Nama Mahasiswa</strong></label>
											<input type="text" name="nama_pengguna" placeholder="Masukkan Nama Pengguna" autocomplete="off"  class="form-control" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="username_pengguna"><strong>Program Studi</strong></label>
											<input type="text" name="username_pengguna" placeholder="Masukkan Username" autocomplete="off"  class="form-control" required>
											<span style="color: red; font-size: 10px;">* Contoh: D3 Teknik Listrik</span>
										</div>
										<div class="form-group col-md-6">
											<label for="jurusan_pengguna"><strong>Jurusan</strong></label>
											<input type="text" name="jurusan_pengguna" placeholder="Masukkan Jurusan" autocomplete="off"  class="form-control" required>
											<span style="color: red; font-size: 10px;">* Contoh: Teknik Elektro</span>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="email_pengguna"><strong>Email</strong></label>
											<input type="email" name="email_pengguna" placeholder="Masukkan Email" autocomplete="off"  class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="password_pengguna"><strong>Password</strong></label>
											<input type="password" name="password_pengguna" placeholder="Masukkan Password" autocomplete="off"  class="form-control" required>
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