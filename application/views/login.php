<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>SIMPONEN | Login</title>
	<link href="<?= base_url('sb-admin') ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link href="<?= base_url('sb-admin') ?>/css/sb-admin-2.min.css" rel="stylesheet">
	<link href="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
	<!-- Favicon-->
	<link rel="shortcut icon" href="<?=base_url()?>assets/img/polinema-loss.png">
</head>

<body class="bg-gradient-primary">

	<div class="container">

		<!-- Outer Row -->
		<div class="row justify-content-center">

			<div class="col-sm-12 col-md-5">
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-12">
								<div class="p-5">
									<?php if ($this->session->flashdata('success')) : ?>
										<div class="alert alert-success alert-dismissible fade show" role="alert">
											<?= $this->session->flashdata('success') ?>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
									<?php elseif($this->session->flashdata('error')) : ?>
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											<?= $this->session->flashdata('error') ?>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
									<?php endif ?>
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4" style="color: black; font-weight: bold;">Sistem Informasi <br> Peminjaman Komponen <br> Gedung AI</h1>
										<img src="<?=base_url()?>assets/img/polinema-loss.png" style="width: 50%;">
										<br>
										<br>
										<!-- <center><p style="color: black; font-weight: bold;">Silahkan Login</p></center> -->
									</div>
									<form class="user" method="POST" action="<?= base_url('login/proses_login') ?>">
										<div class="form-group">
											<input type="text" class="form-control" id="username" placeholder="Masukkan Username" autocomplete="off" required name="username">
										</div>
										<div class="form-group">
											<input type="password" class="form-control" id="password" placeholder="Masukkan Password" required name="password">
										</div>
										<div class="form-group">
											<select name="role" id="role" class="form-control" required>
												<option value="">Masuk Sebagai</option>
												<option value="teknisi">Teknisi</option>
												<option value="mahasiswa">Mahasiswa</option>
											</select>
										</div>
										<button type="submit" class="btn btn-primary btn-block" name="login">
											Login
										</button>
										<button type="button" class="btn btn-success btn-block" name="cek" data-toggle="modal" data-target="#cekModal">
											Cek Bebas Pinjaman
										</button>
										<!-- <a href="https://api.whatsapp.com/send?phone=085331607260&text=test">Test</a> -->
									</form>
									<div class="modal fade" id="cekModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<form action="<?= base_url('cek') ?>" id="form-filter" method="POST">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Cek Bebas Tanggungan Peminjaman</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<div class="form-group">
															<label for="message-text" class="col-form-label">NIM</label>
															<input type="number" name="kode_pengguna" value="" placeholder="Masukkan NIM" class="form-control" required>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
														<button type="submit" class="btn btn-primary">Submit</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>

	<script src="<?= base_url('sb-admin') ?>/vendor/jquery/jquery.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/js/sb-admin-2.min.js"></script>
</body>

</html>
