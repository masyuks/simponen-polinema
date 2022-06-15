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
			<div id="content" data-url="<?= base_url('kasir') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
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
					<?php if($this->session->flashdata('overtime')) { ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('overtime') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php } ?>
					<div class="row">

						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Pinjaman Diajukan</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_pengajuan ?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-box fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-success shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Pinjaman Diterima</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_diterima ?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-cash-register fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-info shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Peminjaman Selesai</div>
											<div class="row no-gutters align-items-center">
												<div class="col-auto">
													<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $jumlah_selesai ?></div>
												</div>
											</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-file-invoice fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Pending Requests Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-warning shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Tanggungan</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_tanggungan ?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-users fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-8">
							<div class="card shadow">
								<div class="card-header"><strong>Data Peminjaman</strong></div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
											<thead>
												<tr>
													<td>Dosen</td>
													<td>Mata Kuliah</td>
													<td>Waktu Pinjam</td>
													<td>Waktu Kembali</td>
													<td>Status</td>
													<td>Aksi</td>
												</tr>
											</thead>
											<tbody>
												<?php $i = 0; ?>
												<?php foreach ($all_peminjaman as $peminjaman): ?>
													<tr>
														<td><?= $peminjaman->nama_dosen ?></td>
														<td><?= $peminjaman->nama_mk ?></td>
														<td><?= $peminjaman->waktu_pinjam ?></td>
														<td><?= $peminjaman->waktu_kembali ?></td>
														<td>
															<?php
															if ($peminjaman->status == '1') {
																echo "<span class='badge badge-pill badge-info'>Diajukan</span>";
															} else if ($peminjaman->status == '2') {
																date_default_timezone_set("Asia/Bangkok");
																$time = strtotime($peminjaman->waktu_kembali);
																$now = strtotime(date('Y-m-d H:i:s'));
																if ($now >= $time) {
																	echo "<span class='badge badge-pill badge-danger'>Overtime</span>";
																} else {
																	echo "<span class='badge badge-pill badge-primary'>Diterima</span>";
																}
															} else if ($peminjaman->status == '3') {
																if ($peminjaman->status == '3' AND $peminjaman->keterangan != NULL) {
																	echo "<span class='badge badge-pill badge-warning'>Tanggungan</span>";
																}
																else {
																	echo "<span class='badge badge-pill badge-success'>Selesai</span>";
																}
															} else if ($peminjaman->status == '4') {
																echo "<span class='badge badge-pill badge-success'>Selesai</span>";
															} else if ($peminjaman->status == '5') {
																echo "<span class='badge badge-pill badge-dark'>Ditolak</span>";
															} 
															?>
														</td>
														<td>
															<a href="<?= base_url('peminjaman/detail/' . $peminjaman->id) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
														</td>
													</tr>
												<?php endforeach ?>
											</tbody>
										</table>
									</div>
								</div>				
							</div>
						</div>
						<div class="col-md-4">
							<div class="card shadow">
								<div class="card-header"><strong>Notifikasi</strong></div>
								<div class="card-body">
									<?php if ($jumlah_tanggungan > 0) { ?>
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											Anda memiliki <strong><?= $jumlah_tanggungan ?> tanggungan</strong> yang harus diselesaikan
										</div>
									<?php } ?>
									<?php if ($jumlah_diterima > 0) { ?>
										<div class="alert alert-success alert-dismissible fade show" role="alert">
											<strong><?= $jumlah_diterima ?> pengajuan</strong> peminjaman anda telah diterima
										</div>
									<?php } ?>
									<?php if ($jumlah_overtime > 0) { ?>
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											Anda memiliki <strong><?= $jumlah_overtime ?> peminjaman</strong> yang sudah overtime.
										</div>
									<?php } ?>
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
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>