<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('peminjaman') ?>">
				<!-- load Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
						<!-- Sidebar Toggle (Topbar) -->
						<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
							<i class="fa fa-bars"></i>
						</button>
						<img src="<?=base_url()?>assets/img/polinema-loss.png" style="width: 40px;">
						<div class="col-8" style="width: 100%;">
							<span style="width: 100%; color: black; font-weight: bold; font-size: 20px;">&nbsp;&nbsp; Sistem Informasi Peminjaman Komponen</span>
						</div>
						<!-- Topbar Navbar -->
						<ul class="navbar-nav ml-auto">
							<!-- Nav Item - Search Dropdown (Visible Only XS) -->
							<li class="nav-item dropdown no-arrow d-sm-none">
						<!-- <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-search fa-fw"></i>
						</a> -->
						<!-- Dropdown - Messages -->
						<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
							<form class="form-inline mr-auto w-100 navbar-search">
								<div class="input-group">
									<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
									<div class="input-group-append">
										<button class="btn btn-primary" type="button">
											<i class="fas fa-search fa-sm"></i>
										</button>
									</div>
								</div>
							</form>
						</div>
					</li>

					<div class="topbar-divider d-none d-sm-block"></div>
					<!-- Nav Item - User Information -->
					<li class="nav-item dropdown no-arrow">
						<a class="nav-link dropdown-toggle" href="<?= base_url('login') ?>">
							<span class="mr-2 d-none d-lg-inline text-gray-600 small"><i class="fas fa-fw fa-sign-in-alt"></i> Login</span>
						</a>
					</li>
				</ul>
			</nav>
				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><i class="fas fa-fw fa-search"></i>&nbsp;<?= $title ?></h1>
						</div>
						<div class="float-right">
							<!-- <a href="<?= base_url('peminjaman/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a> -->
							<!-- <a href="<?= base_url('peminjaman/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a> -->
						</div>
					</div>
					<hr>
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
					<div class="card shadow">
						<div class="card-header"><strong>Data Diri Mahasiswa</strong></div>
						<div class="card-body">
							<?php if ($jumlah_pengguna > 0) { ?>
								<?php foreach ($data_pengguna as $pengguna): ?>
									<div class="form-row">
										<div class="form-group col-4">
											<label>NIM</label>
											<input type="text" class="form-control" value="<?= $pengguna->kode_pengguna ?>" readonly>
										</div>
										<div class="form-group col-4">
											<label>Nama</label>
											<input type="text" class="form-control" value="<?= $pengguna->nama_pengguna ?>" readonly>
										</div>
										<div class="form-group col-4">
											<label>Username</label>
											<input type="text" class="form-control" value="<?= $pengguna->username_pengguna ?>" readonly>
										</div>
									</div>
								<?php endforeach ?>
							<?php } else { ?>
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									Data tidak ditemukan.
								</div>
							<?php } ?>
						</div>				
					</div>
					<br>
					<div class="card shadow">
						<div class="card-header"><strong>Hasil Pengecekan Data Tanggungan Peminjaman</strong></div>
						<div class="card-body">
							<?php if ($jumlah_pengguna > 0) { ?>
								<?php if ($jumlah_tanggungan > 0) { ?>
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										Anda memiliki <strong><?= $jumlah_tanggungan ?> tanggungan</strong> yang harus diselesaikan
									</div>
								<?php } else { ?>
									<div class="alert alert-success alert-dismissible fade show" role="alert">
										Anda tidak memiliki tanggungan peminjaman yang harus diselesaikan
									</div>
									<div>
										<a href="<?= base_url('cek/download/'.$kode_pengguna) ?>" class="btn btn-danger"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;SK Bebas Peminjaman</a>
									</div>
								<?php } ?>
							<?php } else { ?>
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									Data tidak ditemukan.
								</div>
							<?php } ?>
						</div>				
					</div>
					<br>
					<div class="card shadow">
						<div class="card-header"><strong>Data Tanggungan Peminjaman</strong></div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<td>NIM</td>
											<td>Nama Mahasiswa</td>
											<td>Dosen</td>
											<td>Waktu Pinjam</td>
											<td>Waktu Kembali</td>
											<td>Status</td>
											<td>Aksi</td>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($all_peminjaman as $peminjaman): ?>
											<?php if ($peminjaman->status == '3') { ?>
												<tr>
													<td><?= $peminjaman->nim ?></td>
													<td><?= $peminjaman->nama_pengguna ?></td>
													<td><?= $peminjaman->nama_dosen ?></td>
													<td><?= $peminjaman->waktu_pinjam ?></td>
													<td><?= $peminjaman->waktu_kembali ?></td>
													<td><?php
													if ($peminjaman->status == '1') {
														echo "Diajukan";
													} else if ($peminjaman->status == '2') {
														echo "Diterima";
													} else if ($peminjaman->status == '3') {
														echo "Tanggungan";
													} else if ($peminjaman->status == '4') {
														echo "Selesai";
													} else if ($peminjaman->status == '5') {
														echo "Ditolak";
													} 
													?>
												</td>
												<td>
													<i>Harap login untuk aksi</i>
												</td>
											</tr>
										<?php } ?>
									<?php endforeach ?>
								</tbody>
							</table>
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
<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>