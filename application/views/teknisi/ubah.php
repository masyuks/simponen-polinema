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
			<div id="content" data-url="<?= base_url('teknisi') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('teknisi') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('teknisi/proses_ubah/' . $teknisi->id) ?>" id="form-tambah" method="POST">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="kode_teknisi"><strong>Nomor Induk</strong></label>
											<input type="text" name="kode_teknisi" placeholder="Masukkan Nomor Induk" autocomplete="off"  class="form-control" required value="<?= $teknisi->kode_teknisi ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="nama_teknisi"><strong>Nama teknisi</strong></label>
											<input type="text" name="nama_teknisi" placeholder="Masukkan Nama teknisi" autocomplete="off"  class="form-control" required value="<?= $teknisi->nama_teknisi ?>">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="username_teknisi"><strong>Username</strong></label>
											<input type="text" name="username_teknisi" placeholder="Masukkan Username" autocomplete="off"  class="form-control" required value="<?= $teknisi->username_teknisi ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="password_teknisi"><strong>Password</strong></label>
											<input type="password" name="password_teknisi" autocomplete="off"  class="form-control">
											<span style="color: red;"><small>*Kosongi bila tidak diubah</small></span>
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
</body>
</html>